<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Sistema - Apoio Acad&ecirc;mico - Login</title>
	      {literal}
        <link rel="stylesheet" type="text/css" href="css/apoio.css" media="screen" />
    		<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
     		<script type="text/javascript" src="js/login.js"></script>
	    	{/literal}
    </head>
    <body>
          <div id="wrapper">
            <div id="cabecalho">
                <h1>Sistema - Apoio Acad&ecirc;mico</h1>
            </div>
            <div id="login">
            	    <noscript><br/>
            	      <p align="center">O JavaScript est&aacute; desativado em seu navegador!<br/>
            	      Ative o JavaScript ou atualize para um navegador compat&iacute;vel com JavaScript.</p>
            	    </noscript>
                <div class="caixa">
					        <span class="mensagem">{$mensagem}</span>
                	<form id="formulario" name="formulario" class="form" method="post">
                    <div class="row">
                      <label for="Login" class="esquerda">
                         Usu&aacute;rio
                      </label>
                      <input name="edtlogin" id="edtlogin" type="text" class="requerido" size="12" value="" />
                    </div>
                    <div class="row">
                      <label for="Senha" class="esquerda">
                         Senha
                      </label>
                      <input name="edtsenha" id="edtsenha" type="password" class="requerido" size="12" value="" />
                    </div>
                    <div class="row">
  				            <button type="submit" class="first">Entrar</button>
                      <button type="reset">Limpar</button>
                    </div>
         		      </form>
                </div>
            </div>
            <div id="rodape">
              <p>
                &copy; 2011 - Se&ccedil;&atilde;o T&eacute;cnica de Inform&aacute;tica
              </p>
            </div>
		</div>
      </body>
 </html>
