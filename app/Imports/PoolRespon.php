<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PoolRespon implements ToCollection, WithCalculatedFormulas
{
    public function collection(Collection $rows)
    {
        dd($rows[0]);
    }
}
