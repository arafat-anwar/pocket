<?php
namespace App\Imports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Import implements ToCollection , WithStartRow, WithHeadingRow
{
    use Importable;
    public function collection(Collection $collection)
    {
        foreach ($collection as $values)
        {

        }
    }

    public function startRow(): int
    {
        return 2;
    }
}