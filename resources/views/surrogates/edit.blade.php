@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Titulares</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('surrogates.update', $surrogate->id) }}">
      <input type="hidden" name="people_id" id="people_id" value="{{
        $surrogate->people_id }}">
      @csrf
      @method('PUT')
      @include('surrogates.form')
      <button type="submit" class="btn btn-info">Atualizar</button>
    </form>
  </div>
</div>
@endsection
