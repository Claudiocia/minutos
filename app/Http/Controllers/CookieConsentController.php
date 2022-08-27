<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieConsentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $data = $request['kook'];
        if ($data == 1){
            Cookie::queue('cookie-consent', 1, 60 * 24 * 365);
        }else{
            Cookie::queue('cookie-consent', 1, 2);
        }
        return redirect()->back();
    }
}
