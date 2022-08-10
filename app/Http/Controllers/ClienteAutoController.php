<?php

namespace App\Http\Controllers;

use App\Forms\ClienteAutoForm;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteAutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assina = true;
        $form = \FormBuilder::create(ClienteAutoForm::class, [
            'url' => route('clientes.store'),
            'method' => 'POST',
        ], ['class' => 'form-assin']);
        return view('clientes.index', compact('form', 'assina'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        \Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:clientes']
        ], [
            'email.unique' => 'Este email já se encontra cadastrado e ativo no sistema'
        ])->validate();
        $data['signed'] = 1;

        Cliente::create($data);
        $request->session()->flash('msg', 'Sua assinatura foi realizada com sucesso!');
        return redirect()->route('/');
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
