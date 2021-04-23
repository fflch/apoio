@extends('master')

@section('content')
<h3 class="ml-2 mt-2">Concursos</h3>
<a href="{{ route('contests.create') }}" class="btn btn-info ml-2">Adicionar</a>
<form method="get" action="{{ route('contests.index') }}" class="form
      form-inline float-right">
    <select type="select" class="form-control" name="filter" id="filter">
      @foreach($optionsFilters as $key => $value)
      @if(old('filter') == '' and isset($filters['filter']))
      <option value="{{ $key }}"
      {{ ( $filters['filter'] == $key ) ? 'selected' : '' }}>{{ $value }}</option>
      @else
      <option value="{{ $key }}"
      {{ ( old('filter') == $key ) ? 'selected' : '' }}>{{ $value }}
      </option>
      @endif
      @endforeach
    </select>
  <button type="submit" class="btn btn-info ml-2"> Buscar </button>
</form>
<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th scope="col">Edital</th>
      <th scope="col" width="190">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($contests as $contest)
    <tr>
      <td>{{ $contest->edital }}</td>
      <td>
           <a href="{{ route('contests.edit', $contest->id) }}"
             class="btn btn-success">Editar</a>
           <form method="post" action="{{ route('contests.destroy',
            $contest->id) }}" class="form d-inline-block">
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
  {!! $contests->appends($filters)->links() !!}
@else
  {!! $contests->links() !!}
@endif

@endsection
