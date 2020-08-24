@extends('master')

@section('content')

<form method="post" action="{{ route('roles.search') }}" class="form
      form-inline">
  @csrf
  <input type="text" class="form-control" name="filter" placeholder=""
    value="{{ $filters['filter'] ?? '' }}">
  <button type="submit" class="btn btn-primary ml-2"> Buscar </button>
</form>
<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th scope="col">Cargo</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($roles as $role)
    <tr>
      <td>{{ $role->cargo }}</td>
      <td><a href="{{ route('roles.edit', $role->id) }}"
             class="btn btn-success">Editar</a>
         <form method="post" action="{{ route('roles.destroy',
            $role->id) }}" class="form form-inline">
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
  {!! $roles->appends($filters)->links() !!}
@else
  {!! $roles->links() !!}
@endif

@endsection
