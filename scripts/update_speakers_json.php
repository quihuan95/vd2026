<?php

// Rebuild resources/speakers.json based on commit 9184d81 (the 218 approved speakers)
$baseJson = json_decode(shell_exec('git show 9184d81:resources/speakers.json'), true);

if (count($baseJson) !== 218) {
    exit('Expected 218 items in base commit, found '.count($baseJson)."\n");
}

$files = scandir(__DIR__.'/../New folder (2)');
$filesByNum = [];
foreach ($files as $f) {
    if (preg_match('/^(\d+)/', $f, $m)) {
        $filesByNum[(int) $m[1]] = $f;
    }
}

$updated = [];

foreach ($baseJson as $idx => $sp) {
    $stt = $sp['stt'];
    $name = $sp['name'];
    $fileNum = null;

    // Determine the exact file number in New folder (2) for this person:
    if ($stt >= 1 && $stt <= 141) {
        $fileNum = $stt; // 1..141
    } elseif ($stt >= 142 && $stt <= 152) {
        $fileNum = $stt + 1; // 143..153 (since 142 was removed)
    } elseif ($stt === 153) {
        // Hoàng Mạnh Huy - no file in New folder (2)
        $fileNum = null;
    } elseif ($stt >= 154 && $stt <= 191) {
        // 154 is Đỗ Tất Thành (file 154) ... 191 is Vũ Ngọc Linh (file 191)
        $fileNum = $stt;
    } elseif ($stt >= 192 && $stt <= 218) {
        // 192 is Đỗ Thị Thu Hiền (file 194) ... 218 is Nguyễn Thị Chinh (file 220)
        // Since 193 (Phạm Đức Mục) was removed:
        $fileNum = $stt + 2; // e.g. 192 -> 194, 218 -> 220

        // Swap check for Bùi Minh Thu & Nguyễn Thị Minh Chính:
        // In baseJson: STT 211 is Nguyễn Thị Minh Chính, STT 212 is Bùi Minh Thu
        if ($name === 'Bùi Minh Thu') {
            $fileNum = 213; // 213. Bùi Minh Thu.jpg
        } elseif ($name === 'Nguyễn Thị Minh Chính') {
            $fileNum = 214; // 214. Nguyễn Thị Minh Chính 1.jpg
        }
    }

    if ($fileNum !== null) {
        $sp['folder'] = sprintf('%03d_%s', $fileNum, $sp['name']);
        $sp['photo_path'] = sprintf('images/speakers/speaker_%03d.jpeg', $fileNum);
    } else {
        $sp['photo_path'] = null;
    }

    $updated[] = $sp;
}

// Validation
$hasPhoto = 0;
$noPhoto = 0;
foreach ($updated as $sp) {
    if ($sp['photo_path']) {
        $p = __DIR__.'/../public/'.$sp['photo_path'];
        if (! file_exists($p)) {
            exit("File not found on disk: $p for {$sp['name']}\n");
        }
        $hasPhoto++;
    } else {
        $noPhoto++;
        echo "No photo for STT {$sp['stt']}: {$sp['name']}\n";
    }
}

echo 'Total: '.count($updated)." speakers\n";
echo "With photo: $hasPhoto\n";
echo "Without photo: $noPhoto\n";

file_put_contents(
    __DIR__.'/../resources/speakers.json',
    json_encode($updated, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."\n"
);

echo "Successfully written to resources/speakers.json!\n";
