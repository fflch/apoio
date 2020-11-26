@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Pessoas</h3>
  <div class="p-4">
    <form method="POST" id="formPeople" action="{{ route('people.update', $people->id) }}">
      @csrf
      @method('PUT')
      @include('people.form')
      <button type="submit" class="btn btn-info">Atualizar</button>
    </form>
  </div>
</div>
@endsection

@section('javascripts_bottom');
<script>

  $(document).ready( function () {

    $('#contato-tab').on('click', function(event) {
      event.preventDefault();
      console.log('hello moon');
      var acao = $('#formPeople').attr('action').split('/');
      if(acao.length == 5) {
        $(this).tab('show');
      }
    });

  });

</script>
@endsection
