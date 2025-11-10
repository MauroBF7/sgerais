<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisaRequest;
use App\Http\Requests\UpdateDivisaRequest;
use App\Services\DivisaService;
use App\Models\Divisa;
use Illuminate\Support\Facades\File;

class DivisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //caminho do arquivo json
        $path = resource_path('data/divisas.json');
        if (File::exists($path)){
            $json= File::get($path);
            //converte para array associativo
            $divisas = json_decode($json, true);
        }else{
            //Se não encontrar o arquivo
            $divisas=[];
        }

        return view('divisas.index',compact('divisas'));
        //$divisas= Divisa::all();
        //return view('divisas.index',[
        //    'divisas'=>$divisas
        //]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDivisaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisa $divisa)
    {
        $divisa = $divisas->findBySigla($sigla);
        abort_unless($divisa, 404);
        return view('divisas.show',compact('divisa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisa $divisa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDivisaRequest $request, Divisa $divisa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisa $divisa)
    {
        //
    }
}
