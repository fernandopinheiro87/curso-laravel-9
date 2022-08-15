@extends('layouts.app')

@section('title', 'Criar usuario')


@section('content')
<h1>Novo usuario</h1>

@include('includes.validations-form')

<form action="{{route('users/store')}}" method="post">
    @csrf
    @include('users._partials.form')
</form>
@endsection


