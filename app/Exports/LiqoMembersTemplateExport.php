<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LiqoMembersTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            ['Ahmad Fulan', 'Ust. Contoh'],
        ];
    }

    public function headings(): array
    {
        return ['Nama Santri', 'Nama MR'];
    }
}
