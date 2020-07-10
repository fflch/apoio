<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$id = trim(strip_tags(isset($_GET['id']) ? $_GET['id'] : 0));
	$sql = "SELECT AREA FROM AREA
	        WHERE IDDEPTO = $id ORDER BY AREA;";
  if ($banco->abreConexao() == true) {
	 	$resultados = $banco->consultar($sql);
		$banco->fechaConexao();
  }
}

$return_array = array();
$row_array = array();
$row_array['optionValue'] = "teste";
if (count($resultados) > 0 ){
  foreach ($resultados as $areas) {
    foreach ($areas as $campo => $valor) {
      if (strcasecmp($campo, "area") == 0) {
	      $row_array['optionValue'] = utf8_encode($valor);
      }
    }
    array_push($return_array,$row_array);
  }
}

echo json_encode($return_array);

?>
