@extends('layouts.app')


@section('title', "listagem dos usuarios")
    

@section('content')
<h1>Listagem do usuario
    (<a href="{{route('users/create')}}">+</a>)
</h1>

<form action="{{route('users/index')}}" method="get">
    <input type="text" name="search" placeholder="Pesquisar">
    <button>Pesquisar</button>
</form>

<ul>
    @foreach($users as $user)
        <li>
            @if ($user->image)
                <img src="{{url("storage/{$user->image}") }}" alt="{{$user->name}}"> -    
            @else
                <img src="{{url("favicon.ico") }}" alt="{{$user->name}}"> -   
            @endif
            
            {{ $user->name }} - 
            {{ $user->email }} |
            
            <a href="{{route('users/show', $user->id)}}"> Ver usuario</a> |
            <a href="{{route('users/edit', $user->id)}}"> Editar usuario</a>
            <a href="{{route('comments/index', $user->id)}}"> Ver comentários ({{$user->comments->count()}})</a>
        </li>
    @endforeach
</ul>

<div class="app">
    {{$users->appends([
        'search' =>request()->get('search','')
    ])->links()}}
</div>
@endsection
