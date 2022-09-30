<section class="causa-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 me-auto">
                <h2>{{$site->title_causa}}</h2>
                <h1 class="mb-4">{{$site->apoio_causa}}</h1>

                {!! $site->text_causa !!}

            </div>
            <div class="col-md-5">
                <img src="{{asset('site/img/apost.png')}}" alt="Image" class="img-fluid">
            </div>
        </div>
    </div>
</section>
