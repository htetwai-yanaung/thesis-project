@extends('core::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('core.name') !!}</p>

    <p>{{ $path }}</p>
@endsection
