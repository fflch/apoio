<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Sistema - Apoio Acad&ecirc;mico</title>
		{literal}
		<link rel="stylesheet" type="text/css" href="css/apoio.css" media="screen" />
		<link type="text/css" href="css/start/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
   	<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.js"></script>
		<script type="text/javascript" src="js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="js/jquery.ui.position.js"></script>
		<script type="text/javascript" src="js/jquery.ui.autocomplete.js"></script>
		<script type="text/javascript" src="js/jquery.ui.datepicker-pt-BR.js"></script>
	 	<script type="text/javascript" src="js/apoio.js"></script>
		{/literal}
  </head>
	<body>
    <div id="wrapper">
       <div id="cabecalho">
         <h1>Sistema de Apoio Acad&ecirc;mico</h1>
     		 <h5><a href="logout.php">logout: {$login}</a></h5>
        </div>
        <div id="conteudo">
        </div>
			  <ul id="menuNav">
			    <li><a href="#" class="menu">Concursos</a>
				    <ul class="submenu">
				      <li><a href="cadconcurso.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admconcurso.php">Gerenciar</a></li>
				    </ul>
				  </li>
			    <li><a href="#" class="menu">Inscri&ccedil;&otilde;es</a>
				    <ul class="submenu">
				      <li><a href="cadinscrito.php?operacao=inserir">Inserir</a></li>
					    <li><a href="adminscrito.php">Gerenciar</a></li>
				    </ul>
				  </li>
			    <li><a href="#" class="menu">Resultados</a>
				    <ul class="submenu">
				      <li><a href="admresultado.php">Inserir / Gerenciar</a></li>
				    </ul>
				  </li>
			    <li><a href="#" class="menu">C&eacute;dulas</a>
				    <ul class="submenu">
				      <li><a href="cadcedula.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admcedula.php">Gerenciar</a></li>
				    </ul>
				  </li><br />
			    <li><a href="#" class="menu">Titulares</a>
				    <ul class="submenu">
				      <li><a href="cadtitular.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admtitular.php">Gerenciar</a></li>
				    </ul>
				  </li>
			    <li><a href="#" class="menu">Suplentes</a>
				    <ul class="submenu">
				      <li><a href="cadsuplente.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admsuplente.php">Gerenciar</a></li>
				    </ul>
				  </li>
				  <li><a href="#" class="menu">Pessoas</a>
				    <ul class="submenu">
				      <li><a href="cadpessoa.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admpessoa.php">Gerenciar</a></li>
				    </ul>
				  </li><br />
  			  <li><a href="#" class="menu">&Aacute;reas</a>
				    <ul class="submenu">
				      <li><a href="cadarea.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admarea.php">Gerenciar</a></li>
				    </ul>
				  </li>
  			  <li><a href="#" class="menu">Cargos</a>
				    <ul class="submenu">
				      <li><a href="cadcargo.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admcargo.php">Gerenciar</a></li>
				    </ul>
				  </li>
				  <li><a href="#" class="menu">Departamentos</a>
				    <ul class="submenu">
				      <li><a href="cadepto.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admdepto.php">Gerenciar</a></li>
				    </ul>
				  </li>
				  <li><a href="#" class="menu">Institui&ccedil;&otilde;es</a>
				    <ul class="submenu">
				      <li><a href="cadinstituicao.php?operacao=inserir">Inserir</a></li>
					    <li><a href="adminstituicao.php">Gerenciar</a></li>
				    </ul>
				  </li>
				  <li><a href="#" class="menu">Tipos de Contato</a>
				    <ul class="submenu">
				      <li><a href="cadtipocontato.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admtipocontato.php">Gerenciar</a></li>
				    </ul>
				  </li>
				  <li><a href="#" class="menu">T&iacute;tulos</a>
				    <ul class="submenu">
				      <li><a href="cadtitulo.php?operacao=inserir">Inserir</a></li>
					    <li><a href="admtitulo.php">Gerenciar</a></li>
				    </ul>
				  </li>
				  <li><a href="#" class="menu">Usu&aacute;rios</a>
				    <ul class="submenu">
				      <li><a href="cadusuario.php?operacao=inserir">Inserir</a></li>
				      <li><a href="admusuario.php">Gerenciar</a></li>
				    </ul>
				  </li><br />
				  <li><a href="#" class="menu">Vota&ccedil;&atilde;o</a>
				    <ul class="submenu">
				      <li><a href="habilitar.php?operacao=consultar">Gerenciar</a></li>
				    </ul>
				  </li>
				  <li><a href="#" class="menu">Relat&oacute;rio</a>
				    <ul class="submenu">
				      <li><a href="relconcurso.php">Concursos</a></li>
				      <li><a href="relcomposicao.php">Composi&ccedil;&atilde;o</a></li>
				      <li><a href="relresultado.php">Resultado da Vota&ccedil;&atilde;o</a></li>
				      <li><a href="relresultadoaberto.php">Resultado Vota&ccedil;&atilde;o Aberta</a></li>
				      <li><a href="votantes.php">Votantes</a></li>
				    </ul>
				</li><br />
				<li><a href="#" class="menu">Hist&oacute;rico da Composi&ccedil;&atilde;o</a>
				  <ul class="submenu">
					<li><a href="histnumerousp.php">N&uacute;mero USP</a></li>					
				  </ul>
				</li>

			  </ul>
        <div id="rodape">
          <p>
            &copy; 2011 - Se&ccedil;&atilde;o T&eacute;cnica de Inform&aacute;tica
          </p>
        </div>
    </div>
	</body>
</html>
