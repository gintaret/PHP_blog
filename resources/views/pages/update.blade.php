@extends('main')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @include('_partials/errors')
            <form action="/storeupdate/{{$post->id}}" method="post" enctype="multipart/form-data">
                {{--                isidedame token del saugumo, svarbu, kad galetume submitinti forma; token'as - simboliu seka ir Laravelis zino, kad sita forma siunciama is aplikacijos --}}
                {{csrf_field()}}
                {{ method_field('PATCH') }}
                <div class="form-group">
{{--                    sekancioje eiluteje per value isidedame i forma duomenis, kuriuos atnaujinome--}}
                    <input type="text" class="form-control" placeholder="Pavadinimas" name="title" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Turinys" name="content">{{$post->content}}</textarea>
                </div>
                <div class="form-group custom-file offset-md-3 col-md-6 mb-3 mb-md-0">
                    <input type="file" class="custom-file-input text-black" name="img" id="postimg" lang="lt">
                    <label class="custom-file-label text-black" for="listingImage">Pasirinkite failą</label>
                </div>
                <button type="submit" class="btn btn-primary">Saugoti</button>
            </form>
        </div>
    </div>
@endsection
