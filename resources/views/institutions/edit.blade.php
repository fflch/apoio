@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Instituição</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('institutions.update', $institution->id) }}">
      @csrf
      @method('PUT')
      @include('institutions.form')
      <button type="submit" class="btn btn-info">Atualizar</button>
    </form>
  </div>
</div>
@endsection
