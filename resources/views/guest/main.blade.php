@extends('guest.layouts.master')
@section('content')
<form action="{{ route("guest.store") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="test" id="">
    <button>save</button>
</form>
@endsection
