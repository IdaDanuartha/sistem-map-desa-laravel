<?php

namespace App\Imports;

use App\Models\Village;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class VillageImport implements ToModel
{
    use Importable;
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Village([
            "user_id" => auth()->id(), 
            "name" => $row[0],
            "description" => $row[1],
            // "latitude" => explode('"', $row[2])[1],
            // "longitude" => explode('"', $row[3])[1],
            "latitude" => substr_replace(strval($row[2]), ".", 2, 0),
            "longitude" => substr_replace(strval($row[3]), ".", 3, 0),
        ]);
    }
}
