<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TitikModel extends Model
{
    public function allData(){
        $results = DB::table('tbl_titik')
             ->select('id','nama','lat','lng','foto')
             ->get();
        return $results;
    }

    public function getTitik($id=''){
        $results = DB::table('tbl_titik')
             ->select('nama','lat','lng','foto')
             ->where('id',$id)
             ->get();
        return $results;
    }

    public function allLokasi(){
        $results = DB::table('tbl_titik')
             ->select('id','nama')
             ->get();
        return $results;
    }
}