<?php
require_once ('/usr/local/lib/php/fpdf/fpdf.php');
require_once ('classes/Loader.class.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
if (!isset($_SESSION)) {
  session_start();
}

$composicao = isset($_GET["lststatuscertame"]) ? $_GET["lststatuscertame"] : null;
$data = date("d.m.Y");
$datainicio1 = str_replace("/",".", isset($_GET["datainicio1"]) ? $_GET["datainicio1"] : $data);
$datainicio2 = str_replace("/",".", isset($_GET["datainicio2"]) ? $_GET["datainicio2"] : $data);

$sql = null;
$tipoconcurso = null;
$resultados = null;

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	if (!is_null($composicao)) {
  	if (strcasecmp($composicao,'I') == 0 ) {
  	  $tipoconcurso = "em Fase de Inscrição";
    	$sql = "SELECT C.ID, C.PROCESSO, C.AREA, C.DISCIPLINA, C.INICIO, C.TERMINO, D.SIGLA
              FROM CONCURSOS C INNER JOIN DEPARTAMENTOS D ON(C.IDDEPARTAMENTO = D.ID)
              WHERE C.TERMINO >= '$data';";
    }
    elseif (strcasecmp($composicao,'C') == 0 ) {
  	  $tipoconcurso = "em Fase de Certame";
    	$sql = "SELECT C.ID, C.PROCESSO, C.AREA, C.DISCIPLINA, C.INICIO, C.TERMINO, D.SIGLA
              FROM CONCURSOS C INNER JOIN DEPARTAMENTOS D ON(C.IDDEPARTAMENTO = D.ID)
              WHERE C.STATUS = 'C';";
    }
    elseif (strcasecmp($composicao,'F') == 0 ) {
  	  $tipoconcurso = "Finalizados";
    	$sql = "SELECT C.ID, C.PROCESSO, C.AREA, C.DISCIPLINA, C.INICIOPROVA, C.TERMINOPROVA, D.SIGLA
              FROM CONCURSOS C INNER JOIN DEPARTAMENTOS D ON(C.IDDEPARTAMENTO = D.ID)
              WHERE C.INICIOPROVA BETWEEN ('$datainicio1') AND ('$datainicio2') AND C.STATUS = 'F';";
    }
    elseif (strcasecmp($composicao,'E') == 0 ) {
  	  $tipoconcurso = "em Fase de Espera";
    	$sql = "SELECT C.ID, C.PROCESSO, C.AREA, C.DISCIPLINA, C.INICIO, C.TERMINO, D.SIGLA
              FROM CONCURSOS C INNER JOIN DEPARTAMENTOS D ON(C.IDDEPARTAMENTO = D.ID)
              WHERE C.TERMINO <= '$data' AND C.STATUS = 'A';";
    }
   	$resultados = Consulta($sql);
  }
}

class PDF extends FPDF
{
//Page header
function Header()
{
  global $tipoconcurso;
  $this->SetFont('Arial','B',12);
  $this->Cell(0,10,"Relação de Processos e Concursos $tipoconcurso",1,1,'C');
  $this->SetFont('Arial','B',10);
  $this->Cell(15,5,'Código',1,0,'C');
  $this->Cell(23,5,'Processo',1,0,'L');
  $this->Cell(15,5,'Depto.',1,0,'C');
  $this->Cell(95,5,'Área',1,0,'L');
  $this->Cell(95,5,'Disciplina',1,0,'L');
  $this->Cell(17,5,'Início',1,0,'C');
  $this->Cell(17,5,'Término',1,1,'C');
}

function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'R');
}

}

//Instanciation of inherited class
$pdf=new PDF('L','mm', 'A4');
//$pdf->Open();
$pdf->AddPage();
$pdf->AliasNbPages();


if (count($resultados) > 0) {
  foreach ($resultados as $resultado) {
  	foreach ($resultado as $campo => $valor) {
      if (strcasecmp($campo, "id") == 0) {
	      $id = $valor;
      }
	    if (strcasecmp($campo, "processo") == 0) {
	      $processo = $valor;
      }
	    if (strcasecmp($campo, "area") == 0) {
	      $area = $valor;
    	}
	    if (strcasecmp($campo, "disciplina") == 0) {
	      $disciplina = $valor;
      }
	    if (strcasecmp($campo, "inicio") == 0) {
	      $inicio = $valor;
      }
	    if (strcasecmp($campo, "termino") == 0) {
	      $termino = $valor;
      }
	    if (strcasecmp($campo, "inicioprova") == 0) {
	      $inicio = $valor;
      }
	    if (strcasecmp($campo, "terminoprova") == 0) {
	      $termino = $valor;
      }
	    if (strcasecmp($campo, "sigla") == 0) {
	      $sigla = $valor;
      }
    }
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,5,$id,1,0,'C');
    $pdf->Cell(23,5,$processo,1,0,'L');
    $pdf->Cell(15,5,$sigla,1,0,'C');
    $pdf->Cell(95,5,$area,1,0,'L');
    $pdf->Cell(95,5,$disciplina,1,0,'L');
    $pdf->Cell(17,5,$inicio,1,0,'C');
    $pdf->Cell(17,5,$termino,1,1,'C');

  }
}
else
  $pdf->Cell(0,20,'Não há registros para a consulta solicitada!',0,0,'C');

$pdf->Output("concurso","I");

function Consulta($sql) {
  if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	  $banco = $_SESSION[BANCO_SESSAO];
    if ($banco->abreConexao() == true) {
	   	$resultados = $banco->consultar($sql);
                $banco->fechaConsulta($sql);
  	        $banco->fechaConexao();
    }
  }
  return $resultados;
}

?>
