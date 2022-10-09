<?php

namespace App\Http\Controllers;

use App\Forms\NewsletterForm;
use App\Forms\RelFotoNewsletterForm;
use App\Mail\SendMailCliente;
use App\Mail\SendMailNews;
use App\Models\Cliente;
use App\Models\Foto;
use App\Models\Newsletter;
use App\Models\NewsletterNoticia;
use App\Models\Noticia;
use App\Models\Retranca;
use App\Models\Site;
use App\Models\User;
use FormBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $newsletters = Newsletter::orderByDesc('numb_edicao')->paginate();

        return view('admin.newsletters.index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = FormBuilder::create(NewsletterForm::class, [
            'url' => route('admin.newsletters.store'),
            'method' => 'POST',
            'id' => 'form-news',
        ]);
        return view('admin.newsletters.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(NewsletterForm::class);
        $data = $form->getFieldValues();
        \Validator::make($data, [
            'title_dia' => ['required', 'max:40'],
            'abertura' => ['required', 'min:30'],
            'data_edicao' => ['required'],
            'noticias' => ['required'],
        ])->validate();
        //dd($data);

        $newsletter = Newsletter::create([
            'abertura' => $data['abertura'],
            'num_seq' => $data['num_seq'],
            'numb_edicao' => $data['numb_edicao'],
            'data_edicao' => $data['data_edicao'],
            'user_id' => $data['user_id'],
        ]);

        $newsletter->noticias()->attach($data['noticias']);

        $cont = count($data['noticias']);
        //dd($data['noticias']);
        for ($i = 0; $i < $cont; $i++) {
            $not_id = $data['noticias'][$i];
            $noti = Noticia::whereId($not_id)->first();
            $edit_id = $noti->retranca->id;
            \DB::table('newsletter_noticias')->insert([
                'editoria' => $edit_id,
                'newsletter_id' => $newsletter->id,
                'noticia_id' => $not_id,
            ]);
            $data_noti['public'] = 's';
            $data_noti['newsletter_id'] = $newsletter->id;
            $noti->fill($data_noti);
            $noti->save();
        }

        $request->session()->flash('msg', 'Newsletter criada com sucesso');
        return redirect()->route('admin.newsletters.index');
    }

    /**
     * Relacionar photo diretamente com Newsletter
     *
     * @param Newsletter $newsletter
     * @return View
     */
    public function photorel(Newsletter $newsletter)
    {
        $fotos = Foto::whereUsing('parceiro')->get();
        $form = FormBuilder::create(RelFotoNewsletterForm::class, [
            'url' => route('admin.newsletters.update', ['newsletter' => $newsletter->id]),
            'method' => 'PUT',
            'model' => $newsletter,
        ]);

        return \view('admin.newsletters.foto-rel', compact('form', 'newsletter', 'fotos'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Newsletter $newsletter
     * @param Request $request
     * @return RedirectResponse
     */
    public function disparaNews(Request $request, Newsletter $newsletter)
    {

        $emails = Cliente::orderBy('id', 'ASC')->get();
        $numReg = $emails->count();
        //dd($numReg);
        $chunks = $emails->chunk(50);

        //dd($chunks->toArray());

        $subject = $newsletter->title_dia;

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

        //dd($newsletter);
        if (count($newsletter->fotos) != 0) {
            foreach ($newsletter->fotos as $foto) {
                $fotoParceiro = $foto->foto_path;
                break;
            }
        } else {
            $fotoParceiro = '';
        }

        $dateTimeObj = new \DateTime(
            $newsletter->data_edicao, new \DateTimeZone('America/Sao_Paulo'));

        $dataFormatted = \IntlDateFormatter::formatObject(
            $dateTimeObj,
            " d 'de' MMMM 'de' y",
            'pt-BR'
        );
        $diaFormatted = \IntlDateFormatter::formatObject(
            $dateTimeObj,
            "EEEE, ",
            'pt-BR'
        );

        $dia = ucwords($diaFormatted).$dataFormatted;

        $mailData = [
                'diaNews' => $dia,
                'foto_parca' => $fotoParceiro,
                'abertura' => $newsletter->abertura,
                'hist_dia' => $noti_hists,
                'noti_ainda' => $noti_aindas,
                'noti_etcs' => $noti_etcs,
                'noti_disses' => $noti_disses,
                'noti_dinhes' => $noti_dinhes,
                'noti_planes' => $noti_planes,
                'noti_cuidas' => $noti_cuidas,
                'noti_cults' => $noti_cults,
            ];
        foreach ($chunks as $chunk){
            Mail::to("admin@canalminutos.com.br")
                ->bcc($chunk)
                ->send(new SendMailNews($mailData, $subject));
        }



        if (Response::HTTP_OK){
            $msg = 'Mensagem enviada com sucesso';
        }else{
            $msg = 'Ops! Tivemos problema. Tente novamente mais tarde';
        }
        $request->session()->flash('msg', $msg);
        return redirect()->route('admin.newsletters.index');

    }

    public function testeEmail(Request $request, Newsletter $newsletter)
    {
        //$newsletter = Newsletter::whereId(1)->first();

        $clientes = User::whereRole(2)->get();
        //dd($clientes);
        $subject = 'Email de teste -- '.$newsletter->title_dia;

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

        //dd($newsletter);
        if (count($newsletter->fotos) != 0) {
            foreach ($newsletter->fotos as $foto) {
                $fotoParceiro = $foto->foto_path;
                break;
            }
        } else {
            $fotoParceiro = '';
        }

        $dateTimeObj = new \DateTime(
            $newsletter->data_edicao, new \DateTimeZone('America/Sao_Paulo'));

        $dataFormatted = \IntlDateFormatter::formatObject(
            $dateTimeObj,
            " d 'de' MMMM 'de' y",
            'pt-BR'
        );
        $diaFormatted = \IntlDateFormatter::formatObject(
            $dateTimeObj,
            "EEEE, ",
            'pt-BR'
        );

        $dia = ucwords($diaFormatted).$dataFormatted;

        foreach ($clientes as $cliente) {

            $mailData = [
                'diaNews' => $dia,
                'foto_parca' => $fotoParceiro,
                'abertura' => $newsletter->abertura,
                'hist_dia' => $noti_hists,
                'noti_ainda' => $noti_aindas,
                'noti_etcs' => $noti_etcs,
                'noti_disses' => $noti_disses,
                'noti_dinhes' => $noti_dinhes,
                'noti_planes' => $noti_planes,
                'noti_cuidas' => $noti_cuidas,
                'noti_cults' => $noti_cults,
            ];

            Mail::to($cliente->email)->send(new SendMailNews($mailData, $subject));
        }

        if (Response::HTTP_OK){
            $msg = 'Mensagem enviada com sucesso';
            $data['enviada'] = 's';
            $newsletter->fill($data);
            $newsletter->save();
        }else{
            $msg = 'Ops! Tivemos problema. Tente novamente mais tarde';
        }
        $request->session()->flash('msg', $msg);
        return redirect()->route('admin.newsletters.show', ['newsletter' => $newsletter->id]);

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

        return \view('admin.newsletters.show', compact('newsletter', 'noti_hists',
            'noti_aindas', 'noti_etcs', 'noti_disses', 'noti_dinhes', 'noti_planes', 'noti_cuidas', 'noti_cults'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Newsletter $newsletter
     * @return View
     */
    public function edit(Newsletter $newsletter)
    {
        $newsletter = Newsletter::with('noticias')->whereId($newsletter->id)->first();

        $form = FormBuilder::create(NewsletterForm::class, [
            'url' => route('admin.newsletters.update', ['newsletter' => $newsletter->id]),
            'method' => 'PUT',
            'id' => 'form-news',
            'model' => $newsletter,
        ]);

        return \view('admin.newsletters.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Newsletter $newsletter
     * @return RedirectResponse
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        $data = $request->all();

        if ($data['foto']!= null){
            if(key_exists('foto_id', $data)) {
                $newsletter->fotos()->sync($data['foto_id']);
            }else{
                $newsletter->fotos()->detach();
            }
            $request->session()->flash('msg', 'Fotos da Newsletter atualizadas com sucesso!');
        }else {
            $cont = count($data['noticias']);

            $news = NewsletterNoticia::whereNewsletterId($newsletter->id)->get();
            foreach ($news as $new) {
                $noti = Noticia::whereId($new->noticia->id)->first();
                $data_noti['public'] = 'n';
                $data_noti['newsletter_id'] = null;
                $noti->fill($data_noti);
                $noti->save();
                $new->delete();
            }
            for ($i = 0; $i < $cont; $i++) {
                $not_id = $data['noticias'][$i];
                $noti = Noticia::whereId($not_id)->first();
                $edit_id = $noti->retranca->id;
                \DB::table('newsletter_noticias')->insert([
                    'editoria' => $edit_id,
                    'newsletter_id' => $newsletter->id,
                    'noticia_id' => $not_id,
                ]);
                $data_noti['public'] = 's';
                $data_noti['newsletter_id'] = $newsletter->id;
                $noti->fill($data_noti);
                $noti->save();
            }
            $newsletter->noticias()->sync($data['noticias']);
            $newsletter->fill($data);
            $newsletter->save();
            $request->session()->flash('msg', 'Boletim atualizado');
        }


        return redirect()->route('admin.newsletters.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  Newsletter $newsletter
     * @return RedirectResponse
     */
    public function destroy(Request $request, Newsletter $newsletter)
    {
        if ($newsletter->enviada == 's'){
            $request->session()->flash('msg', 'Essa newsletter já foi enviada, por isso não pode ser deletada do sistema');
            return redirect()->route('admin.newsletters.index');
        }else{
            $newsletter->fotos()->detach();
            $newsletter->noticias()->detach();

            $news = NewsletterNoticia::whereNewsletterId($newsletter->id)->get();

            foreach ($news as $new){
                $noti = Noticia::whereId($new->noticia->id)->first();
                $data_noti['public'] = 'n';
                $data_noti['newsletter_id'] = null;
                $noti->fill($data_noti);
                $noti->save();
                $new->delete();
            }
            $newsletter->delete();
            $request->session()->flash('msg', 'Newsletter deletada com sucesso');
            return redirect()->route('admin.newsletters.index');
        }
    }
}
