<?php

namespace App\Imports;

use App\Models\Facility;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class FacilityImport implements ToModel
{
    use Importable;
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Facility([
            "user_id" => auth()->id(), 
            "name" => $row[0],
            "description" => $row[1],
            "latitude" => $row[2],
            "longitude" => $row[3],
            // "latitude" => substr_replace(strval($row[2]), ".", 2, 0),
            // "longitude" => substr_replace(strval($row[3]), ".", 3, 0),
        ]);
    }
}
