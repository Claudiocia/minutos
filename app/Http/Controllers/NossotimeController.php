<?php

namespace App\Http\Controllers;

use App\Forms\NossotimeForm;
use App\Forms\RelFotoNossotimeForm;
use App\Models\Foto;
use App\Models\Nossotime;
use App\Models\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NossotimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $nossotimes = Nossotime::with('foto')->orderByDesc('nome')->paginate();
        return view('admin.nossotimes.index', compact('nossotimes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(NossotimeForm::class, [
            'url' => route('admin.nossotimes.store'),
            'method' => 'POST'
        ]);

        return \view('admin.nossotimes.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     *
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(NossotimeForm::class);
        $data = $form->getFieldValues();

        \Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'funcao'=> $data['funcao'] == 'Selecione...' ? ['required'] : [''],
            'texto' => ['required', 'min:30'],
        ])->validate();
        Nossotime::create($data);
        $request->session()->flash('msg', 'Registro criado com sucesso');
        return redirect()->route('admin.nossotimes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Nossotime $nossotime
     * @return View
     */
    public function photorel(Nossotime $nossotime)
    {
        $fotos = Foto::whereUsing('site')->get();
        $form = \FormBuilder::create(RelFotoNossotimeForm::class, [
            'url' => route('admin.nossotimes.update', ['nossotime' => $nossotime->id]),
            'method' => 'PUT',
            'model' => $nossotime,
        ]);

        return \view('admin.nossotimes.foto-rel', compact('form', 'nossotime', 'fotos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Nossotime $nossotime
     * @return View
     */
    public function show(Nossotime $nossotime)
    {
        return \view('admin.nossotimes.show', compact('nossotime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Nossotime $nossotime
     * @return View
     */
    public function edit(Nossotime $nossotime)
    {
        $form = \FormBuilder::create(NossotimeForm::class, [
            'url' => route('admin.nossotimes.update', ['nossotime' => $nossotime->id]),
            'method' => 'PUT',
            'model' => $nossotime,
        ]);
        return \view('admin.nossotimes.edit', compact('form', 'nossotime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Nossotime $nossotime
     * @return RedirectResponse
     */
    public function update(Request $request, Nossotime $nossotime)
    {
        $data = $request->all();
        if ($data['foto']){
            if (key_exists('foto_id', $data)){
                $nossotime->fill($data);
                $nossotime->save();
                $request->session()->flash('msg', 'Foto anexada com sucesso!');
            }else{
                if ($nossotime->foto_id != null){
                    $data['foto_id'] = null;
                    $nossotime->fill($data);
                    $nossotime->save();
                    $request->session()->flash('msg', 'Foto separada do colaborador!');
                }

            }
        }else {
            $nossotime->fill($data);
            $nossotime->save();
            $request->session()->flash('msg', 'Dados do colaborador atualizado com sucesso!');
        }
        return  redirect()->route('admin.nossotimes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param  Nossotime $nossotime
     * @return RedirectResponse
     */
    public function destroy(Request $request, Nossotime $nossotime)
    {
        $nossotime->delete();
        $request->session()->flash('msg', 'Colaborador deletado com sucesso!');
        return redirect()->route('admin.nossotimes.index');
    }
}
