<?php

namespace App\Http\Controllers;

use App\Forms\RetrancaForm;
use App\Models\Retranca;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RetrancaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *  @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search == null){
            $retrancas = Retranca::paginate();
            return view('admin.retrancas.index', compact('retrancas'));
        }else{
            $retrancas = Retranca::where('nome', 'LIKE', '%'.$search.'%')
                ->paginate();
            return view('admin.retrancas.index', compact('retrancas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(RetrancaForm::class, [
            'url' => route('admin.retrancas.store'),
            'method' => 'POST'
        ]);

        return view('admin.retrancas.create', compact('form'));
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
            'nome' => ['required', 'string', 'max:255', 'min:3'],
        ], [
            'nome.required' => 'Informe o nome da Editoria',
            'nome.max' => 'O nome da editoria não pode ter mais que 250 caracteres',
            'nome.min' => 'O nome da editoria precisa de pelo menos 3 caracteres',
        ])->validate();
        Retranca::create($data);
        $request->session()->flash('msg', 'Editoria criada com sucesso');
        return redirect()->route('admin.retrancas.index');
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
     * @param  Retranca $retranca
     * @return View
     */
    public function edit(Retranca $retranca)
    {
        $form = \FormBuilder::create(RetrancaForm::class, [
            'url' => route('admin.retrancas.update', ['retranca' => $retranca->id]),
            'method' => 'PUT',
            'model' => $retranca,
            'data' => ['id' => $retranca->id],
        ]);

        return view('admin.retrancas.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Retranca $retranca
     * @return RedirectResponse
     */
    public function update(Request $request, Retranca $retranca)
    {
        $data = $request->all();

        $retranca->fill($data);
        $retranca->save();

        $request->session()->flash('msg', 'Editoria atualizada com sucesso!');
        return redirect()->route('admin.retrancas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param  Retranca $retranca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Retranca $retranca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return RedirectResponse
     */
    public function apagar(Request $request, $id)
    {
        $retranca = Retranca::whereId($id)->first();
        if ($retranca != null){
            $retranca->delete();
        }
        $request->session()->flash('msg', 'Editoria deletada com sucesso');
        return redirect()->route('admin.retrancas.index');
    }
}
