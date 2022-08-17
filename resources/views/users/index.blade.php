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
            {{ $user->name }} - 
            {{ $user->email }} |
            
            <a href="{{route('users/show', $user->id)}}"> Ver usuario</a> |
            <a href="{{route('users/edit', $user->id)}}"> Editar usuario</a>
            <a href="{{route('comments/index', $user->id)}}"> Ver comentários ({{$user->comments->count()}})</a>
        </li>
    @endforeach
</ul>

<div>
    {{$users->appends([
        'search' =>request()->get('search','')
    ])->links()}}
</div>
@endsection
