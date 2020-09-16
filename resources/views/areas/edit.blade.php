@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Área</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('areas.update', $area->id) }}">
      @csrf
      @method('PUT')
      @include('areas.form')
      <button type="submit" class="btn btn-info">Atualizar</button>
    </form>
  </div>
</div>
@endsection
