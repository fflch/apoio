@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Pessoas</h3>
  <div class="p-4">
    <form method="POST" id="formPeople" action="{{ route('people.store') }}">
      @csrf
      @include('people.form')
      <button type="submit" class="btn btn-info mt-3">Salvar</button>
    </form>
  </div>
</div>
@endsection

@section('javascripts_bottom');
<script>

</script>
@endsection
