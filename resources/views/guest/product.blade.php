
@extends('guest.layouts.master')
@section('main')
<div class="hidden card redirect" data-url="{{ $redirect }}">
    <img src="{{ picture( $product ) }}" alt="{{ $product->title }}" title="{{ $product->summary }}" />
    <h1>{{ $product->title }}</h1>
    <h2>{{ $product->summary }}</h2>
    <p>{{ $product->description }}</p>
</div>
@stop
