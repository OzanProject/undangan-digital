<?php

namespace App\Exports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuestsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
    * Mengambil data dari database
    */
    public function collection()
    {
        return Guest::all();
    }

    /**
    * Mengatur Judul Kolom (Header)
    */
    public function headings(): array
    {
        return [
            'No',
            'Nama Tamu',
            'Nomor WhatsApp',
            'Status Kehadiran',
            'Link Undangan',
            'Waktu Input',
        ];
    }

    /**
    * Mengatur Data per Baris
    */
    public function map($guest): array
    {
        // Konversi status code ke bahasa manusia
        $statusLabel = 'Pending';
        if ($guest->status == 'hadir') $statusLabel = 'Hadir';
        if ($guest->status == 'tidak_hadir') $statusLabel = 'Tidak Hadir';

        return [
            $guest->id,
            $guest->name,
            $guest->phone,
            $statusLabel,
            route('invitation', $guest->slug), // Link otomatis
            $guest->created_at->format('d-m-Y H:i'),
        ];
    }

    /**
    * Styling (Bold Header)
    */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}