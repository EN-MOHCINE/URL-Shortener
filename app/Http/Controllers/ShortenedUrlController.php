<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortenedUrl;
use Illuminate\Support\Str;


class ShortenedUrlController extends Controller
{
    
    public function create()
{
    $data = ShortenedUrl::orderBy( "visits","DESC")->get();
    return view('create' ,compact('data'));
}

public function store(Request $request)
{
    $request->validate([
        'original_url' => 'required|url',
    ]);

    $originalUrl = $request->input('original_url');
    $shortenedUrl = Str::random(6); // Generate a random short URL
    // $shortenedUrl = base_convert($originalUrl->id,10,36); // Generate a random short URL

    ShortenedUrl::create([
        'original_url' => $originalUrl,
        'shortened_url' => $shortenedUrl,
    ]);
    $data = ShortenedUrl::orderBy( "visits","DESC")->get();

    return redirect('/')->with('success', url($shortenedUrl)) ;
}

public function redirect($shortened)
{
    $url = ShortenedUrl::where('shortened_url', $shortened)->first();

    if (!$url) {
        return redirect('/')->with('error', 'Shortened URL not found.');
    }
    $url->increment('visits') ;
    return redirect($url->original_url);
}

public  function delete($id) {
    // dd($id) ;
    $to_delete = ShortenedUrl::findOrFail($id);
        $to_delete->delete();
        return redirect("/"); 
}
}
