<?php

namespace App\Http\Controllers;

use App\Forms\NoticiaForm;
use App\Forms\RelFotoNoticiaForm;
use App\Models\Foto;
use App\Models\Newsletter;
use App\Models\NewsletterNoticia;
use App\Models\Noticia;
use App\Models\Retranca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $editorias = Retranca::all();
        $search = $request->get('search');
        $editoria = $request->get('editoria');
        $public = $request->get('public');

        if ($search == null && $editoria == null && $public == null) {
            $noticias = Noticia::with('fotos', 'newsletter')->orderBy('created_at', 'DESC')
                ->paginate(8);
            return view('admin.noticias.index', compact('noticias', 'editorias'));
        }elseif ($search != null && $editoria == null && $public == null){
            $noticias = Noticia::where('title', 'LIKE', '%'.$search.'%')
                ->orWhere('resumo', 'LIKE', '%'.$search.'%')
                ->orWhere('texto', 'LIKE', '%'.$search.'%')
                ->orderBy('data_cria', 'ASC')->paginate(1000);

            return view('admin.noticias.index', compact('noticias', 'editorias'));
        }elseif ($search == null && $editoria != null && $public == null){
            $noticias = Noticia::whereRetrancaId($editoria)->paginate(1000);
            return view('admin.noticias.index', compact('noticias', 'editorias'));
        }elseif ($search == null && $editoria == null && $public != null){
            $noticias = Noticia::public($public)->orderBy('id', 'ASC')->paginate(1000);
            return view('admin.noticias.index', compact('noticias', 'editorias'));
        }elseif ($search == null && $editoria != null && $public != null){
            $noticias = Noticia::public($public)->where('retranca_id', '=', $editoria)->paginate(1000);
            return view('admin.noticias.index', compact('noticias', 'editorias'));
        }elseif ($search != null && $editoria == null && $public != null){
            $noticias = Noticia::public($public)->where('texto', 'LIKE', '%'.$search.'%')->paginate(1000);
            return view('admin.noticias.index', compact('noticias', 'editorias'));

        }elseif ($search != null && $editoria != null && $public == null){
            $noticias = Noticia::busca($search)->where('retranca_id', '=', $editoria)->paginate(1000);
            return view('admin.noticias.index', compact('noticias', 'editorias'));
        }elseif ($search != null && $editoria != null && $public != null){
            $noticias = Noticia::busca($search)->public($public)->where('retranca_id', '=', $editoria)->paginate(1000);
           return view('admin.noticias.index', compact('noticias', 'editorias'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(NoticiaForm::class, [
           'url' => route('admin.noticias.store'),
           'method' => 'POST'
        ]);

        return view('admin.noticias.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(NoticiaForm::class);
        $data = $form->getFieldValues();

        \Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'resumo' => ['required', 'string', 'max:255'],
            'texto' => ['required'],
            'retranca_id' => ['required'],
            'fonte' => ['required'],
        ], [
            'title.required' => 'Favor dar um título para a noticia',
            'title.max' => 'O tamanho máximo do título são 255 caracteres',
            'resumo.required' => 'Favor fazer um resumo da notícia',
            'resumo.max' => 'O tamanho máximo do resumo são 255 caracteres',
            'texto.required' => 'Faltou o texto da notícia',
            'retranca_id.required' => 'Selecione uma Editoria!',
            'fonte.required' => 'Informar a fonte da notícia é obrigatório!',
        ])->validate();
        $data['data_cria'] = now();

        //dd($data);
        Noticia::create($data);

        $request->session()->flash('msg', 'Notícia cadastrada com sucesso');
        return redirect()->route('admin.noticias.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  Noticia $noticia
     * @return View
     */
    public function photorel(Noticia $noticia)
    {
        $id = $noticia->id;
        $noticia = Noticia::whereId($id)->with('fotos')->first();
        $retranca = Retranca::with('fotos')->whereId($noticia->retranca_id)->first();
        $form = \FormBuilder::create(RelFotoNoticiaForm::class, [
            'url' => route('admin.noticias.update', ['noticia' => $noticia->id]),
            'method' => 'PUT',
            'model' => $noticia,
        ]);

        return \view('admin.noticias.foto-rel', compact('form', 'noticia', 'retranca'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Noticia $noticia
     * @return View
     */
    public function show(Noticia $noticia)
    {
        $noticia = Noticia::whereId($noticia->id)->with('fotos', 'newsletter')->first();
        //dd($noticia);
        return view('admin.noticias.show', compact('noticia'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return View
     */
    public function showPublic($id)
    {
        $newsletter = Newsletter::with('fotos')->first();//alterar essa busca para pegar só as enviadas
        $noticias = NewsletterNoticia::whereEditoria($id)->with('noticia')
            ->orderByDesc('id')->get();
        $slot = false;
        //dd($noticias);
        return view('noticias.show', compact('noticias', 'newsletter', 'slot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Noticia $noticia
     * @return View
     */
    public function edit(Noticia $noticia)
    {
        $form = \FormBuilder::create(NoticiaForm::class, [
            'url' => route('admin.noticias.update', ['noticia' => $noticia->id]),
            'method' => 'PUT',
            'model' => $noticia,
        ]);

        return \view('admin.noticias.edit', compact('form', 'noticia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Noticia $noticia
     * @return RedirectResponse
     */
    public function update(Request $request, Noticia $noticia)
    {
        $data = $request->all();

        if($data['foto']){
            if(key_exists('foto_id', $data)) {
                $noticia->fotos()->sync($data['foto_id']);
            }else{
                $noticia->fotos()->detach();
            }
        }else{
            $data['data_edit'] = now();
        }

        $noticia2 = Noticia::whereId($noticia->id)->with('fotos')->first();
        $noticia2->fill($data);
        $noticia2->save();

        $request->session()->flash('msg', 'Noticia atualizada');
        return redirect()->route('admin.noticias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param  Noticia $noticia
     * @return RedirectResponse
     */
    public function destroy(Request $request, Noticia $noticia)
    {
        $noticia->fotos()->detach();
        $noticia->delete();

        $request->session()->flash('msg', 'Noticia deletada com sucesso');
        return redirect()->route('admin.noticias.index');

    }
}
