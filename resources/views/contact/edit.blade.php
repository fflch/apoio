@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Contato</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('contact.update', $contact->id) }}">
      @csrf
      @method('PUT')
      @include('contact.form')
      <button type="submit" class="btn btn-info">Atualizar</button>
    </form>
  </div>
</div>
@endsection
