<?php

/**
 * Process images from "New folder (2)" to "public/images/speakers"
 * - Handles EXIF orientation rotation
 * - Resizes images with max dimension 1200px for optimal web performance
 * - Saves high quality JPEG with quality 92
 */
$srcDir = __DIR__.'/../New folder (2)';
$dstDir = __DIR__.'/../public/images/speakers';

if (! is_dir($dstDir)) {
    mkdir($dstDir, 0755, true);
}

$files = scandir($srcDir);
$filesByNum = [];

foreach ($files as $f) {
    if ($f === '.' || $f === '..') {
        continue;
    }
    if (preg_match('/^(\d+)/', $f, $m)) {
        $filesByNum[(int) $m[1]] = $f;
    }
}

ksort($filesByNum);

echo 'Found '.count($filesByNum)." files in '$srcDir'\n";

function loadOrientedImage($path, &$mime)
{
    $info = @getimagesize($path);
    if (! $info) {
        return false;
    }

    $mime = $info['mime'];
    $img = null;

    switch ($mime) {
        case 'image/jpeg':
            $img = @imagecreatefromjpeg($path);
            break;
        case 'image/png':
            $img = @imagecreatefrompng($path);
            break;
        case 'image/webp':
            $img = @imagecreatefromwebp($path);
            break;
        default:
            return false;
    }

    if (! $img) {
        return false;
    }

    // Check EXIF orientation for JPEG
    if ($mime === 'image/jpeg' && function_exists('exif_read_data')) {
        $exif = @exif_read_data($path);
        if ($exif && ! empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 3:
                    $img = imagerotate($img, 180, 0);
                    break;
                case 6:
                    $img = imagerotate($img, -90, 0);
                    break;
                case 8:
                    $img = imagerotate($img, 90, 0);
                    break;
            }
        }
    }

    return $img;
}

$successCount = 0;
$failCount = 0;

for ($num = 1; $num <= 220; $num++) {
    if (! isset($filesByNum[$num])) {
        echo "Missing file for #$num\n";
        $failCount++;

        continue;
    }

    $srcFile = $srcDir.'/'.$filesByNum[$num];
    $dstFileName = sprintf('speaker_%03d.jpeg', $num);
    $dstFile = $dstDir.'/'.$dstFileName;

    $mime = '';
    $img = loadOrientedImage($srcFile, $mime);
    if (! $img) {
        echo "Failed to load image for #$num: {$filesByNum[$num]}\n";
        $failCount++;

        continue;
    }

    $origW = imagesx($img);
    $origH = imagesy($img);
    $maxDim = 1200;

    if ($origW > $maxDim || $origH > $maxDim) {
        if ($origW > $origH) {
            $newW = $maxDim;
            $newH = (int) round($origH * ($maxDim / $origW));
        } else {
            $newH = $maxDim;
            $newW = (int) round($origW * ($maxDim / $origH));
        }

        $resized = imagecreatetruecolor($newW, $newH);
        // Fill with white background in case of transparent PNG converted to JPEG
        $white = imagecolorallocate($resized, 255, 255, 255);
        imagefilledrectangle($resized, 0, 0, $newW, $newH, $white);
        imagecopyresampled($resized, $img, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
        imagedestroy($img);
        $img = $resized;
    } else {
        // If PNG or WebP, convert to truecolor with white background if needed
        if ($mime !== 'image/jpeg') {
            $tc = imagecreatetruecolor($origW, $origH);
            $white = imagecolorallocate($tc, 255, 255, 255);
            imagefilledrectangle($tc, 0, 0, $origW, $origH, $white);
            imagecopy($tc, $img, 0, 0, 0, 0, $origW, $origH);
            imagedestroy($img);
            $img = $tc;
        }
    }

    // Enable progressive JPEG for faster visual load
    imageinterlace($img, 1);

    $saved = imagejpeg($img, $dstFile, 92);
    imagedestroy($img);

    if ($saved) {
        $finalSize = filesize($dstFile);
        $successCount++;
        // echo "#$num saved -> $dstFileName (" . round($finalSize / 1024, 1) . " KB)\n";
    } else {
        echo "Error saving $dstFile for #$num\n";
        $failCount++;
    }
}

echo "\nProcessing complete!\n";
echo "Success: $successCount / 220\n";
echo "Failed: $failCount\n";
