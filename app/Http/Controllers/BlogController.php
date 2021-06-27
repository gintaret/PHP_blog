<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index','show']]); // [] reiskia isskyrus (cia apibreziame, kad visiems metodams reikia prisijungimo, isskyrus neprisijunges vartotojas gali matyti pagrindini puslapi index bei show (issikleisti kiekviena posta)
    }

    public function index(){ //susikuriame metoda, kuris grazins pradini puslapi
        $posts = Post::paginate(4); //norime ne tik pradinio puslapio, bet ir duomenu (Post - musu modelis); rodys 4 postus puslapyje
        return view('pages.home', compact('posts')); //return view (pages.home) - grazina pradini puslapi; compact('posts) - siunciame i sablona post
    }

    public function createPost(){ //susikuriame metodą kontroleryje, kuris grazina mums formą

        return view('pages.add-post');
    }

    public function store(Request $request){ //metodas, skirtas saugojimui; kadangi siunciame duomenis metodo POST pagalba, t.y. darome requesta, todel turime isideti i metodo parametrus Request,kuris priskiriamas kintamajam $request. Cia $request reikalingas, kad galeciau paimti duomenis is formos, kuriuos siunciu, kai paspaudziu mygtuka saugoti
        $validateData = $request->validate([ //pries posto sukurima bus patikrinama, ar duomenys atitinka sias taisykles (ar validus) ir toliau errors.blade apsirasome klaidu isvedima; po to add-post pries forma @include errors
           'title' => 'required|unique:posts|max:255', //norime, kad title butu privalomas|unikalus|max 255 simboliai
           'body' => 'required',
            'img' => 'mimes:jpg,jpeg,png|required|max: 10000' //be paveikslelio neleis issaugoti posto, nes padareme required (bet migration faile img nullable galima palikti)
        ]);
        $path = $request->file('img')->store('public/images');
        $filename = str_replace('public/', "", $path); //susikuriu kintamaji, kuri priskirsiu tik paveikslelio pavadinimui; $path - paduodame pilna kelia su visais aplanku pavadinimais
//        toliau darome pagal modeli Post
        Post::create([
            'title' => request('title'), //add-post formoje name yra title, todel key: 'title'
            'content' => request('body'),
            'img' => $filename, //filename saugo failo pavadinima
            'user_id' => Auth::id() //kuriant posta paimamas userio id ir zinome, kas sukure posta
        ]);

        return redirect('/'); //kai postas sukuriamas, nukreips i pradini puslapi
    }

    public function show(Post $post){ //paduodame pati posta i metoda pagal posto id (cia kai uzvede su pelyte matome linka ant posto, pvz, /post/1)

        return view('pages.show-post', compact('post')); //graziname viena konkretu posta; show-post yra musu sablonas, o su compact('post) nusisiunciame konkretaus posto duomenis
    }

    public function destroy(Post $post){
        if(Gate::allows('delete',$post)){
            $post->delete();
        return redirect('/');
        }
        dd('Klaida: jus neturite teises');
    }

    public function update(Post $post){
        if(Gate::allows('update',$post)){
        return view('pages.update', compact('post'));
        }
        dd('Klaida: jus neturite teises');
    }

    public function storeUpdate(Request $request, Post $post){
        if($request->file()){ //patikriname, ar buvo prikabintas failas
            Storage::delete('app/public'.$post->img); //istriname faila, kai koreguojame posta
            $path = $request->file('img')->store('public/images'); //ikeliame faila
            $filename = str_replace('public/', "", $path);
            Post::where('id', $post->id)->update(['img' =>$filename]); //pakeiciame nauju failu DB
        }
        Post::where('id',$post->id)->update($request->only(['title', 'content'])); //su where is DB atsirenkame posta, kuri norime redaguoti (pagal posto id), ir update - imame tik title ir content

        return redirect('/post/'.$post->id);
    }
}
