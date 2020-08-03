@extends('master')

@section('content')

<form method="get" action="/institutions">
<div class="">
    <div class="">
    <input type="text" class="" name="busca" value="">

    <span class="">
        <button type="submit" class="btn btn-primary"> Buscar </button>
    </span>
    <br /><br />
    </div>
    <table class="table table-striped ">
      <thead>
        <tr>
          <th scope="col">Sigla</th>
          <th scope="col">Nome</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($institutions as $institution)
        <tr>
          <td>{{ $institution->sigla }}</td>
          <td>{{ $institution->nome }}</td>
          <td><a href="" class="btn btn-success">Editar</a> <a href=""
          class="btn btn-danger">Deletar</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! $institutions->links() !!}
</div>
</form>

@endsection
