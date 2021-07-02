@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Comissão</h3>
  <div class="p-4">
    <label>Edital</label>
    <label>{{ $contest->edital }}</label><br />
    <label>Descrição</label>
    <label>{{ $contest->descricao }}</label><br />
    <label>Área</label>
    <label>{{ $contest->area }}</label><br /><br />

    <form method="post" action="{{ route('commissions.store') }}">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-7">
          <input type="text" class="form-control" name="nome"
          placeholder="Digite o nome da pessoa para buscar">
        </div>
        <div class="form-group col-md-1">
          <select type="select" class="form-control" name="origem">
            <option value="FFLCH">FFLCH</option>
            <option value="Externo">Externo</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-info">Adicionar</button>
        </div>
      </div>

    </form>

  <table class="table table-striped mt-4">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Título</th>
        <th scope="col">Origem</th>
        <th scope="col" width="90">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($contest->people as $person)
      <tr>
        <td>{{ $person->nome }}</td>
        <td>{{ $person->commissions->titulo }}</td>
        <td>{{ $person->commissions->origem }}</td>
        <td>
           <form method="post" action="{{ route('commissions.destroy',
             [$contest->id, $person->commissions->people_id]) }}" class="form d-inline-block">
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

    <form method="POST" action="{{ route('commissions.store') }}">
      @csrf
      @include('commissions.form')
      <button type="submit" class="btn btn-info">Salvar</button>
    </form>
  </div>
</div>
@endsection
@section('javascripts_bottom')
  <script type="text/javascript">
  </script>
@endsection
