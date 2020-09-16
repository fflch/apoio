@extends('master')

@section('content')
<h3 class="ml-2 mt-2">Departamento</h3>
<a href="{{ route('departaments.create') }}" class="btn btn-info ml-2">Adicionar</a>
<form method="post" action="{{ route('departaments.search') }}" class="form
      form-inline float-right">
  @csrf
  <input type="text" class="form-control" name="filter" placeholder=""
    value="{{ $filters['filter'] ?? '' }}">
  <button type="submit" class="btn btn-info ml-2"> Buscar </button>
</form>
<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th scope="col">Sigla</th>
      <th scope="col">Departamento</th>
      <th scope="col" width="190">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($departaments as $departament)
    <tr>
      <td>{{ $departament->sigla }}</td>
      <td>{{ $departament->departamento }}</td>
      <td>
           <a href="{{ route('departaments.edit', $departament->id) }}"
             class="btn btn-success">Editar</a>
           <form method="post" action="{{ route('departaments.destroy',
            $departament->id) }}" class="form d-inline-block">
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
@if (isset($filters))
  {!! $departaments->appends($filters)->links() !!}
@else
  {!! $departaments->links() !!}
@endif

@endsection
