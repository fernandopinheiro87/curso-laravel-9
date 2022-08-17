@extends('layouts.app')


@section('title', "Comentarios do usuario {{$user->name}} ")
    

@section('content')
<h1>Listagem de comentários
    (<a href="{{route('comments/create', $user->id)}}">+</a>)
</h1>

<form action="{{route('comments/index', $user->id)}}" method="get">
    <input type="text" name="search" placeholder="Pesquisar">
    <button>Pesquisar</button>
</form>

<ul>
    @foreach($comments as $comment)
        <li>
            Comentário: {{ $comment->id }}  = {{ $comment->body }} 
            
            <a href="{{route('comments/edit', ['user'=>$user->id, 'id' => $comment->id] ) }}"> Editar comentário</a>
        </li>
    @endforeach
</ul>
@endsection