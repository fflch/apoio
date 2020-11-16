@extends('master')

@section('content')
<h3 class="ml-2 mt-2">Pessoa</h3>
<a href="{{ route('people.create') }}" class="btn btn-info ml-2">Adicionar</a>
<form method="post" action="{{ route('people.search') }}" class="form
      form-inline float-right">
  @csrf
  <input type="text" class="form-control" name="filter" placeholder=""
    value="{{ $filters['filter'] ?? '' }}">
  <button type="submit" class="btn btn-info ml-2"> Buscar </button>
</form>
<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col" width="190">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($peoples as $people)
    <tr>
      <td>{{ $people->nome }}</td>
      <td>
           <a href="{{ route('people.edit', $people->id) }}"
              class="btn btn-success">Editar</a>
         <form method="post" action="{{ route('people.destroy',
            $people->id) }}" class="form d-inline-block">
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
  {!! $peoples->appends($filters)->links() !!}
@else
  {!! $peoples->links() !!}
@endif

@endsection
