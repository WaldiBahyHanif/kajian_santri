<?php

namespace App\Imports;

use App\Models\LiqoGroup;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LiqoMembersImport implements ToCollection, WithHeadingRow
{
    public int $successCount = 0;

    /** @var array<int, array{row: int, name: string, mr: string, reason: string}> */
    public array $errors = [];

    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2; // +1 for zero-index, +1 for the heading row
            $santriName = trim((string) ($row['nama_santri'] ?? ''));
            $mrName = trim((string) ($row['nama_mr'] ?? ''));

            if ($santriName === '' || $mrName === '') {
                $this->errors[] = [
                    'row' => $rowNumber,
                    'name' => $santriName,
                    'mr' => $mrName,
                    'reason' => 'Nama Santri atau Nama MR kosong.',
                ];
                continue;
            }

            $matches = Student::where('status_aktif', 'Aktif')
                ->whereRaw('LOWER(name) = ?', [mb_strtolower($santriName)])
                ->get();

            if ($matches->count() !== 1) {
                $this->errors[] = [
                    'row' => $rowNumber,
                    'name' => $santriName,
                    'mr' => $mrName,
                    'reason' => $matches->isEmpty()
                        ? 'Nama santri tidak ditemukan di data santri aktif.'
                        : 'Ada lebih dari 1 santri aktif dengan nama yang sama, tidak bisa dipastikan.',
                ];
                continue;
            }

            $group = LiqoGroup::firstOrCreate(['name' => $mrName]);
            $matches->first()->update(['liqo_group_id' => $group->id]);
            $this->successCount++;
        }
    }
}
