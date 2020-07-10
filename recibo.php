<?php
require_once ('/usr/local/lib/php/fpdf/fpdf.php');
require_once ('classes/Loader.class.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
if (!isset($_SESSION)) {
  session_start();
}

$texto     = isset($_GET["edtexto"]) ? $_GET["edtexto"] : null;
$material1 = isset($_GET["material1"]) ? $_GET["material1"] : null;
$material2 = isset($_GET["material2"]) ? $_GET["material2"] : null;
$material3 = isset($_GET["material3"]) ? $_GET["material3"] : null;
$material4 = isset($_GET["material4"]) ? $_GET["material4"] : null;
$material5 = isset($_GET["material5"]) ? $_GET["material5"] : null;
$material6 = isset($_GET["material6"]) ? $_GET["material6"] : null;
$material7 = isset($_GET["material7"]) ? $_GET["material7"] : null;
$material8 = isset($_GET["material8"]) ? $_GET["material8"] : null;
$material9 = isset($_GET["material9"]) ? $_GET["material9"] : null;
$material10 = isset($_GET["material10"]) ? $_GET["material10"] : null;
$material11 = isset($_GET["material11"]) ? $_GET["material11"] : null;
$material12 = isset($_GET["material12"]) ? $_GET["material12"] : null;
$material13 = isset($_GET["material13"]) ? $_GET["material13"] : null;
$material14 = isset($_GET["material14"]) ? $_GET["material14"] : null;
$material15 = isset($_GET["material15"]) ? $_GET["material15"] : null;
$datapostagem = isset($_GET["edtdata"]) ? $_GET["edtdata"] : null;

$meses = array ('01' => "Janeiro", '02' => "Fevereiro", '03' => "Março", '04' => "Abril", '05' => "Maio", '06' => "Junho", '07' => "Julho", '08' => "Agosto", '09' => "Setembro", '10' => "Outubro", '11' => "Novembro", '12' => "Dezembro");

$data = explode(".",date("d.m.Y"));
$mes = $data[1];
$dataextenso = "São Paulo, $data[0] de $meses[$mes] de $data[2].";


class PDF extends FPDF {
  function Header() {
    $this->Image('img/fflch.png',10,10,-250);
    $this->SetFont('Arial','',10);
    $this->Cell(12);
    $this->Cell(0,5,"Universidade de São Paulo",0,1,'L');
    $this->Cell(12);
    $this->Cell(0,5,"Faculdade de Filosofia, Letras e Ciências Humanas",0,1,'L');
    $this->Cell(12);
    $this->SetFont('Arial','B',10);
    $this->Cell(0,5,"Serviço de Apoio Acadêmico",'T',1,'L');
  }

  function Footer() {
    $this->SetY(-20);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,4,"Rua do Lago, 717 - sala 107 - Prédio de Administração - Cidade Universitária - 05508-900 - São Paulo-SP",'T',1,'C');
    $this->Cell(0,4,"http://www.fflch.usp.br - Email: apoioaca1fflch@usp.br e/ou apoioaca2fflch@usp.br",0,0,'C');
  }
}

//Instanciation of inherited class
$pdf=new PDF('P','mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',18);
$pdf->Cell(0,30,'R  E  C  I  B  O',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,7,"$texto",0,'J');
$pdf->Ln(7);
if ( $material1 <> null ) {
  $pdf->Cell(0,7,'- Requerimento dirigido ao Diretor solicitando inscrição.',0,1,'L');
}
if ( $material2 <> null ) {
  $pdf->Cell(0,7,'- Dez cópias de Memorial circunstanciado e documentação comprobatória.',0,1,'L');
}
if ( $material3 <> null ) {
  $pdf->MultiCell(0,7,'- Comprovante de título de Doutor; outorgado ou reconhecido pela USP ou de validade Nacional ou fazer prova de pedido de reconhecimento junto aos órgãos competentes.',0,'J');
}
if ( $material4 <> null ) {
  $pdf->Cell(0,7,'- Prova de quitação com o serviço militar para candidatos do sexo masculino.',0,1,'L');
}
if ( $material5 <> null ) {
  $pdf->MultiCell(0,7,'- Título de Eleitor e comprovante da votação na última eleição, prova de pagamento da respectiva multa ou a devida justificativa.',0,'J');
}
if ( $material6 <> null ) {
  $pdf->Cell(0,7,'- Declaração de uso do computador conforme Portaria FFLCH nº 008/2017.',0,1,'L');
}
if ( $material7 <> null ) {
  $pdf->Cell(0,7,'- Atestado Pró-Libras emitido pelo Ministério da Educação.',0,1,'L');
}
if ( $material8 <> null ) {
  $pdf->Cell(0,7,'- Título de Livre-Docente outorgado pela USP ou por ela reconhecido.',0,1,'L');
}
if ( $material9 <> null ) {
  $pdf->Cell(0,7,'- Comprovante do Título de Mestre.',0,1,'L');
}
if ( $material10 <> null ) {
  $pdf->Cell(0,7,'- Comprovante de situação regular no país.',0,1,'L');
}
if ( $material11 <> null ) {
  $pdf->Cell(0,7,'- Cópia do passaporte.',0,1,'L');
}
if ( $material12 <> null ) {
  $pdf->Cell(0,7,"- Data de postagem $datapostagem.",0,1,'L');
}
if ( $material13 <> null ) {
  $pdf->Cell(0,7,"- Documento de identidade ( RG ou CNH ).",0,1,'L');
}
if ( $material14 <> null ) {
  $pdf->Cell(0,7,"- Procuração simples.",0,1,'L');
}
if ( $material15 <> null ) {
  $pdf->Cell(0,7,"- 10 cópias de tese de livre-docência.",0,1,'L');
}

$pdf->Ln(10);
$pdf->MultiCell(0,5,'Obs.: sendo o(a) interessado(a) docente em exercício na USP, fica dispensado(a) da documentação constante do parágrafo 1º do referido Edital.',0,'J');
$pdf->SetX(10);
$pdf->SetY(230);
$pdf->Cell(0,5,$dataextenso,0,1,'R');

$pdf->Output("recibo","I");

?>
