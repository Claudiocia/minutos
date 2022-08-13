<?php

namespace App\Http\Controllers;

use App\Forms\ClienteForm;
use App\Models\Cliente;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request  $request)
    {
        $search = $request->get('search');
        //dd($search);
        if($search == null){
            $clientes = Cliente::orderBy('nome', 'ASC')->paginate();
            return view('admin.clientes.index', compact('clientes'));
        }elseif ($search == 'ativo'){
            $clientes = Cliente::where('signed', '=', '1')
                ->orderBy('nome', 'ASC')->paginate();
            return view('admin.clientes.index', compact('clientes'));
        }elseif ($search == 'inativo'){
            $clientes = Cliente::where('signed', '=', '2')
                ->orderBy('nome', 'ASC')->paginate();
            return view('admin.clientes.index', compact('clientes'));
        }elseif ($search == 'cancelado'){
            $clientes = Cliente::onlyTrashed()->orderBy('deleted_at')->paginate();
            return view('admin.clientes.index', compact('clientes'));
        }else{
            $clientes = Cliente::where('nome', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->orderBy('nome', 'ASC')->paginate();
            return view('admin.clientes.index', compact('clientes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(ClienteForm::class,[
            'url' => route('admin.clientes.store'),
            'method' => 'POST',
        ]);
        return view('admin.clientes.create', compact('form'));
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
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:clientes']
        ], [
            'email.unique' => 'Este email já se encontra cadastrado e ativo no sistema'
        ])->validate();
        $data['signed'] = 1;
        $data['token'] = md5(now().$data['email'].$data['nome']);
        $data['validado'] = now();

        Cliente::create($data);
        $request->session()->flash('msg', 'Assinatura criada com sucesso');
        return redirect()->route('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  Cliente $cliente
     * @return View
     */
    public function show(Cliente $cliente)
    {
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Cliente $cliente
     * @return View
     */
    public function edit(Cliente $cliente)
    {
        $form = \FormBuilder::create(ClienteForm::class, [
            'url' => route('admin.clientes.update', [ 'cliente' => $cliente->id]),
            'method' => 'PUT',
            'model' => $cliente,
            'data' => ['id' => $cliente->id],
        ]);

        return view('admin.clientes.edit', compact('form', 'cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Cliente $cliente
     * @return RedirectResponse
     */
    public function update(Request $request, Cliente $cliente)
    {
        $form = \FormBuilder::create(ClienteForm::class);
        $data = $form->getFieldValues();
        //dd($data);
        Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('clientes')->ignore($cliente->id)],
            'signed' => ['required'],
        ], [
            'signed.required' => 'Selecione se o assinante é ativo ou inativo',
        ])->validate();

        $cliente->fill($data);
        $cliente->save();

        $request->session()->flash('msg', 'Assinante atualizado com sucesso!');
        return redirect()->route('admin.clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  Cliente $cliente
     * @return RedirectResponse
     */
    public function destroy(Request $request, Cliente $cliente)
    {
        $cliente->delete();
        $request->session()->flash('msg', 'Assinante deletado com sucesso');
        return redirect()->route('admin.clientes.index');
    }
}
