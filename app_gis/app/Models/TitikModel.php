<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TitikModel extends Model
{
    public function allData(){
        $results = DB::table('tbl_titik')
             ->select('nama','lat','lng')
             ->get();
        return $results;
    }
}
