<?php

namespace App\Http\Controllers;

use App\Forms\ClienteAutoForm;
use App\Mail\SendMailCliente;
use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

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
     * @return View
     */
    public function create()
    {
        return view('clientes.reenvio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return View
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $cliente = Cliente::whereEmail($data['email'])->withTrashed()->first();
        if ($cliente != null) {
            $cliente->restore();
            if ($cliente->signed == 1){
                $data['signed'] = 2;
                $cliente->fill($data);
                $cliente->save();
            }
            $email = $cliente->email;

            $mailData = [
                'title' => 'Olá, '.$cliente->nome,
                'sub-title' => 'Recebemos um pedido para reativar sua assinatura.',
                'mensagem' => 'Para confirmar basta clicar no botão abaixo',
                'url' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
                'title-button' => 'Confirmar',
                'url_copia' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
                'date' => now(),
            ];

            Mail::to($email)->send(new SendMailCliente($mailData));

            if (Response::HTTP_OK){
                $msg = 'Mensagem enviada com sucesso';
                $request->session()->flash('msg', $msg);
            }else{
                $error = 'Ops! Tivemos problema. Peça um novo email de verificação';
                $request->session()->flash('error', $error);
            }

            return view('clientes.retorno');
        }
        \Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:clientes']
        ], [
            'email.unique' => 'Este email já se encontra cadastrado e ativo no sistema'
        ])->validate();
        $data['signed'] = 2;
        $data['token'] = md5(now().$data['email'].$data['nome']);

        $cliente = Cliente::create($data);
        $email = $cliente->email;

        $mailData = [
            'title' => 'Olá, '.$cliente->nome,
            'sub-title' => 'Valide o seu e-mail!',
            'mensagem' => 'Para isso basta clicar no botão abaixo',
            'url' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
            'title-button' => 'Validar E-mail',
            'url_copia' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
            'date' => now(),
        ];

        Mail::to($email)->send(new SendMailCliente($mailData));

        if (Response::HTTP_OK){
            $msg = 'Mensagem enviada com sucesso';
            $request->session()->flash('msg', $msg);
        }else{
            $error = 'Ops! Tivemos problema. Peça um novo email de verificação';
            $request->session()->flash('error', $error);
        }

        return view('clientes.bemvindo');
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
     * @param Request $request
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
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }

    /**
     * Validate email informado
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function verifyEmailCliente(Request $request)
    {
        $token = $request['token'];
        $id = $request['id'];
        $cliente =Cliente::whereId($id)->first();
        if ($token === $cliente->token){
            $data['signed'] = 1;
            $data['validado'] = now();
            $cliente->fill($data);
            $cliente->save();
            $msg = "E-mail validado com sucesso.";
        }else{
            $msg = "Os dados informados não conferem. \n Não foi possivel validar seu email!";
        }

        $request->session()->flash('msg', $msg);
        return redirect()->route('/');

    }

    /**
     * Validate email informado
     *
     * @param  Request $request
     * @return View
     */
    public function reenviarEmail(Request $request)
    {
        $email = $request['email'];
        $cliente = Cliente::whereEmail($email)->first();

        if ($cliente == null){
            $error = 'Ops! Este email não está cadastrado em nosso sistema.';
            $request->session()->flash('error', $error);
            return view('clientes.reenvio');
        }

        if ($cliente->signed == 1){
            $data['signed'] = 2;
            $cliente->fill($data);
            $cliente->save();
        }

        if ($cliente->token == null){
            $data['token'] = md5(now().$cliente->email.$cliente->nome);
            $cliente->fill($data);
            $cliente->save();
        }

        $mailData = [
            'title' => 'Olá, '.$cliente->nome,
            'sub-title' => 'Valide o seu e-mail!',
            'mensagem' => 'Para isso basta clicar no botão abaixo',
            'url' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
            'title-button' => 'Validar E-mail',
            'url_copia' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
            'date' => now(),
        ];

        Mail::to($email)->send(new SendMailCliente($mailData));

        if (Response::HTTP_OK){
            $msg = 'Email enviado com sucesso. Verifique sua caixa de spam';
            $request->session()->flash('msg', $msg);
        }else{
            $error = 'Ops! Tivemos problema. Peça um novo email de verificação';
            $request->session()->flash('error', $error);
        }

        return view('clientes.bemvindo');

    }

    /**
     * Cancelar assinatura
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function cancelar()
    {
        return view('clientes.cancelar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAssinatura(Request $request)
    {
        $email = $request['email'];
        $cliente = Cliente::whereEmail($email)->first();

        if ($cliente == null){
            $error = 'Ops! Este email não está cadastrado em nosso sistema.';
            $request->session()->flash('error', $error);
            return view('clientes.cancelar');
        }
        if ($cliente->signed == 1){
            $data['signed'] = 2;
            $cliente->fill($data);
            $cliente->save();
            $can = 'Assinatura cancelada. Caso queira voltar é só pedir recadastramento';
            $request->session()->flash('can', $can);
        }
        $mensagem  = "Se você NÃO pediu o cancelamento é só clicar no botão abaixo.";
        $mensagem .= "<br/>";
        $mensagem .= "Caso você tenha solicitado o cancelamento não precisa fazer mais nada!";
        $mensagem .= "<br/>";
        $mensagem .= "O Canal Minutos, compreende a sua decisão e se coloca à disposição para voltar a lhe informar, a qualquer momento.";
        $mensagem .= "<br/>";
        $mensagem .= "Muito Obrigado pelo tempo que você nos acompanhou!";
        $mailData = [
            'title' => 'Olá, '.$cliente->nome,
            'sub-title' => 'Assinatura cancelada!',
            'mensagem' => $mensagem,
            'url' => route('clientes.reativa', ['id' => $cliente->id]),
            'title-button' => 'Reativar Assinatura',
            'url_copia' => route('clientes.reativa', ['id' => $cliente->id]),
            'date' => now(),
        ];

        Mail::to($email)->send(new SendMailCliente($mailData));

        if (Response::HTTP_OK){
            $msg = 'Email enviado com sucesso.';
            $request->session()->flash('msg', $msg);
        }else{
            $error = 'Ops! Tivemos problema.';
            $request->session()->flash('error', $error);
        }

        $cliente->delete();

        $can = 'Assinatura cancelada. Caso queira voltar é só reativar';
        $request->session()->flash('can', $can);

        return view('clientes.despedida');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param Request $request
     * @return View
     */
    public function reativaAssinatura(Request $request, $id)
    {
        $cliente = Cliente::whereId($id)->withTrashed()->first();
        $cliente->restore();
        if ($cliente->signed == 1){
            $data['signed'] = 2;
            $cliente->fill($data);
            $cliente->save();
        }
        $email = $cliente->email;

        $mailData = [
            'title' => 'Olá, '.$cliente->nome,
            'sub-title' => 'Recebemos um pedido para reativar sua assinatura.',
            'mensagem' => 'Para confirmar basta clicar no botão abaixo',
            'url' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
            'title-button' => 'Confirmar',
            'url_copia' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
            'date' => now(),
        ];

        Mail::to($email)->send(new SendMailCliente($mailData));

        if (Response::HTTP_OK){
            $msg = 'Mensagem enviada com sucesso';
            $request->session()->flash('msg', $msg);
        }else{
            $error = 'Ops! Tivemos problema. Peça um novo email de verificação';
            $request->session()->flash('error', $error);
        }

        return view('clientes.retorno');

    }

}
