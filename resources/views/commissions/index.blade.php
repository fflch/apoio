@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Comissão</h3>
  <div class="p-4">
    <label>Edital</label>
    <label>{{ $contest->edital }}</label><br />
    <label>Descrição</label>
    <label>{{ $contest->descricao }}</label><br />
    <label>Área</label>
    <label>{{ $contest->area }}</label><br /><br />

    <form method="post" action="{{ route('commissions.store') }}">
      @csrf
      <input type="hidden" name="contest_id" id="contest_id" value="{{
      $contest->id }}">
      <div class="form-row">
        <div class="form-group col-md-7">
          <input type="text" class="form-control" name="nome"
          id="nome" placeholder="Digite o nome da pessoa para buscar">
          <input type="hidden" name="people_id" id="people_id" value="">
        </div>
        <div class="form-group col-md-1">
          <select type="select" class="form-control" name="origem">
            <option value="FFLCH">FFLCH</option>
            <option value="EXTERNO">Externo</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-info">Adicionar</button>
        </div>
      </div>

    </form>

  <table class="table table-striped table-bordered mt-4">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Título</th>
        <th scope="col">Origem</th>
        <th scope="col" width="90">Ações</th>
      </tr>
    </thead>
    @foreach($origens as $origem)
    <tbody id={{ $origem }} class="sortable">
        <tr class="not-sortable table-secondary">
          <td colspan="4">{{ $origem }}</td>
        </tr>
      @foreach($contest->people as $person)
        @if($origem == $person->commissions->origem)
          <tr data-id="{{ $person->id }}" style="cursor: move">
            <td>{{ $person->nome }}</td>
            <td>{{ $person->commissions->titulo }}</td>
            <td>{{ $person->commissions->origem }}</td>
            <td>
               <form method="post" action="{{ route('commissions.destroy',
                 [$contest->id, $person->commissions->people_id]) }}"
                 class="form d-inline-block">
                  @csrf
                  @method('DELETE')
                 <button type="submit" class="btn btn-danger ml-2"
                  onclick="return confirm('Você tem certeza que deseja excluir?')">
                  Excluir</button>
               </form>
            </td>
          </tr>
        @endif
      @endforeach
      </tbody>
    @endforeach
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

        var $fflch = $("#FFLCH");
        var $externo = $("#EXTERNO");

        $(".sortable").sortable({
          items: "tr:not(.not-sortable)",
          stop: (event, ui) => {
            var origem = $(ui.item).parent().attr('id');
            var items = $("#"+origem).sortable('toArray', {attribute: 'data-id'});
            var ids = $.grep(items, (item) => item !== "");
            console.log(ids);
            $.post('{{ route('commissions.reorder') }}', {
                _token: CSRF_TOKEN,
                contest_id: '{{ $contest->id }}',
                ids,
            })
            .fail(function (response) {
                alert('Erro ao enviar a requisição para reordenar a banca.');
                location.reload();
            });
          }
        });
        $("#fflch, #externo, .sortable").disableSelection();

     });

  </script>
@endsection
