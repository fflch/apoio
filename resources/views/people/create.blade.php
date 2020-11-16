@extends('master')

@section('content')
@parent
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Pessoas</h3>
  <div class="p-4">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" href="#pessoa">Pessoa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#contato">Contato</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#titulacao">Titulação</a>
      </li>
    </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active mx-3 my-3" style="background:transparent" id="pessoa" role="tabpanel"
          aria-labelledby="home-tab">
        <form method="POST" action="{{ route('institutions.store') }}">
          @csrf
          @include('people.form')
          <button type="submit" class="btn btn-info">Salvar</button>
        </form>
        </div>
        <div class="tab-pane fade" id="contato" role="tabpanel"
          aria-labelledby="profile-tab">
        </div>
        <div class="tab-pane fade" id="titulacao" role="tabpanel"
          aria-labelledby="contact-tab">
        </div>
      </div>
  </div>
</div>
@endsection
