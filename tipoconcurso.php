<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$tipo = trim(strip_tags(isset($_GET['tipo']) ? $_GET['tipo'] : null));
	$sql = null;
	if ($tipo == 'I' || $tipo == 'B') {
  	$sql = "SELECT ID, EDITAL FROM CONCURSOS
	          WHERE STATUS = 'A';";
  }
  else {
    $sql = "SELECT ID, EDITAL FROM CONCURSOS
	          WHERE STATUS = 'C';";
  }
  if ($banco->abreConexao() == true) {
	 	$resultados = $banco->consultar($sql);
		$banco->fechaConexao();
  }
}

$return_array = array();
$row_array = array();
if (count($resultados) > 0 ){
  foreach ($resultados as $concursos) {
    foreach ($concursos as $campo => $valor) {
      if (strcasecmp($campo, "id") == 0) {
	      $row_array['optionId'] = $valor;
      }
      else if (strcasecmp($campo, "edital") == 0) {
	      $row_array['optionValue'] = utf8_encode($valor);
      }
    }
    array_push($return_array,$row_array);
  }
}

echo json_encode($return_array);

?>
