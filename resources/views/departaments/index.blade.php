@extends('master')

@section('content')

<form method="post" action="{{ route('departaments.search') }}" class="form
      form-inline">
  @csrf
  <input type="text" class="form-control" name="filter" placeholder=""
    value="{{ $filters['filter'] ?? '' }}">
  <button type="submit" class="btn btn-primary ml-2"> Buscar </button>
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
         <form method="post" action="{{ route('departaments.destroy',
            $departament->id) }}" class="form form-inline">
           <a href="{{ route('departaments.edit', $departament->id) }}"
             class="btn btn-success">Editar</a>
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
