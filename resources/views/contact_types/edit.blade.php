@extends('master')

@section('content')
@parent

<form method="POST" action="{{ route('contact_types.update', $contact_type->id) }}">
    @csrf
    @method('PUT')
    @include('contact_types.form')
  </form>

@endsection
