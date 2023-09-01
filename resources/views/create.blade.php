@extends('layouts.app')


@section('content') 
<!-- resources/views/shortened/create.blade.php -->
<h1  class="text-center  pb-2 mb-4 text-success ">Short URL</h1>
<div class="w-50 container shadow card p-4  bg-white   ">

    <form method="POST" class="text-center" action="/shorten">
        <h2><b>Paste the URL to be shortened</b></h2>
            @csrf
            <input class="form-control" type="text" name="original_url" placeholder="Enter URL">
            @error('original_url')
                <span class="text-danger m-2 p-2"> {{$message}}</span>
            @enderror
            <button class="btn btn-success" type="submit">Shorten</button>
    </form>
        @if (session('success'))
            <h2>Your link is:</h2>
            <a href="{{ session('success') }}">{!! session('success') !!}</a>
        @endif

        @if (session('error'))
            <div class="text-black">{{ session('error') }}</div>
        @endif
</div>
<div class="table-responsive container   w-75 mb-4">
    {{-- @if (session('data')) --}}
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Shorte link </th>
                    <th scope="col">visistes</th>
                    <th scope="col">Action</th>
                    
                </tr>
            </thead>
            <tbody>
            
                @foreach ($data as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    
                    <th > <a  href="{{$item->shortened_url}}"> http://127.0.0.1:8000/{{$item->shortened_url}}</a></th>
                    <td>{{$item->visits}}</td>
                    <td>
                        <form method="POST" class="text-center" action="{{ route('link_delete', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mx-0" type="submit">Delete</button>
                        </form>
                </tr>
                @endforeach
            
            </tbody>
        </table>
    {{-- @endif --}}
</div>


@endsection