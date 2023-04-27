@extends('layouts.cadcli')

@section('conteudo')
    <div class="row align-items-center flex-column">
        <div id="assin-content">
            <div class="container-assin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-assin">
                                <h5>Faça a sua assinatura 100% gratuita</h5>
                            </div>
                            <x-jet-validation-errors class="mb-3" />
                            <div class="panel-body">
                                <div name="logo">
                                    <a href="{{route('/')}}"><x-jet-authentication-card-logo /></a>
                                </div>
                                <div class="row">
                                    <h6 style="text-align: center">
                                        Você está prestes a entrar para um seleto grupo de pessoas bem informadas
                                        ligadas nos assuntos mais essenciais do dia!
                                    </h6>
                                </div>
                                <div class="row">
                                    <!-- Begin Mailchimp Signup Form -->
                                    <link href="//cdn-images.mailchimp.com/embedcode/classic-071822.css" rel="stylesheet" type="text/css">
                                    <style type="text/css">
                                        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif;  width:600px;}
                                        /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                                           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                                    </style>
                                    <div id="mc_embed_signup">
                                        <form action="https://canalminutos.us12.list-manage.com/subscribe/post?u=65762eb9a3c433f0eb1006f9c&amp;id=54ce8f8f9c&amp;f_id=00f2b0e0f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                            <div id="mc_embed_signup_scroll">
                                                <h2>Subscribe</h2>
                                                <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                                                <div class="mc-field-group">
                                                    <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
                                                    </label>
                                                    <input type="email" value="{{$cliente->email}}" name="EMAIL" class="required email" id="mce-EMAIL" required>
                                                    <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
                                                </div>
                                                <div class="mc-field-group">
                                                    <label for="mce-FNAME">First Name </label>
                                                    <input type="text" value="{{$cliente->name}}" name="FNAME" class="" id="mce-FNAME">
                                                    <span id="mce-FNAME-HELPERTEXT" class="helper_text"></span>
                                                </div>
                                                <div hidden="true"><input type="hidden" name="tags" value="10412981"></div>
                                                <div id="mce-responses" class="clear">
                                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_65762eb9a3c433f0eb1006f9c_54ce8f8f9c" tabindex="-1" value=""></div>
                                                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
                                    <script type='text/javascript'>
                                        (function($) {
                                            window.fnames = new Array();
                                            window.ftypes = new Array();
                                            fnames[0]='EMAIL';
                                            ftypes[0]='email';
                                            fnames[1]='FNAME';
                                            ftypes[1]='text';
                                            fnames[2]='LNAME';
                                            ftypes[2]='text';
                                            fnames[3]='ADDRESS';
                                            ftypes[3]='address';
                                            fnames[4]='PHONE';
                                            ftypes[4]='phone';
                                            fnames[5]='BIRTHDAY';
                                            ftypes[5]='birthday';
                                        }
                                        (jQuery));
                                        var $mcj = jQuery.noConflict(true);
                                    </script>
                                    <!--End mc_embed_signup-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


