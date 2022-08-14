@extends('layouts.admin')

@section('conteudo')

    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5>Upload de fotos</h5>
                            </div>
                            <div class="panel-body">
                                <div class="row btn-new-reset">
                                    {!! Button::primary('Voltar')->asLinkTo(route('admin.fotos.index')) !!}
                                </div>
                                <div class="form-admin">
                                    <form action="{{route('admin.fotos.store')}}" method="post" enctype="multipart/form-data">
                                        @method('POST')
                                        @csrf
                                        @if ($message = Session::get('msg'))
                                            <div class="alert alert-success">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @elseif($message = Session::get('erro'))
                                            <div class="alert alert-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif

                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="user-image mb-3 text-center">
                                            <div class="imgPreview d-flex"> </div>
                                        </div>

                                        <div class="custom-file">
                                            <input type="file" name="photoFile[]" class="custom-file-input" id="images" multiple="multiple">
                                            <label class="custom-file-label" for="images">Escolha as imagens</label>
                                        </div>
                                        <div class="custom-file mt-2">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="using">Uso das Fotos</label>
                                                </div>
                                                <select class="custom-select" id="using" name="using">
                                                    <option selected value="">Escolher...</option>
                                                    <option value="Notícia">Notícia</option>
                                                    <option value="Newsletter">Newsletter</option>
                                                    <option value="Site">Site</option>
                                                    <option value="Parceiro">Parceiro</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                            Upload Imagens
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>
@endsection
