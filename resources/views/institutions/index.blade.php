@extends('master')

@section('content')

<form method="get" action="{{ route('institutions.index') }}">
  <div class="">
    <div class="">
    <input type="text" class="" name="busca" value="">

    <span class="">
        <button type="submit" class="btn btn-primary"> Buscar </button>
    </span>
    <br /><br />
  </div>
</form>
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
          <td><a href="{{ route('institutions.edit', $institution->id) }}"
                 class="btn btn-success">Editar</a>
             <form method="post" action="{{ route('institutions.destroy',
                $institution->id) }}">
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
    {!! $institutions->links() !!}
</div>

@endsection
