@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Pessoas</h3>
  <div class="p-4">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pessoa-tab" data-toggle="tab"
          href="#pessoa" role="tab" aria-controls="pessoa"
          aria-selected="true">Pessoa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contato-tab"
          href="#contato" role="tab" aria-controls="contato">Contato</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="titulacao-tab"
          href="#titulacao" role="tab" aria-controls="titulacao">Titulação</a>
      </li>
    </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active bg-light mx-3 my-3" id="pessoa" role="tabpanel"
          aria-labelledby="pessoa-tab">
          <form method="POST" id="formPeople" action="{{ route('people.update', $people->id) }}">
            @csrf
            @method('PUT')
            @include('people.form')
            <button type="submit" class="btn btn-info">Atualizar</button>
          </form>
        </div>
        <div class="tab-pane fade bg-light mx-3 my-3" id="contato" role="tabpanel"
          aria-labelledby="contato-tab">
          <button type="button" class="btn btn-info">Adicionar</button>
          <form method="POST" action="{{ route('people.store') }}">
            @csrf
            @include('contacts.form')
            <button type="submit" class="btn btn-info">Atualizar</button>
          </form>
        </div>
        <div class="tab-pane fade bg-light mx-3 my-3" id="titulacao" role="tabpanel"
          aria-labelledby="titulacao-tab">
          <form method="POST" action="{{ route('people.store') }}">
            @csrf
            @method('PUT')
            @include('designation_people.form')
            <button type="submit" class="btn btn-info">Atualizar</button>
          </form>
        </div>
      </div>
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
