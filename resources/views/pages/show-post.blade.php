@extends('main')
@section('content')
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
{{--            foreach nebereikia, nes graziname tik viena posta --}}
            <!-- Post preview-->
                <div class="post-preview">
                        <h3 class="post-title">{{$post->title}}</h3>
                        <h8 class="post-subtitle">{{$post->content}}</h8>
                </div>
{{--            <img src="{{$post->img}}" alt="{{$post->title}}">--}}
            <div>
                <div class="card">
                    <div class="card-block">
                        <form action="/post/{{$post->id}}/comment" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <textarea name="body" placeholder="Jūsų komentaras" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Komentuoti</button>
                            </div>
                        </form>
                    </div>
                </div>
{{--                toliau atvaizduojame komentarus --}}
                <div class="comments">
                    <ul>
{{--                        grizta ne tik postas, bet ir jo komentarai--}}
                        @foreach($post->comments as $comment)
                            <li>{{$comment->comment}}</li>
                        @endforeach
                    </ul>
                </div>
                <p>Veiksmai:</p>
                <ul>
                    <li><a href="/delete/{{$post->id}}" onclick="return confirm('Ar tikrai norite ištrinti šį įrašą?')">Šalinti</a></li>
{{--                    <li><a href="/delete/{{$post->id}}">Šalinti</a></li>--}}
                    <li><a href="/update/{{$post->id}}">Redaguoti</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
