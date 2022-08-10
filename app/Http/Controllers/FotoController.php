<?php

namespace App\Http\Controllers;

use App\Forms\FotoForm;
use App\Models\Foto;
use App\Utils\DefaultFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Intervention\Image\File;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fotos = Foto::orderBy('using', 'ASC')->paginate(8);
        return view('admin.fotos.index', compact('fotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.fotos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'photoFile.*' => 'mimes:jpeg,jpg,png,gif',
            'using' => $data['using'] == null ? ['required'] : '',
        ],
        [
            'photoFile.*.mimes' => 'O arquivo precisa ser no formato de imagens',
            'using.required' => 'Precisa escolher o uso da foto',
        ]);


        //max:2048
        if ($request->hasFile('photoFile')){
            foreach($request->file('photoFile') as $file)
            {
                $origName = $file->getClientOriginalName();

                if ($file->getSize() > 2048){
                    $width = 800;
                    $heigth = 600;

                    list($width_oring, $heigth_orig) = getimagesize($file);
                    $ratio_orig = $width_oring/$heigth_orig;

                    if($width/$heigth > $ratio_orig){
                        $width = $heigth*$ratio_orig;
                    }else{
                        $heigth = $width/$ratio_orig;
                    }
                    $img = Image::make($file)->resize($width, $heigth);
                    $img->save($file);
                }else{
                    $img = Image::make($file);
                    $img->save($file);
                }
                $name = md5("-{$file->getClientOriginalName()}")."-".time().".{$file->guessExtension()}";
                $pasta = DefaultFunctions::tirarAcentos($request['using']);
                $file->move(public_path().'/uploads/'.$pasta, $name);

                $fotoModel = new Foto();
                $fotoModel->nome = $name;
                $fotoModel->foto_path = '/uploads/'.$pasta.'/'.$name;
                $fotoModel->foto_thumb = '/uploads/'.$pasta.'/'.$name;
                $fotoModel->origin_name = $origName;
                $fotoModel->using = $request['using'];

                $fotoModel->save();
            }
            return back()->with('msg', 'Fotos salvas com sucesso');
        }else {
            return back()->with('erro', 'Selecione pelo menos um arquivo!');
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  Foto $foto
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Foto $foto)
    {
        return view('admin.fotos.show', compact('foto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Foto $foto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $foto)
    {
        $form = \FormBuilder::create(FotoForm::class, [
            'url' => route('admin.fotos.update', ['foto' => $foto->id]),
            'method' => 'PUT',
            'model' => $foto,
            'data' => ['id' => $foto->id]
        ]);

        return view('admin.fotos.edit', compact('form', 'foto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Foto $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        $data = $request->all();
        $foto->fill($data);
        $foto->save();

        $request->session()->flash('msg', 'Dados da foto atualizados');
        return redirect()->route('admin.fotos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Foto $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Foto $foto)
    {
        if (\Storage::disk('public')->exists($foto->nome)){
            \Storage::disk('public')->delete($foto->nome);
        }
        if(\File::exists(public_path().$foto->foto_path)){
            \File::delete(public_path().$foto->foto_path);
        }else{
            $request->session()->flash('msg', 'Esta foto não existe no file');
            return redirect()->route('admin.fotos.index');
        }
        $foto->delete();
        $request->session()->flash('msg', 'Foto deletada com sucesso');
        return redirect()->route('admin.fotos.index');
    }
}
