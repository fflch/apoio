@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Concurso</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('contests.update', $contest->id) }}">
      <input type="hidden" name="contest_id" id="contest_id" value="{{
        $contest->contest_id }}">
      @csrf
      @method('PUT')
      @include('contests.form')
      <button type="submit" class="btn btn-info">Atualizar</button>
    </form>
  </div>
</div>
@endsection
