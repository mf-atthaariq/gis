<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TitikModel;

class TitikController extends Controller
{
    public function __construct()
    {
        $this->TitikModel = new TitikModel();
    }

    public function index(){
        return view('home');
    }

    public function allTitik(){
        $results=$this->TitikModel->allData();
        return json_encode($results);
    }

    public function titik($id=''){
        $results=$this->TitikModel->getTitik($id);
        return json_encode($results);
    }
}
