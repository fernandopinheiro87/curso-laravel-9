@extends('layouts.app')

@section('title', 'listagem do usuario')


@section('content')
<h1>Listagem do usuario {{$user->name}}</h1>

<form action="{{route('users/delete', $user->id)}}" method="POST">
    @method('DELETE')
    @csrf
    <button type="submit">Deletar</button>
</form>
@endsection


