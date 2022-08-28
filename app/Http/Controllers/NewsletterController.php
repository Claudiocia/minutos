<?php

namespace App\Http\Controllers;

use App\Forms\NewsletterForm;
use App\Forms\RelFotoNewsletterForm;
use App\Models\Foto;
use App\Models\Newsletter;
use App\Models\NewsletterNoticia;
use App\Models\Noticia;
use App\Models\Retranca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        $form = \FormBuilder::create(NewsletterForm::class, [
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
        $form = \FormBuilder::create(NewsletterForm::class);
        $data = $form->getFieldValues();
        \Validator::make($data, [
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
        for($i=0; $i < $cont; $i++){
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
    public function photorel (Newsletter $newsletter)
    {
        $fotos = Foto::whereUsing('parceiro')->get();
        $form = \FormBuilder::create(RelFotoNewsletterForm::class, [
            'url' => route('admin.newsletters.update', ['newsletter' => $newsletter->id]),
            'method' => 'PUT',
            'model' => $newsletter,
        ]);

        return \view('admin.newsletters.foto-rel', compact('form', 'newsletter', 'fotos'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Newsletter $newsletter
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function disparaNews(Request $request, Newsletter $newsletter)
    {
        //
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

        $noti_hists = NewsletterNoticia::whereEditoria($ed_hist_id)->with('noticia')
            ->orderByDesc('id')->get();
        $noti_aindas = NewsletterNoticia::whereEditoria($ed_ainda_id)->with('noticia')
            ->orderByDesc('id')->get();
        $noti_etcs = NewsletterNoticia::whereEditoria($ed_etc_id)->with('noticia')
            ->orderByDesc('id')->get();
        $noti_disses = NewsletterNoticia::whereEditoria($ed_disse_id)->with('noticia')
            ->orderByDesc('id')->get();
        $noti_dinhes = NewsletterNoticia::whereEditoria($ed_dinhe_id)->with('noticia')
            ->orderByDesc('id')->get();
        $noti_planes = NewsletterNoticia::whereEditoria($ed_plane_id)->with('noticia')
            ->orderByDesc('id')->get();
        $noti_cuidas = NewsletterNoticia::whereEditoria($ed_cuida_id)->with('noticia')
            ->orderByDesc('id')->get();
        $noti_cults = NewsletterNoticia::whereEditoria($ed_cult_id)->with('noticia')
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

        $form = \FormBuilder::create(NewsletterForm::class, [
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
        //dd($data['foto']);
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
