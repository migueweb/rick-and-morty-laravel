@extends('layouts.app')
@section('main-content')
<div class="container p-4">

    <img src="{{ $character['image'] }}" class="img-fluid rounded-top" alt="{{ $character['name'] }}">
    
    <h1 class="text-white text-xl">{{ $character['name'] }}</h1>
    <p class="mb-3 text-gray-700 dark:text-gray-300"><b>Status:</b> {{ $character['status'] }}</p>
    <p class="mb-3 text-gray-700 dark:text-gray-300"><b>Species:</b> {{ $character['species'] }}</p>
    <p class="mb-3 text-gray-700 dark:text-gray-300"><b>Gender:</b> {{ $character['gender'] }}</p>
    <p class="mb-3 text-gray-700 dark:text-gray-300"><b>Origin:</b> {{ $character['origin']['name'] }}</p>
    <p class="mb-3 text-gray-700 dark:text-gray-300"><b>Location:</b> {{ $character['location']['name'] }}</p>
</div>
@endsection