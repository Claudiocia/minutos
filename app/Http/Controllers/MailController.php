<?php

namespace App\Http\Controllers;

use App\Mail\SendMailCliente;
use App\Mail\SendMailNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $email = 'claudiosouza.cia@user.com';
        $nome ='Claudio Souza';
        $tele = 'Minutos';
        $mensagem  = "Olá $nome, ";
        $mensagem .= "<br/><br/>";
        $mensagem .= "Você efetuou um cadastro no site da $tele.</br>";
        $mensagem .= "<br>";
        $mensagem .= "Obrigado por nos Contactar. Caso tenha mais alguma nos contate novamente</br>";
        $subject = 'Email TESTE SEND';

        if ($request->get('button')){
            $mailData = [
                'title' => 'Email Teste',
                'sub-title' => 'Subtitulo',
                'mensagem' => $mensagem,
                'url' => null,
                'title-button' => null,
                'date' => now(),
            ];
        }else{

            $mailData = [
                'title' => 'Email Teste',
                'sub-title' => 'Subtitulo',
                'mensagem' => 'Teste de mensagem dinamica no email',
                'url' => 'teste.com.br',
                'title-button' => 'Teste do botão',
                'url_copia' => '#',
                'date' => now(),
            ];
        }

        Mail::to($email)->send(new SendMailCliente($mailData, $subject));

        if (Response::HTTP_OK){
            $msg = 'Mensagem enviada com sucesso';
        }else{
            $msg = 'Ops! Tivemos problema. Tente novamente mais tarde';
        }
        $request->session()->flash('msg', $msg);
        return redirect()->route('/');

    }


    public function previewEmail(Request $request)
    {
        $email = 'claudiosouza.cia@user.com';
        $nome ='Claudio Souza';
        $tele = 'Minutos';
        $mensagem  = "Olá $nome, ";
        $mensagem .= "<br/><br/>";
        $mensagem .= "Você efetuou um cadastro no site da $tele.</br>";
        $mensagem .= "<br>";
        $mensagem .= "Obrigado por nos Contactar. Caso tenha mais alguma nos contate novamente</br>";
        $subject = 'Email TESTE VIEW';

        if ($request->get('button')){
            $mailData = [
                'title' => 'Email Teste',
                'sub-title' => 'Subtitulo',
                'mensagem' => $mensagem,
                'url' => null,
                'title-button' => null,
                'date' => now(),
                'pathToFile' => 'public_path("site/img/sem_foto.png")',
            ];
        }else{
            $mailData = [
                'title' => 'Email Teste',
                'sub-title' => 'Subtitulo',
                'mensagem' => 'Teste de mensagem dinamica no email',
                'url' => 'teste.com.br',
                'title-button' => 'Teste do botão',
                'url_copia' => '#',
                'dataNews' => now(),
                'pathToFile' => 'public_path("site/img/sem_foto.png")',
            ];
        }

        return new SendMailNews($mailData, $subject);
    }
}
