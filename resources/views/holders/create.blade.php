@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Titulares</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('holders.store') }}">
      @csrf
      @include('holders.form')
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
              url:"{{ route('holders.getpeople') }}",
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
            $('#nusp').html(ui.item.nusp);
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

@endsection
