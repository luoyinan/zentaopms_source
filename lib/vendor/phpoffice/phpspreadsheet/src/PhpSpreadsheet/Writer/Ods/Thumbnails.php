<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Ods;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Thumbnails extends WriterPart
{
    /**
     * Write Thumbnails/thumbnail.png to PNG format.
     *
     * @param Spreadsheet $spreadsheet
     *
     * @return string XML Output
     */
    public function writeThumbnail($spreadsheet = null)
    {
        return '';
    }
}
