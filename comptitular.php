<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$sql = "SELECT CT.ID, C.CARGO, P.NOME FROM COMPOSICOESTITULARES CT INNER JOIN
	        PESSOAS P ON(CT.IDPESSOA = P.ID) INNER JOIN CARGOS C ON(CT.IDCARGO = C.ID)
	        WHERE CT.PERTENCE = '".trim(strip_tags($_GET["composicao"])).
	        "' AND P.NOME LIKE '%". trim(strip_tags($_GET["term"])) . "%' AND CT.ATIVO='A' ORDER BY NOME;";
  if ($banco->abreConexao() == true) {
	 	$resultados = $banco->consultar($sql);
		$banco->fechaConexao();
  }
}

$return_array = array();
$row_array = array();

if (count($resultados) > 0 ){
 foreach ($resultados as $pessoas) {
  	foreach ($pessoas as $campo => $valor) {
      if (strcasecmp($campo, "id") == 0) {
	      $row_array['id'] = $valor;
      }
      if (strcasecmp($campo, "nome") == 0) {
	      $row_array['value'] = utf8_encode($valor);
      }
      if (strcasecmp($campo, "cargo") == 0) {
	      $row_array['cargo'] = utf8_encode($valor);
      }
    }
    array_push($return_array,$row_array);
 }
}

echo json_encode($return_array);

?>
