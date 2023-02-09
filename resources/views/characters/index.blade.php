@extends('layouts.app')
@section('main-content')

<div class="container-lg">

    @foreach ($characters as $character)
            <div class="max-w-xl mt-8 mx-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                
                <img class="rounded-lg" src="{{ $character['image'] }}" alt="{{ $character['name'] }}" />

                <div class="p-4">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{$character['name']}}</h5>
                    
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><b>Status:</b> {{ $character['status'] }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><b>Species:</b> {{ $character['species'] }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><b>Gender:</b> {{ $character['gender'] }}</p>

                    <form action="{{route('characters.show', ['id' => $character['id']] )}}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="pt-4 dark:text-gray-100 dark:hover:text-gray-700 dark:bg-indigo-900">View</button>
                    </form>
                    
                    <form action="{{ route('characters.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="character_id"value="{{$character['id']}}">
                        <button type="submit" class="mt-4 pt-4 dark:text-gray-100 dark:hover:text-gray-700 dark:bg-indigo-900">
                            Add to favorite
                        </button>
                    </form>
                </div>
            </div>
    @endforeach
</div>
@endsection