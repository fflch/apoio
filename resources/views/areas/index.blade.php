@extends('master')

@section('content')
<h3 class="ml-2 mt-2">Área</h3>
<a href="{{ route('areas.create') }}" class="btn btn-info ml-2">Adicionar</a>
<form method="post" action="{{ route('areas.search') }}" class="form
      form-inline float-right">
  @csrf
  <input type="text" class="form-control" name="filter" placeholder=""
    value="{{ $filters['filter'] ?? '' }}">
  <button type="submit" class="btn btn-info ml-2"> Buscar </button>
</form>
<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th scope="col">Área</th>
      <th scope="col" width="190">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($areas as $area)
    <tr>
      <td>{{ $area->area }}</td>
      <td>
           <a href="{{ route('areas.edit', $area->id) }}"
             class="btn btn-success">Editar</a>
           <form method="post" action="{{ route('areas.destroy',
            $area->id) }}" class="form d-inline-block">
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
  {!! $areas->appends($filters)->links() !!}
@else
  {!! $areas->links() !!}
@endif

@endsection
