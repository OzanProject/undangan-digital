<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuestsTemplateExport implements FromArray, WithHeadings
{
    /**
     * Data yang akan dieksport (hanya satu baris contoh)
     */
    public function array(): array
    {
        return [
            ['Budi Santoso', '81234567890', 'hadir'],
        ];
    }

    /**
     * Header Kolom (Wajib diisi)
     */
    public function headings(): array
    {
        return [
            'NAMA',
            'NOMOR_WHATSAPP (AWALAN 62)',
            'STATUS (hadir/tidak_hadir/pending)',
        ];
    }
}