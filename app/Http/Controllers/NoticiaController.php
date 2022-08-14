<?php

namespace App\Http\Controllers;

use App\Forms\NoticiaForm;
use App\Forms\RelFotoNoticiaForm;
use App\Models\Foto;
use App\Models\Noticia;
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
        $search = $request->get('search');
        if ($search == null) {
            $noticias = Noticia::with('fotos', 'newsletters')->orderBy('data_cria', 'ASC')
                ->paginate();

            return view('admin.noticias.index', compact('noticias'));
        }else{
            $noticias = Noticia::where('title', 'LIKE', '%'.$search.'%')
                ->orWhere('resumo', 'LIKE', '%'.$search.'%')
                ->orWhere('texto', 'LIKE', '%'.$search.'%')
                ->orderBy('data_cria', 'ASC')->paginate();

            return view('admin.noticias.index', compact('noticias'));
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
        $form = \FormBuilder::create(RelFotoNoticiaForm::class, [
            'url' => route('admin.noticias.update', ['noticia' => $noticia->id]),
            'method' => 'PUT',
            'model' => $noticia,
        ]);

        return \view('admin.noticias.foto-rel', compact('form', 'noticia'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Noticia $noticia
     * @return View
     */
    public function show(Noticia $noticia)
    {
        $noticia = Noticia::whereId($noticia->id)->with('fotos', 'newsletters')->first();
        //dd($noticia);
        return view('admin.noticias.show', compact('noticia'));
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
        if (key_exists('foto_id', $data)){
            $fotos = Foto::whereIn('id', $data['foto_id'])->get();
            $noticia->fotos()->sync($fotos, false);
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
