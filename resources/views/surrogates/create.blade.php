@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Suplentes</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('surrogates.store') }}">
      @csrf
      @include('surrogates.form')
      <button type="submit" class="btn btn-info">Salvar</button>
    </form>
  </div>
</div>

@section('javascripts_bottom')
  <script>
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $(document).ready(function(){

        $("#nome").autocomplete({
          minLength:3,
          delay:500,
          source: function( request, response ) {
            // Fetch data
            $.ajax({
              url:"{{ route('surrogates.getpeople') }}",
              type: 'post',
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

        $("#holder").autocomplete({
          minLength:3,
          delay:500,
          source: function( request, response ) {
            // Fetch data
            $.ajax({
              url:"{{ route('surrogates.getholder') }}",
              type: 'post',
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
            $('#holder').val(ui.item.label);
            $('#holder_id').val(ui.item.value);
            $('#designation').val(ui.item.designation);
            return false;
          }
        })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
          return $( "<li>" )
        .append( "<div>" + item.label + " ( " + item.designation + " ) </div>" )
        .appendTo( ul );
        };

     });
  </script>
@endsection

@endsection
