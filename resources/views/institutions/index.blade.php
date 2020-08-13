@extends('master')

@section('content')

<form method="post" action="{{ route('institutions.search') }}" class="form
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
      <th scope="col">Nome</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($institutions as $institution)
    <tr>
      <td>{{ $institution->sigla }}</td>
      <td>{{ $institution->nome }}</td>
      <td><a href="{{ route('institutions.edit', $institution->id) }}"
             class="btn btn-success">Editar</a>
         <form method="post" action="{{ route('institutions.destroy',
            $institution->id) }}" class="form form-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
            onclick="return confirm('Você tem certeza que deseja excluir?')">
            Excluir</button>
         </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@if (isset($filters))
  {!! $institutions->appends($filters)->links() !!}
@else
  {!! $institutions->links() !!}
@endif

@endsection
