@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Concurso</h3>
  <div class="p-4">
    <form method="POST" action="{{ route('contests.store') }}">
      @csrf
      @include('contests.form')
      <button type="submit" class="btn btn-info">Salvar</button>
    </form>
  </div>
</div>
@endsection
@section('javascripts_bottom')
  <script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $(document).ready(function(){
        $("#departament_id").change(function () {
          if( $(this).val() ) {
            $.ajax({
              url:"{{ route('contests.getarea') }}",
              type: 'post',
              dataType: "json",
              data: {
                 _token: CSRF_TOKEN,
                 search: $(this).val(),
              },
              beforeSend: function() {
                $('#area').html('<option value="">Aguarde... </option>');
              },
              success: function( data ) {
                 var options = '<option value="">Selecione a Área</option>';
                 for (var i = 0; i < data.length; i++) {
                  options += '<option value="' + data[i].nome + '">'
                     +data[i].nome + '</option>';
                 }
                 $("#area").html(options);
              }
            });
          }
          else {
            $('#area').html('<option value="">Selecione o Departamento</option>');
          }
        });
      });
  </script>
@endsection
