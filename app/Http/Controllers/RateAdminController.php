<?php

namespace App\Http\Controllers;

use App\Forms\RateForm;
use App\Models\Rate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RateAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $media = Rate::avg('nota');
        $search = $request->get('search');
        if($search == null){
            $rates = Rate::with('cliente')->orderBy('id', 'DESC')->paginate();
            return view('admin.rates.index', compact('rates', 'media'));
        }elseif ($search == 'altas'){
            $rates = Rate::where('nota', '>=', '3')->orderBy('id', 'DESC')->paginate();
            return view('admin.rates.index', compact('rates', 'media'));
        }elseif ($search == 'baixas'){
            $rates = Rate::where('nota', '<=', '3')->orderBy('id', 'DESC')->paginate();
            return view('admin.rates.index', compact('rates', 'media'));
        }elseif ($search == 'public'){
            $rates = Rate::wherePublic('n')->orderBy('id', 'DESC')->paginate();
            return view('admin.rates.index', compact('rates', 'media'));
        }else{
            $rates = Rate::where('title', 'LIKE', '%'.$search.'%')
                ->orWhere('texto', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'DESC')->paginate();
            return view('admin.rates.index', compact('rates', 'media'));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  Rate $rate
     * @return View
     */
    public function show(Rate $rate)
    {
        return view('admin.rates.show', compact('rate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Rate $rate
     * @return View
     */
    public function edit(Rate $rate)
    {
        $form = \FormBuilder::create(RateForm::class, [
            'url' => route('admin.rates.update', ['rate' => $rate->id]),
            'method' => 'PUT',
            'model' => $rate,
            'data' => ['id' => $rate->id],
        ]);

        return view('admin.rates.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Rate $rate
     * @return RedirectResponse
     */
    public function update(Request $request, Rate $rate)
    {
        $data = $request->all();
        \Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'texto' => ['required', 'max:255']
        ], [
            'title.required' => 'Dê um título para a avaliação',
            'texto.required' => 'O Campo Comentário é Obrigatorio'
        ])->validate();

        if ($rate->public == $data['public']){
           return redirect()->route('admin.rates.index');
        }
        $rate->fill($data);
        $rate->save();

        $request->session()->flash('msg', 'Alteração salva com sucesso!');
        return redirect()->route('admin.rates.index');
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
}
