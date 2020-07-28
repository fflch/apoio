<DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sistema de Apoio Acadêmico</title>
  </head>
  <body>
    @if($errors->any())
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    @endif

    @yield('content')
  </body>
</html>
