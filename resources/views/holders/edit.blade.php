@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Titulares</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('holders.update', $holder->id) }}">
      <input type="hidden" name="people_id" id="people_id" value="{{
        $holder->people_id }}">
      @csrf
      @method('PUT')
      @include('holders.form')
      <button type="submit" class="btn btn-info">Atualizar</button>
    </form>
  </div>
</div>
@endsection

@section('javascripts_bottom')
  <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
@endsection
