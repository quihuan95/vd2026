<?php

namespace App\Support;

use App\Models\Registration;
use RuntimeException;
use XMLWriter;
use ZipArchive;

class RegistrationExcelExport
{
    /**
     * @param  iterable<Registration>  $registrations
     */
    public function export(iterable $registrations, string $path): void
    {
        $worksheet = $this->worksheet($registrations);

        $archive = new ZipArchive;

        if ($archive->open($path, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new RuntimeException('Không thể tạo file Excel.');
        }

        $archive->addFromString('[Content_Types].xml', $this->contentTypes());
        $archive->addFromString('_rels/.rels', $this->packageRelationships());
        $archive->addFromString('xl/workbook.xml', $this->workbook());
        $archive->addFromString('xl/_rels/workbook.xml.rels', $this->workbookRelationships());
        $archive->addFromString('xl/styles.xml', $this->styles());
        $archive->addFromString('xl/worksheets/sheet1.xml', $worksheet);

        if (! $archive->close()) {
            throw new RuntimeException('Không thể hoàn tất file Excel.');
        }
    }

    /**
     * @param  iterable<Registration>  $registrations
     */
    private function worksheet(iterable $registrations): string
    {
        $writer = new XMLWriter;
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8', 'yes');
        $writer->startElement('worksheet');
        $writer->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
        $writer->writeAttribute('xmlns:r', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships');
        $writer->startElement('sheetViews');
        $writer->startElement('sheetView');
        $writer->writeAttribute('workbookViewId', '0');
        $writer->startElement('pane');
        $writer->writeAttribute('ySplit', '1');
        $writer->writeAttribute('topLeftCell', 'A2');
        $writer->writeAttribute('activePane', 'bottomLeft');
        $writer->writeAttribute('state', 'frozen');
        $writer->endElement();
        $writer->endElement();
        $writer->endElement();
        $writer->startElement('sheetData');

        $headers = array_keys($this->row(new Registration));
        $this->writeRow($writer, 1, $headers, 1);

        $rowNumber = 2;

        foreach ($registrations as $registration) {
            $values = $this->row($registration);
            $this->writeRow($writer, $rowNumber, array_values($values));
            $rowNumber++;
        }

        $writer->endElement();
        $writer->endElement();
        $writer->endDocument();

        return $writer->outputMemory();
    }

    /**
     * @return array<string, string|null>
     */
    private function row(Registration $registration): array
    {
        return [
            'Họ và tên' => $registration->full_name,
            'Giới tính' => $registration->gender,
            'Ngày sinh' => $registration->dob?->format('d/m/Y'),
            'Cơ quan' => $registration->organization,
            'Khoa / Phòng' => $registration->department,
            'Chức vụ' => $registration->job_title,
            'Email' => $registration->email,
            'Số điện thoại' => $registration->phone,
            'Tham dự tiệc tối' => $registration->attend_dinner ? 'Có' : 'Không',
        ];
    }

    /**
     * @param  array<int, string|null>  $values
     */
    private function writeRow(XMLWriter $writer, int $rowNumber, array $values, int $style = 0): void
    {
        $writer->startElement('row');
        $writer->writeAttribute('r', (string) $rowNumber);

        foreach ($values as $index => $value) {
            $cell = $this->columnName($index + 1).$rowNumber;

            $writer->startElement('c');
            $writer->writeAttribute('r', $cell);
            $writer->writeAttribute('t', 'inlineStr');
            if ($style > 0) {
                $writer->writeAttribute('s', (string) $style);
            }
            $writer->startElement('is');
            $writer->writeElement('t', (string) ($value ?? ''));
            $writer->endElement();
            $writer->endElement();
        }

        $writer->endElement();
    }

    private function columnName(int $column): string
    {
        $name = '';
        while ($column > 0) {
            $column--;
            $name = chr(65 + ($column % 26)).$name;
            $column = intdiv($column, 26);
        }

        return $name;
    }

    private function contentTypes(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/><Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/></Types>';
    }

    private function packageRelationships(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>';
    }

    private function workbook(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets><sheet name="Đại biểu đăng ký" sheetId="1" r:id="rId1"/></sheets></workbook>';
    }

    private function workbookRelationships(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/></Relationships>';
    }

    private function styles(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><fonts count="2"><font><sz val="11"/><name val="Calibri"/></font><font><b/><sz val="11"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font></fonts><fills count="3"><fill><patternFill patternType="none"/></fill><fill><patternFill patternType="gray125"/></fill><fill><patternFill patternType="solid"><fgColor rgb="FFED680E"/><bgColor indexed="64"/></patternFill></fill></fills><borders count="1"><border><left/><right/><top/><bottom/><diagonal/></border></borders><cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs><cellXfs count="2"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/><xf numFmtId="0" fontId="1" fillId="2" borderId="0" xfId="0" applyFont="1" applyFill="1"/></cellXfs><cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles></styleSheet>';
    }
}
