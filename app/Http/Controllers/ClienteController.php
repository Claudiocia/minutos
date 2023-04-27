<?php

namespace App\Http\Controllers;

use App\Forms\ClienteForm;
use App\Forms\MensagemCliForm;
use App\Mail\SendMailCliente;
use App\Mail\SendMailMensagem;
use App\Mail\SendMailNews;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

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
        $num = Cliente::count();
        if($search == null){
            $clientes = Cliente::orderBy('nome', 'ASC')->paginate();
            return view('admin.clientes.index', compact('clientes', 'num'));
        }elseif ($search == 'ativo'){
            $clientes = Cliente::where('signed', '=', '1')
                ->orderBy('nome', 'ASC')->paginate();
            return view('admin.clientes.index', compact('clientes', 'num'));
        }elseif ($search == 'inativo'){
            $clientes = Cliente::where('signed', '=', '2')
                ->orderBy('nome', 'ASC')->paginate();
            return view('admin.clientes.index', compact('clientes', 'num'));
        }elseif ($search == 'cancelado'){
            $clientes = Cliente::onlyTrashed()->orderBy('deleted_at')->paginate();
            return view('admin.clientes.index', compact('clientes', 'num'));
        }else{
            $clientes = Cliente::where('nome', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->orderBy('nome', 'ASC')->paginate();
            return view('admin.clientes.index', compact('clientes', 'num'));
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
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function createMsg()
    {
        $form = \FormBuilder::create(MensagemCliForm::class, [
            'url' => route('admin.clientes.envia-msg'),
            'method' => 'POST',
        ]);

        return view('admin.clientes.msg.mensagem', compact('form'));
    }

    public function enviaMsg(Request $request)
    {
        $data = $request->all();
        //dd($data);

        $emails = Cliente::orderBy('id', 'ASC')->get();
        $clientes = User::whereRole(2)->get();
        $numReg = $emails->count();
        //dd($numReg);
        $chunks = $emails->chunk(50);

        $subject = $data['title'];
        $mensagem = $data['mensagem'];
        $date = $data['data'];

        foreach ($clientes as $cliente) {
        $mailData = [
            'title' => $subject,
            'mensagem' => $mensagem,
            'date' => $date,
        ];

            Mail::to($cliente->email)->send(new SendMailMensagem($mailData, $subject));
        }

        /*
        foreach ($chunks as $chunk){
            dd($chunk);
            Mail::to("newsletter@canalminutos.com.br")
                ->bcc($chunk)
                ->send(new SendMailMensagem($mailData, $subject));
        }*/


        if (Response::HTTP_OK){
            $msg = 'Mensagem enviada com sucesso';
        }else{
            $msg = 'Ops! Tivemos problema. Tente novamente mais tarde';
        }
        $request->session()->flash('msg', $msg);
        return redirect()->route('admin.clientes.index');

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
     * Validate email informado
     *
     * @param  Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\View\View
     */
    public function lembreteEmail(Request $request, Cliente $cliente)
    {
        //dd($cliente);

        $email = $cliente->email;

        if ($cliente->token == null){
            $data['token'] = md5(now().$cliente->email.$cliente->nome);
            $cliente->fill($data);
            $cliente->save();
        }
        $subject = 'Solicitação de reenvio de email';

        $mensagem  = "Você recebeu esta mensagem porque se inscreveu no Canal Minutos.";
        $mensagem .= "<br/>";
        $mensagem .= "Para confirmar a sua inscrição e passar a receber nossa newsletter, ";
        $mensagem .= "por favor, valide o seu e-mail clicando no botão abaixo. ";
        $mensagem .= "<br/><br/>";
        $mensagem .= "Obrigado por assinar o Canal Minutos. ";
        $mensagem .= "<br/>";
        $mensagem .= "Informação sem tempo a perder! ";
        $mensagem .= "<br/>";

        $mailData = [
            'title' => 'Olá, '.$cliente->nome,
            'sub-title' => 'Valide o seu e-mail!',
            'mensagem' => $mensagem,
            'url' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
            'title-button' => 'Validar E-mail',
            'url_copia' => route('clientes.verify', ['id' => $cliente->id, 'token' => $cliente->token]),
            'date' => now(),
        ];

        Mail::to($email)->send(new SendMailCliente($mailData, $subject));



        if (Response::HTTP_OK){
            $msg = 'Email enviado com sucesso. Verifique sua caixa de spam!';
            $request->session()->flash('msg', $msg);
        }else{
            $error = 'Ops! Tivemos problema. Envie um novo email de verificação!';
            $request->session()->flash('error', $error);
        }

        return view('clientes.bemvindo');

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
