<?php

namespace App\Exports;

use App\Models\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ClientExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithEvents, WithColumnFormatting
{
    protected $clients;

    public function __construct(Collection $clients)
    {
        $this->clients = $clients;
    }

    public function collection()
    {
        return $this->clients;
    }

    public function headings(): array
    {
        return [
            'Nama Klien',
            'Nama PIC',
            'Jabatan PIC',
            'Nomor Telepon',
            'Email',
            'Alamat',
            'Sektor Bisnis',
            'Kebutuhan Utama',
            'Sumber Info',
            'Tanggal Registrasi',
            'Status Blast'
        ];
    }

    public function map($client): array
    {
        return [
            $client->nama_klien,
            $client->nama_pic,
            $client->jabatan_pic,
            $client->nomor_telepon, // Native format, handled by WithColumnFormatting
            $client->email,
            $client->alamat,
            $client->sektor_bisnis,
            $client->kebutuhan_utama,
            $client->sumber_info,
            $client->created_at->format('d M Y, H:i'),
            $client->blast_status
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT, // Column D is Nomor Telepon
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1    => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => '1E3A5F']]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Apply borders to all cells containing data
                $highestRow = $event->sheet->getHighestRow();
                $highestColumn = $event->sheet->getHighestColumn();
                $cellRange = 'A1:' . $highestColumn . $highestRow;
                
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FFCCCCCC'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]
                ]);

                // Freeze the header row
                $event->sheet->getDelegate()->freezePane('A2');
            },
        ];
    }
}
