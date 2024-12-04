<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);

        return new Customer([
            'name'=> $row[0],
            'surname'=> $row[1],
            'email'=> $row[2],
            'company'=> $row[3],
        ]);
    }
}
