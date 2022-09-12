<section class="step-section">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 step-title">
            <h1>Por que o minutos será relevante</h1>
            <h1>para o seu dia a dia</h1>
        </div>
        <div class="row justify-content-center text-center mb-5">
            <hr class="linha"/>
        </div>
        <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            @foreach($razions as $razion)
            <div class="col-md-4 col-6">
                <div class="justify-content-center">
                    <div class="row justify-content-center">

                        <div class="tampa"><img src="{{asset('site/icones/'.$razion->color.$razion->icon)}}" width="36" class="icon-svg"/> </div>

                    </div>
                </div>
                <div class="step">
                    <p>{{$razion->texto}}</p>
                </div>
            </div>
            @endforeach
        </div>
        </div>
    </div>
</section>
