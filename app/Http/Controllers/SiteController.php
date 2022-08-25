<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\NewsletterNoticia;
use App\Models\Rate;
use App\Models\Retranca;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $rates = Rate::where([
            ['public', '=', 's'],
            ['nota', '>=', '4']
        ])->inRandomOrder()->limit(5)->get();
        return view('welcome', compact('rates'));
    }

    public function oldnews()
    {
        $newsletters = Newsletter::orderByDesc('numb_edicao')->paginate();
        return \view('newsletters.index', compact('newsletters'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        return \view('newsletters.show', compact('newsletter', 'noti_hists',
            'noti_aindas', 'noti_etcs', 'noti_disses', 'noti_dinhes', 'noti_planes', 'noti_cuidas', 'noti_cults'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
