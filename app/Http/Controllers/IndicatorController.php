<?php

namespace App\Http\Controllers;

use App\Forms\ClienteAutoForm;
use App\Forms\MinuteriaForm;
use App\Models\Cliente;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $form = \FormBuilder::create(MinuteriaForm::class, [
            'url' => route('indicators.store'),
            'method' => 'POST',
        ], ['class' => 'form-assin']);
        return view('indicators.index', compact('form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return View
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $cliente = Cliente::whereEmail($data['email'])->first();
        if ($cliente == null){
            $cliente = new Cliente(['nome' => ' digite seu nome', 'email' => $data['email'] ]);
            $form = \FormBuilder::create(ClienteAutoForm::class, [
                'url' => route('clientes.store'),
                'method' => 'POST',
                'model' => $cliente,
            ], ['class' => 'form-assin']);
            return \view('indicators.assina', compact('form'));
        }
        $data['cod_ind'] = strtoupper(substr(md5(now()), 1, 7))."_".$cliente->id;
        dd($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $token
     * @return \Illuminate\Http\Response
     */
    public function assinaInd($token)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
