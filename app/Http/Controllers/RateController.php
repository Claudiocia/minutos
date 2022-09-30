<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Rate;
use App\Models\Site;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('rates.create');
        //return view('rates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function create(Request $request)
    {
        $email = $request['email'];
        $cliente = Cliente::whereEmail($email)->first();
        if ($cliente == null){
            $error = "Este email não está cadastrado em nosso sistema. Para avaliar você precisa conhecer!";
            $request->session()->flash('error', $error);
            return  redirect()->route('rates.index');
        }elseif (!$cliente->validado){
            $error = "Este email ainda não foi confirmado pelo assinante. Se ainda não recebeu o e-mail de confirmação, solicite o reenvio";
            $request->session()->flash('error', $error);
            return  view('clientes.reenvio', compact('cliente'));
        }elseif (!$cliente->review){
            return view('rates.create', compact('cliente'));
        }else {
            $rate = Rate::whereClienteId($cliente->id)->first();
            return view('rates.edit', compact('cliente', 'rate'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        \Validator::make($data, [
            'nota' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'texto' => ['required', 'max:255'],
            'email' => ['required', 'exists:clientes']
        ], [
            'nota.required' => 'Favor selecionar de 1 a 5 estrelas como avaliação!',
            'title.required' => 'Dê um título para a sua avaliação',
            'texto.required' => 'Escreva, no campo "Comentário", em poucas palavras, porque você deu a nota acima!',
            'email.exists' => 'Este e-mail não está cadastrado como assinante. Para avaliar é preciso conhecer.'
        ])->validate();

        $cliente = Cliente::whereEmail($data['email'])->first();
        if ($data['cliente_id'] == null){
            $data['cliente_id'] = $cliente->id;
        }
        if (!$cliente->review) {
            $rate = Rate::create($data);
            if ($rate != null) {
                $dataCli['review'] = true;
                $cliente->fill($dataCli);
                $cliente->save();
            }
        }else{
            $rate = Rate::whereClienteId($cliente->id)->first();
            if ($rate->public == 's'){
                $data['public']= 'n';
            }
            $rate->fill($data);
            $rate->save();
        }
        $request->session()->flash('msg', 'Obrigado pela sua avaliação!');
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
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Rate $rate
     * @return RedirectResponse
     */
    public function update(Request $request, Rate $rate)
    {
        $data = $request->all();
        \Validator::make($data, [
            'cliente_id' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'texto' => ['required', 'max:255']
        ], [
            'title.required' => 'Dê um título para a sua avaliação',
            'texto.required' => 'Escreva, no campo "Comentário", em poucas palavras, porque você deu a nota acima!'
        ])->validate();

        if ($data['nota'] == null){
            $data['nota'] = $data['nota1'];
        }
        unset($data['nota1']);
        if ($rate->public == 's'){
            $data['public']= 'n';
        }
        $rate->fill($data);
        $rate->save();
        $request->session()->flash('msg', 'Avaliação atualizada!');
        return redirect()->route('/');
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
