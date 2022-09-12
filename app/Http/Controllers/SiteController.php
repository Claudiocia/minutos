<?php

namespace App\Http\Controllers;

use App\Forms\RazionForm;
use App\Forms\Site\AbertForm;
use App\Forms\Site\AvaliaForm;
use App\Forms\Site\CausaForm;
use App\Forms\Site\CtaForm;
use App\Forms\Site\FooterForm;
use App\Forms\Site\RelFotoSiteForm;
use App\Forms\Site\SiteForm;
use App\Mail\SendMailCliente;
use App\Models\Cliente;
use App\Models\Newsletter;
use App\Models\NewsletterNoticia;
use App\Models\Nossotime;
use App\Models\Noticia;
use App\Models\Rate;
use App\Models\Razion;
use App\Models\Retranca;
use App\Models\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $tabs = [
            ['title' => 'Site', 'link' => 'site'], //site
            ['title' => 'Abertura', 'link' => 'abertura'], //hero
            ['title' => 'Razões', 'link' => 'razion'], //step - razoes
            ['title' => 'Causa', 'link' => 'causa'], //causa
            ['title' => 'Avaliações', 'link' => 'avalia'], //testemonial
            ['title' => 'CTA', 'link' => 'cta'], // cta
            ['title' => 'Footer', 'link' => 'footer'], //footer
            ['title' => 'Imagem', 'link' => 'imagens'], //imagens
        ];

        $site = Site::with('fotos')->first();
        $razions = Razion::orderBy('number', 'ASC')->get();
        //dd($site);
        if ($site == null){
            $url = route('admin.sites.store');
            $method = 'POST';
        }else{
            $url = route('admin.sites.update', ['site' => $site->id]);
            $method = 'PUT';
        }
        $formSite = \FormBuilder::create(SiteForm::class, [
            'url' => $url,
            'method' => $method,
            'model' => $site != null ? $site : '',
        ]);
        $formAbert = \FormBuilder::create(AbertForm::class, [
            'url' => $url,
            'method' => $method,
            'model' => $site != null ? $site : '',
        ]);
        $formAvalia = \FormBuilder::create(AvaliaForm::class, [
            'url' => $url,
            'method' => $method,
            'model' => $site != null ? $site : '',
        ]);
        $formCausa = \FormBuilder::create(CausaForm::class, [
            'url' => $url,
            'method' => $method,
            'model' => $site != null ? $site : '',
        ]);
        $formCta = \FormBuilder::create(CtaForm::class, [
            'url' => $url,
            'method' => $method,
            'model' => $site != null ? $site : '',
        ]);
        $formFooter = \FormBuilder::create(FooterForm::class, [
            'url' => $url,
            'method' => $method,
            'model' => $site != null ? $site : '',
        ]);
        $formFoto = \FormBuilder::create(RelFotoSiteForm::class, [
            'url' => $url,
            'method' => $method,
            'model' => $site != null ? $site : '',
        ]);


        return \view('admin.sites.index',  compact('tabs', 'site', 'formSite',
            'formAbert', 'formAvalia', 'formCausa', 'formCta', 'formFooter', 'formFoto', 'razions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function canalminutos()
    {
        $rates = Rate::where([
            ['public', '=', 's'],
            ['nota', '>=', '4']
        ])->inRandomOrder()->limit(5)->get();
        $razions = Razion::whereAtivo('s')->orderBy('number', 'ASC')->get();
        return view('welcome', compact('rates', 'razions'));
    }

    public function oldnews()
    {
        $newsletters = Newsletter::orderByDesc('numb_edicao')->paginate();
        return \view('newsletters.index', compact('newsletters'));
    }

    public function nossoTime()
    {
        $nossotimes = Nossotime::with('foto')->whereAtivo('s')->orderBy('nome', 'DESC')->get();
        return \view('nosso-time', compact('nossotimes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function faleConosco()
    {
        return \view('/contatos.fale-conosco');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Redirect
     */
    public function enviaMensagem(Request $request)
    {
        $data = $request->all();
        $subject = 'Contato Canal Minutos';
        $email = $data['email'];
        $mensagem  = "Nós recebemos uma mensagem sua.";
        $mensagem .= "<br/>";
        $mensagem .= "Ela já foi encaminhada pera o setor de relacionamento. ";
        $mensagem .= "Vamos respondê-la no menor prazo possivel.";
        $mensagem .= "<br/><br/>";
        $mensagem .= "O Canal Minutos agradece o seu contato. ";
        $mensagem .= "<br/>";
        $mensagem .= "Informação sem tempo a perder! ";
        $mensagem .= "<br/>";

        $mailData = [
            'title' => 'Olá, ' . $data['nome'],
            'sub-title' => 'Contato recebido',
            'mensagem' => $mensagem,
            'url' => route('/'),
            'title-button' => 'Visite nosso site',
            'url_copia' => route('/'),
            'date' => now(),
        ];

        Mail::to($email)->send(new SendMailCliente($mailData, $subject));

        if (Response::HTTP_OK) {

            $subject = 'Contato Canal Minutos';
            $email = 'canalminutos@canalminutos.com.br';
            $mensagem  = "Nós recebemos uma mensagem do form web.";
            $mensagem .= "<br/>";
            $mensagem .= "Ela foi enviada por ".$data['nome'].".";
            $mensagem .= "<br/>";
            $mensagem .= "O email do remetente é: ".$data['email'];
            $mensagem .= "<br/>";
            $mensagem .= "O telefone do remetente é: ".$data['tele'];
            $mensagem .= "<br/>";
            $mensagem .= "O assunto que ele informou foi: ".$data['subject'];
            $mensagem .= "<br/>";
            $mensagem .= "Abaixo a mensagem enviada:";
            $mensagem .= "<br/>";
            $mensagem .= $data['mensagem'];
            $mensagem .= "<br/>";

            $mailData = [
                'title' => 'Olá, administrador ',
                'sub-title' => 'Contato recebido',
                'mensagem' => $mensagem,
                'url' => route('/'),
                'title-button' => 'Voltar pro site',
                'url_copia' => route('/'),
                'date' => now(),
            ];

            Mail::to($email)->send(new SendMailCliente($mailData, $subject));

            $msg = 'Mensagem enviada com sucesso';
            $request->session()->flash('msg', $msg);
            return redirect()->route('/');
        } else {
            $error = 'Ops! O email informado, não é válido. Sua mensagem não foi enviada';
            $request->session()->flash('err', $error);
            return redirect()->back();
        }

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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);
        \Validator::make($data, [
            'site_nome' => ['required', 'max:255', 'string', 'unique:sites'],
            'site' => ['required']
        ], [
            'site_nome.required' => 'Favor informar um nome para o site',
            'site.required' => 'É preciso criar um site antes de cadastrar conteúdo',
        ])->validate();
        //dd($data);

        Site::create($data);

        $request->session()->flash('msg', 'Site cadastrado com sucesso');
        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  Newsletter $newsletter
     * @return View
     */
    public function show(Newsletter $newsletter)
    {
        $newsletter = Newsletter::whereId($newsletter->id)->with('noticias', 'parceiros', 'fotos')->first();

        $ed_hist_id = Retranca::whereNome('História do dia')->first()->id;
        $ed_ainda_id = Retranca::whereNome('E ainda...')->first()->id;
        $ed_etc_id = Retranca::whereNome('Etcetera')->first()->id;
        $ed_disse_id = Retranca::whereNome('Disse-se')->first()->id;
        $ed_dinhe_id = Retranca::whereNome('Dinheiro')->first()->id;
        $ed_plane_id = Retranca::whereNome('Planeta')->first()->id;
        $ed_cuida_id = Retranca::whereNome('Cuidar')->first()->id;
        $ed_cult_id = Retranca::whereNome('Cult & Tec')->first()->id;

        $noti_hists = Noticia::with('fotos')->newsl($newsletter->id)
            ->where('retranca_id', '=', $ed_hist_id)
            ->orderByDesc('id')->get();
        $noti_aindas = Noticia::with('fotos')->newsl($newsletter->id)
            ->where('retranca_id', '=', $ed_ainda_id)
            ->orderByDesc('id')->get();
        $noti_etcs = Noticia::with('fotos')->newsl($newsletter->id)
            ->where('retranca_id', '=', $ed_etc_id)
            ->orderByDesc('id')->get();
        $noti_disses = Noticia::with('fotos')->newsl($newsletter->id)
            ->where('retranca_id', '=', $ed_disse_id)
            ->orderByDesc('id')->get();
        $noti_dinhes = Noticia::with('fotos')->newsl($newsletter->id)
            ->where('retranca_id', '=', $ed_dinhe_id)
            ->orderByDesc('id')->get();
        $noti_planes = Noticia::with('fotos')->newsl($newsletter->id)
            ->where('retranca_id', '=', $ed_plane_id)
            ->orderByDesc('id')->get();
        $noti_cuidas = Noticia::with('fotos')->newsl($newsletter->id)
            ->where('retranca_id', '=', $ed_cuida_id)
            ->orderByDesc('id')->get();
        $noti_cults = Noticia::with('fotos')->newsl($newsletter->id)
            ->where('retranca_id', '=', $ed_cult_id)
            ->orderByDesc('id')->get();

        return \view('newsletters.show', compact('newsletter', 'noti_hists',
            'noti_aindas', 'noti_etcs', 'noti_disses', 'noti_dinhes', 'noti_planes', 'noti_cuidas', 'noti_cults'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Site $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Site $site
     * @return RedirectResponse
     */
    public function update(Request $request, Site $site)
    {
        $data = $request->all();
        if ($data['foto']){
            if (key_exists('foto_id', $data)){
                $site->fotos()->sync($data['foto_id']);
            }else{
                $site->fotos()->detach();
            }
        }

        $site->fill($data);
        $site->save();

        $request->session()->flash('msg', 'Site atualizado');
        return redirect()->route('admin.sites.index');

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

    //Metodos de criação e edição de conteudos

    public function createTitulo()
    {
        //
    }
}
