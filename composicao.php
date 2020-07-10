<?php
require_once ('/usr/local/lib/php/fpdf/fpdf.php');
require_once ('classes/Loader.class.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
ini_set('ibase.dateformat','%d/%m/%Y');
if (!isset($_SESSION)) {
  session_start();
}

$composicao = isset($_GET["lstcomposicao"]) ? $_GET["lstcomposicao"] : 'con';
$data = date("d/m/Y");

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$sql = "SELECT P.NUSP as NUSPTITULAR, P.NOME AS TITULAR, C.CARGO, D.SIGLA AS DEPTOT, CT.INICIO AS INICIOT, CT.TERMINO AS TERMINOT,
          PP.NUSP as NUSPSUPLENTE, PP.NOME AS SUPLENTE, DD.SIGLA AS DEPTOS, CS.INICIO AS INICIOS, CS.TERMINO AS TERMINOS FROM COMPOSICOESTITULARES CT LEFT JOIN COMPOSICOESSUPLENTES CS
          ON(CT.ID = CS.IDCOMPOSICAOTITULAR) INNER JOIN PESSOAS P
          ON(CT.IDPESSOA = P.ID) LEFT JOIN PESSOAS PP
          ON(CS.IDPESSOA = PP.ID) INNER JOIN CARGOS C
          ON(CT.IDCARGO = C.ID) INNER JOIN DEPARTAMENTOS D
          ON(CT.IDDEPARTAMENTO = D.ID) LEFT JOIN DEPARTAMENTOS DD
          ON(CS.IDDEPARTAMENTO = DD.ID)
          WHERE CT.ATIVO='A' AND CT.PERTENCE='$composicao' AND (CS.ATIVO='A' OR CS.ATIVO IS NULL) ORDER BY C.CARGO, P.NOME;";
  if ($banco->abreConexao() == true) {
	 	$resultados = $banco->consultar($sql);
                $banco->fechaConsulta($sql);
		$banco->fechaConexao();
  }
}

class PDF extends FPDF
{
//Page header
function Header()
{
  global $data, $composicao;
  if (strcasecmp($composicao,"cta") == 0 ) {
    $composicao = strtoupper($composicao);
  }
  else{
    $composicao = "Congregação";
  }
  $this->SetFont('Arial','B',12);
  $this->MultiCell(0,5,"Faculdade de Filosofia, Letras e Ciências Humanas\nComposição da $composicao\n$data",1,'C');
  $this->SetFont('Arial','B',10);
  $this->Cell(90,10,'Condição',1,0,'C');
  $this->Cell(15,10,'N. USP',1,0,'C');
  $this->Cell(127,10,'Nome',1,0,'C');
  $this->Cell(15,10,'Depto.',1,0,'C');
  $this->Cell(30,5,'Mandato',1,2,'C');
  $this->Cell(15,5,'Início',1,0,'C');
  $this->Cell(15,5,'Término',1,1,'C');
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

function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true) {
//Get string width
$str_width=$this->GetStringWidth($txt);
//Calculate ratio to fit cell
if($w==0)
  $w = $this->w-$this->rMargin-$this->x;
  $ratio = ($w-$this->cMargin*2)/$str_width;

  $fit = ($ratio < 1 || ($ratio > 1 && $force));
  if ($fit) {
      if ($scale) {
        //Calculate horizontal scaling
        $horiz_scale=$ratio*100.0;
        //Set horizontal scaling
        $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
      }
      else {
         //Calculate character spacing in points
         $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
         //Set character spacing
         $this->_out(sprintf('BT %.2F Tc ET',$char_space));
      }
      //Override user alignment (since text will fill up cell)
      $align='';
   }

   //Pass on to Cell method
   $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

   //Reset character spacing/horizontal scaling
   if ($fit)
     $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
}

function MBGetStringLength($s) {
  if($this->CurrentFont['type']=='Type0') {
    $len = 0;
    $nbbytes = strlen($s);
    for ($i = 0; $i < $nbbytes; $i++) {
      if (ord($s[$i])<128)
        $len++;
      else {
        $len++;
        $i++;
      }
    }
    return $len;
  }
  else
    return strlen($s);
}

function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='') {
   $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
}

}

//Instanciation of inherited class
$pdf=new PDF('L','mm', 'A4');
$pdf->AddPage();
$pdf->AliasNbPages();


if (count($resultados) > 0) {
  foreach ($resultados as $resultado) {
  	foreach ($resultado as $campo => $valor) {
  	  if (strcasecmp($campo, "nusptitular") == 0 ) {
  	    $nusptitular = $valor;
  	  }
      if (strcasecmp($campo, "titular") == 0) {
	      $titular = $valor;
      }
	    if (strcasecmp($campo, "cargo") == 0) {
	      $cargo = $valor;
      }
	    if (strcasecmp($campo, "deptot") == 0) {
	      $deptot = $valor;
      }
	    if (strcasecmp($campo, "iniciot") == 0) {
	      $iniciot = $valor;
    	}
	    if (strcasecmp($campo, "terminot") == 0) {
	      $terminot = $valor;
      }
      if (strcasecmp($campo, "nuspsuplente") == 0 ) {
        $nuspsuplente = $valor;
      }
	    if (strcasecmp($campo, "suplente") == 0) {
	      $suplente = $valor;
      }
	    if (strcasecmp($campo, "deptos") == 0) {
	      $deptos = $valor;
      }
	    if (strcasecmp($campo, "inicios") == 0) {
	      $inicios = $valor;
      }
	    if (strcasecmp($campo, "terminos") == 0) {
	      $terminos = $valor;
      }
    }
    $pdf->SetFont('Arial','',8);
    $pdf->CellFitScale(90,5,$cargo,1,0,'C');
    $pdf->Cell(15,5,$nusptitular,1,0,'C');
    $pdf->CellFitScale(127,5,$titular,1,0,'L');
    $pdf->Cell(15,5,$deptot,1,0,'C');
    $pdf->Cell(15,5,$iniciot,1,0,'C');
    $pdf->Cell(15,5,$terminot,1,1,'C');
    $pdf->Cell(90,5,'Suplente',1,0,'C');
    $pdf->Cell(15,5,$nuspsuplente,1,0,'C');
    if ($pdf->GetStringWidth($suplente) > 0) {
      $pdf->CellFitScale(127,5,$suplente,1,0,'L');
    } 
    else {
      $pdf->Cell(127,5,$suplente,1,0,'L');
    }
    $pdf->Cell(15,5,$deptos,1,0,'C');
    $pdf->Cell(15,5,$inicios,1,0,'C');
    $pdf->Cell(15,5,$terminos,1,1,'C');
  }
}
else
  $pdf->Cell(0,20,'Não há registros para a consulta solicitada!',0,0,'C');
$pdf->Output("composicao","I");
?>
