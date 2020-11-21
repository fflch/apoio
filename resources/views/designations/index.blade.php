@extends('master')

@section('content')
<h3 class="ml-2 mt-2">Título</h3>
<a href="{{ route('designations.create') }}" class="btn btn-info ml-2">Adicionar</a>
<form method="post" action="{{ route('designations.search') }}" class="form
      form-inline float-right">
  @csrf
  <input type="text" class="form-control" name="filter" placeholder=""
    value="{{ $filters['filter'] ?? '' }}">
  <button type="submit" class="btn btn-info ml-2"> Buscar </button>
</form>
<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th scope="col">Título</th>
      <th scope="col" width="190">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($designations as $designation)
    <tr>
      <td>{{ $designation->nome }}</td>
      <td>
           <a href="{{ route('designations.edit', $designation->id) }}"
             class="btn btn-success">Editar</a>
           <form method="post" action="{{ route('designations.destroy',
            $designation->id) }}" class="form d-inline-block">
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
  {!! $designations->appends($filters)->links() !!}
@else
  {!! $designations->links() !!}
@endif

@endsection
