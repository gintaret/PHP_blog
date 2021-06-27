@extends('main')
@section('content')
{{--    pirmoje eiluteje pasakome, kad paveldime main, antroje eiluteje - kad visas html pakliuna i sekcija--}}
<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
{{--        foreach reikalingas, kad grazintu visus postus--}}
        @foreach($posts as $post)
        <!-- Post preview-->
        <div class="post-preview">
{{--            Atidaromas postas naujame puslapyje --}}
{{--            Dvigubi riestiniai skliaustai reiskia isvedima --}}
{{--            sekancioje eiluteje $post->id nurodeme - tuomet uzvede su pelyte ant posto, matome linka, pvz /post/1--}}
            <a href="post/{{$post->id}}">
                <h4 class="post-title">{{$post->title}}</h4>
            </a>
            <img class="img-thumbnail" src="{{$post->img}}" alt="{{$post->title}}">
            <p class="post-subtitle">{{Str::limit($post->content,50)}}</p>
            <a href="/post/{{$post->id}}" class="btn btn-primary">Skaityti daugiau...></a>
            <p class="post-meta">
                Posted by
                <a href="#!">Gintarė</a>
                on September 24, 2021
            </p>
        </div>
        @endforeach
        <!-- Pager-->
        <div class="clearfix">
{{--            sekancioje eiluteje isidedame $posts->links, kad postais butu navigavimo mygtukai i sekanti puslapi paziureti kitus postus--}}
        {{$posts->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
@endsection
