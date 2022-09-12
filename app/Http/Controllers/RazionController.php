<?php

namespace App\Http\Controllers;

use App\Forms\RazionForm;
use App\Models\Razion;
use App\Models\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RazionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(RazionForm::class, [
            'url' => route('admin.razions.store'),
            'method' => 'POST',
        ]);
        return \view('admin.razions.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $site = Site::first();
        if ($data['title_section'] != $site->title_razion){
            $data2['title_razion'] = $data['title_section'];
            $site->fill($data2);
            $site->save();
        }
        unset($data['title_section'], $data['razion']);
        Razion::create($data);

        $request->session()->flash('msg', 'Razão criada com sucesso');
        return redirect()->route('admin.sites.index');
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
     * @param  Razion $razion
     * @return View
     */
    public function edit(Razion $razion)
    {
        $form = \FormBuilder::create(RazionForm::class, [
            'url' => route('admin.razions.update', ['razion' => $razion->id]),
            'method' => 'PUT',
            'model' => $razion,
        ]);

        return \view('admin.razions.edit', compact('form', 'razion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Razion $razion
     * @return RedirectResponse
     */
    public function update(Request $request, Razion $razion)
    {
        $data = $request->all();
        $site = Site::first();
        if ($data['title_section'] != $site->title_razion){
            $data2['title_razion'] = $data['title_section'];
            $site->fill($data2);
            $site->save();
        }
        unset($data['title_section'], $data['razion']);
        $razion->fill($data);
        $razion->save();

        $request->session()->flash('msg', 'Razão atualizada com sucesso');
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
}
