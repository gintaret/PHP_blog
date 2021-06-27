@extends('main')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @include('_partials/errors')
{{--            jeigu norime su forma uploadinti failus (kad http protokolo pagalba galetume perduoti faila i serveri), butina prisideti enctype; tik tada galime siusti faila i serveri--}}
            <form action="/store" method="post" enctype="multipart/form-data">
{{--                isidedame token del saugumo, svarbu, kad galetume submitinti forma; token'as - simboliu seka ir Laravelis zino, kad sita forma siunciama is aplikacijos --}}
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Pavadinimas" name="title">
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Turinys" name="body"></textarea>
                </div>
{{--                toliau fieldas, leidziantis prikabinti faila --}}
                <div class="form-group custom-file offset-md-3 col-md-6 mb-3 mb-md-0">
                    <input type="file" class="custom-file-input text-black" name="img" id="postimg" lang="lt">
                    <label class="custom-file-label text-black" for="listingImage">Pasirinkite failą</label>
                </div>
                <button type="submit" class="btn btn-primary">Saugoti</button>
            </form>
        </div>
    </div>
@endsection
