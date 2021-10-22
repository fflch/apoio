@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Inscrição</h3>
  <div class="p-4">
    <label>Edital</label>
    <label>{{ $contest->edital }}</label><br />
    <label>Descrição</label>
    <label>{{ $contest->descricao }}</label><br />
    <label>Área</label>
    <label>{{ $contest->area }}</label><br /><br />

    <form method="post" action="{{ route('subscriptions.store') }}">
      @csrf
      <input type="hidden" name="contest_id" id="contest_id" value="{{
      $contest->id }}">
      <div class="form-row">
        <div class="form-group col-md-6">
          <input type="text" class="form-control" name="nome"
          id="nome" placeholder="Digite o nome da pessoa para buscar">
          <input type="hidden" name="people_id" id="people_id" value="">
        </div>
        <div class="form-group col-md-2">
          <input type="text" class="form-control" name="processo" id="processo"
          placeholder="Digite o número do Processo">
        </div>
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-info">Adicionar</button>
        </div>
      </div>

    </form>

  <table class="table table-striped mt-4">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col" width="190">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($subscriptions as $subscription)
        <tr>
          <td>{{ $subscription->people->nome }}</td>
          <td>
             <form method="post" action="{{ route('subscriptions.destroy',
               [$subscription->id]) }}" class="form d-inline-block">
                @csrf
                @method('DELETE')
               <button type="submit" class="btn btn-danger ml-2"
                onclick="return confirm('Você tem certeza que deseja excluir?')">
                Excluir</button>
             </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection
@section('javascripts_bottom')
  <script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $(document).ready(function(){
        $("#nome").autocomplete({
          minLength:3,
          delay:500,
          source: function( request, response ) {
            // Fetch data
            $.ajax({
              url:"{{ route('search.searchpeople') }}",
              type: 'get',
              dataType: "json",
              data: {
                 _token: CSRF_TOKEN,
                 search: request.term
              },
              success: function( data ) {
                 response( data );
              }
            });
          },
          select: function (event, ui) {
            $('#nome').val(ui.item.label);
            $('#people_id').val(ui.item.value);
            return false;
          }
        })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
          return $( "<li>" )
        .append( "<div>" + item.label + " ( " + item.nusp + " ) </div>" )
        .appendTo( ul );
        };

     });

  </script>
@endsection
