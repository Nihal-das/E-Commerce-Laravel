<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return DB::table('items')
            ->select(
                'items.id',
                'items.item_name',
                'items.price',
                'items.stock_quantity'
            )
            ->orderBy('items.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            ['Das & Co.'],
            ['ID', 'Item Name', 'Price', 'Available Stock']
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Merge company title
        $sheet->mergeCells('A1:D1');

        return [
            1 => ['font' => ['bold' => true, 'size' => 16]],
            2 => ['font' => ['bold' => true]],
        ];
    }
}
