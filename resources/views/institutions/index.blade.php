<form method="get" action="/institutions">
<div class="">
    <div class="">
    <input type="text" class="" name="busca" value="">

    <span class="">
        <button type="submit" class=""> Buscar </button>
    </span>

    </div>
    <table>
      <thead>
        <tr>
          <td>Sigla</td>
          <td>Nome</td>
          <td>Ações</td>
        </tr>
      </thead>
      <tbody>
        @foreach($institutions as $institution)
        <tr>
          <td>{{ $institution->sigla }}</td>
          <td>{{ $institution->nome }}</td>
          <td>Editar Deletar</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! $institutions->links() !!}
</div>
</form>
