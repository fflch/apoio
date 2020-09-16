@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Tipo de Contato</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('contact_types.update', $contact_type->id) }}">
      @csrf
      @method('PUT')
      @include('contact_types.form')
      <button type="submit" class="btn btn-info">Atualizar</button>
    </form>
  </div>
</div>
@endsection
