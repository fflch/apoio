<?php
require_once ('/usr/local/lib/php/fpdf/fpdf.php');
require_once ('classes/Loader.class.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
if (!isset($_SESSION)) {
  session_start();
}

$composicao = isset($_GET["lstcomposicao"]) ? $_GET["lstcomposicao"] : 'cta';
$data = str_replace("/",".",isset($_GET["data"]) ? $_GET["data"] : date("d/m/Y"));
$res_inscricao = null;
$res_banca = null;
$res_relatorio = null;
$res_outro = null;

#consulta inscricao
$sql = "SELECT C.IDCONCURSO, C.ITEM, C.PAUTA, C.BRANCO, C.NULO,
        CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO
        FROM CEDULAS C INNER JOIN CONCURSOS CO ON(C.IDCONCURSO=CO.ID)
        WHERE C.DATA='$data' AND C.TIPO='I' AND C.PERTENCE='$composicao' AND C.VOTACAO='F';";
$res_inscricao = Consulta($sql);
#consulta banca
$sql = "SELECT C.IDCONCURSO, C.ITEM, C.PAUTA, C.BRANCO, C.NULO,
        CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO
        FROM CEDULAS C INNER JOIN CONCURSOS CO ON(C.IDCONCURSO = CO.ID)
        WHERE C.DATA='$data' AND C.TIPO='B' AND C.PERTENCE='$composicao' AND C.VOTACAO='F';";
$res_banca = Consulta($sql);
#consulta relatorio
$sql = "SELECT C.ITEM, C.PAUTA, C.BRANCO, C.NULO,
        R.PERGUNTA, R.SIM, R.NAO, CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO
        FROM CEDULAS C INNER JOIN RELATORIOS R ON(C.ID = R.IDCEDULA) INNER JOIN CONCURSOS CO ON(C.IDCONCURSO=CO.ID)
        WHERE C.DATA='$data' AND C.TIPO='R' AND C.PERTENCE='$composicao' AND C.VOTACAO='F';";
$res_relatorio = Consulta($sql);
#consulta outro
$sql = "SELECT C.ITEM, C.PAUTA, C.DESCRICAOOUTRO, C.BRANCO, C.NULO, O.PERGUNTA, O.SIM, O.NAO 
        FROM CEDULAS C INNER JOIN OUTROS O ON(C.ID = O.IDCEDULA)
        WHERE C.DATA='$data' AND C.TIPO='O' AND C.PERTENCE='$composicao' AND C.VOTACAO='F';";
$res_outro = Consulta($sql);

class PDF extends FPDF {
  //Page header
  function Header() {
    global $data, $composicao;
    if (strcasecmp($composicao,"cta") == 0 ) {
      $composicao = strtoupper($composicao);
  }
  else {
    $composicao = "Congregação";
  }
    $this->SetFont('Arial','B',12);
    $this->MultiCell(0,5,"Faculdade de Filosofia, Letras e Ciências Humanas\nResultado da Votação - $composicao - $data",1,'C');
    $this->Ln(5);
  }

  function Footer() {
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'R');
  }
}

//Instanciation of inherited class
$pdf=new PDF('P','mm', 'A4');
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',8);
if (count($res_inscricao) > 0) {
  $pdf->AddPage();


  foreach ($res_inscricao as $inscricao) {
  	foreach ($inscricao as $campo => $valor) {
      if (strcasecmp($campo, "idconcurso") == 0) {
	      $idconcurso = $valor;
      }
      if (strcasecmp($campo, "tipo") == 0) {
	      $tipo = $valor;
      }
	    if (strcasecmp($campo, "item") == 0) {
	      $item = $valor;
      }
	    if (strcasecmp($campo, "pauta") == 0) {
	      $pauta = $valor;
    	}
	    if (strcasecmp($campo, "branco") == 0) {
	      $branco = $valor;
      }
	    if (strcasecmp($campo, "nulo") == 0) {
	      $nulo = $valor;
      }
      if (strcasecmp($campo, "descricao") == 0){
        $descricao = $valor;
      }
      if (strcasecmp($campo, "area") == 0){
        $area = $valor;
      }
      if (strcasecmp($campo, "edital") == 0){
        $edital = $valor;
      }
      if (strcasecmp($campo, "datapublicacao") == 0){
        $datapublicacao = $valor;
      }
    }
    $pdf->Cell(40,5,$pauta,1,0,'L');
    $pdf->Cell(0,5,"Item $item",1,1,'L');
    $pdf->MultiCell(0,5,"$descricao, área de $area, conforme edital $edital, publicado em $datapublicacao.",1,'J');
    $pdf->Cell(130,5,'','L',0,'L');
    $pdf->Cell(30,5,"Sim",0,0,'C');
    $pdf->Cell(30,5,"Não",'R',1,'C');
    $sql = "SELECT NOME, SIM, NAO FROM CONCURSOSXCANDIDATOS
            INNER JOIN PESSOAS P ON(IDPESSOA = ID) WHERE IDCONCURSO=$idconcurso ORDER BY SIM DESC;";
    $nom_inscricao = Consulta($sql);
    foreach ($nom_inscricao as $candidato) {
  	  foreach ($candidato as $campo => $valor) {
      	if (strcasecmp($campo, "nome") == 0) {
	        $nome = $valor;
        }
	      if (strcasecmp($campo, "sim") == 0) {
	        $sim = $valor;
        }
	      if (strcasecmp($campo, "nao") == 0) {
	        $nao = $valor;
        }
      }
      $pdf->Cell(130,5,$nome,'L',0,'L');
      $pdf->Cell(30,5,$sim,0,0,'C');
      $pdf->Cell(30,5,$nao,'R',1,'C');
    }
    $pdf->Cell(0,5,'Total em Branco = '.$branco.' e em Nulo = '.$nulo,1,1,'L');
    $pdf->Ln(5);
  }
}
if(count($res_banca) > 0 ) {
  $pdf->AddPage();
  foreach ($res_banca as $banca) {
  	foreach ($banca as $campo => $valor) {
      if (strcasecmp($campo, "idconcurso") == 0) {
	      $idconcurso = $valor;
      }
      if (strcasecmp($campo, "tipo") == 0) {
	      $tipo = $valor;
      }
	    if (strcasecmp($campo, "item") == 0) {
	      $item = $valor;
      }
	    if (strcasecmp($campo, "pauta") == 0) {
	      $pauta = $valor;
    	}
	    if (strcasecmp($campo, "branco") == 0) {
	      $branco = $valor;
      }
	    if (strcasecmp($campo, "nulo") == 0) {
	      $nulo = $valor;
      }
	    if (strcasecmp($campo, "nome") == 0) {
	      $nome = $valor;
      }
	    if (strcasecmp($campo, "origem") == 0) {
	      $origem = $valor;
      }
	    if (strcasecmp($campo, "voto") == 0) {
	      $voto = $valor;
      }
      if (strcasecmp($campo, "descricao") == 0){
        $descricao = $valor;
      }
      if (strcasecmp($campo, "area") == 0){
        $area = $valor;
      }
      if (strcasecmp($campo, "edital") == 0){
        $edital = $valor;
      }
      if (strcasecmp($campo, "datapublicacao") == 0){
        $datapublicacao = $valor;
      }
    }
    $pdf->Cell(40,5,$pauta,1,0,'L');
    $pdf->Cell(0,5,"Item $item",1,1,'L');
    $pdf->MultiCell(0,5,"$descricao, área de $area, conforme edital $edital, publicado em $datapublicacao.",1,'L');
    $sql = "SELECT P.NOME, C.ORIGEM, C.VOTO FROM COMISSOES C INNER JOIN PESSOAS P ON(C.IDPESSOA=P.ID)
            WHERE C.IDCONCURSO=$idconcurso ORDER BY C.ORIGEM, C.VOTO DESC;";
    $nom_banca = Consulta($sql);
    foreach ($nom_banca as $banca) {
  	  foreach ($banca as $campo => $valor) {
      	if (strcasecmp($campo, "nome") == 0) {
	        $nome = $valor;
        }
	      if (strcasecmp($campo, "origem") == 0) {
	        $origem = $valor;
        }
	      if (strcasecmp($campo, "voto") == 0) {
	        $voto = $valor;
        }
      }
      $pdf->Cell(130,5,$nome,'L',0,'L');
      $pdf->Cell(30,5,$origem,0,0,'C');
      $pdf->Cell(30,5,$voto,'R',1,'C');
    }
    $sql = "SELECT NOME, ORIGEM FROM COMISSOESEXTERNAS WHERE IDCONCURSO=$idconcurso ORDER BY ORIGEM;";
    $banca_externa = Consulta($sql);
      if (count($banca_externa) > 0 ) {
      $pdf->Cell(0,5,'Nomes Digitados',1,1,'C');
      foreach ($banca_externa as $externa) {
  	    foreach ($externa as $campo => $valor) {
      	  if (strcasecmp($campo, "nome") == 0) {
	          $nome = $valor;
          }
	        if (strcasecmp($campo, "origem") == 0) {
	          $origem = $valor;
          }
        }
        $pdf->Cell(130,5,$nome,'L',0,'L');
        $pdf->Cell(30,5,$origem,0,0,'C');
        $pdf->Cell(30,5,"1",'R',1,'C');
      }
    }
    $pdf->Cell(0,5,'Total em Branco = '.$branco.' e em Nulo = '.$nulo,1,1,'L');
    $pdf->Ln(5);
  }
}
//
if(count($res_relatorio) > 0 ) {
  $pdf->AddPage();
  foreach ($res_relatorio as $relatorio) {
  	foreach ($relatorio as $campo => $valor) {
      if (strcasecmp($campo, "tipo") == 0) {
	      $tipo = $valor;
      }
	    if (strcasecmp($campo, "item") == 0) {
	      $item = $valor;
      }
	    if (strcasecmp($campo, "pauta") == 0) {
	      $pauta = $valor;
    	}
	    if (strcasecmp($campo, "branco") == 0) {
	      $branco = $valor;
      }
	    if (strcasecmp($campo, "nulo") == 0) {
	      $nulo = $valor;
      }
	    if (strcasecmp($campo, "pergunta") == 0) {
	      $pergunta = $valor;
      }
	    if (strcasecmp($campo, "sim") == 0) {
	      $sim = $valor;
      }
	    if (strcasecmp($campo, "nao") == 0) {
	      $nao = $valor;
      }
	    if (strcasecmp($campo, "descricao") == 0) {
	      $descricao = $valor;
      }
	    if (strcasecmp($campo, "area") == 0) {
	      $area = $valor;
      }
	    if (strcasecmp($campo, "edital") == 0) {
	      $edital = $valor;
      }
	    if (strcasecmp($campo, "datapublicacao") == 0) {
	      $datapublicacao = $valor;
      }
    }
    $pdf->Cell(40,5,$pauta,1,0,'L');
    $pdf->Cell(0,5,"Item $item",1,1,'L');
    $pdf->MultiCell(0,5,"$descricao, área de $area, conforme edital $edital, publicado em $datapublicacao.",1,'J');
    $pdf->MultiCell(0,5,$pergunta."\nSim = ".$sim.'      Não = '.$nao,1,'C');
    $pdf->Cell(190,5,'Total em Branco = '.$branco.' e em Nulo = '.$nulo,1,1,'L');
    $pdf->Ln(5);
  }
}
//
if(count($res_outro) > 0 ) {
  $pdf->AddPage();
  foreach ($res_outro as $outro) {
    foreach ($outro as $campo => $valor) {
      if (strcasecmp($campo, "tipo") == 0) {
	      $tipo = $valor;
      }
      if (strcasecmp($campo, "item") == 0) {
	      $item = $valor;
      }
      if (strcasecmp($campo, "pauta") == 0) {
	      $pauta = $valor;
      }
      if (strcasecmp($campo, "descricaooutro") == 0) {
	      $descricao = $valor;
      }
      if (strcasecmp($campo, "branco") == 0) {
	      $branco = $valor;
      }
      if (strcasecmp($campo, "nulo") == 0) {
	      $nulo = $valor;
      }
      if (strcasecmp($campo, "pergunta") == 0) {
	      $pergunta = $valor;
      }
      if (strcasecmp($campo, "sim") == 0) {
	      $sim = $valor;
      }
      if (strcasecmp($campo, "nao") == 0) {
	      $nao = $valor;
      }
    }
    $pdf->Cell(40,5,$pauta,1,0,'L');
    $pdf->Cell(0,5,"Item $item",1,1,'L');
    $pdf->MultiCell(0,5,"$descricao.",1,'J');
    $pdf->MultiCell(0,5,$pergunta."\nSim = ".$sim.'      Não = '.$nao,1,'C');
    $pdf->Cell(190,5,'Total em Branco = '.$branco.' e em Nulo = '.$nulo,1,1,'L');
    $pdf->Ln(5);
  }
}
if (count($res_inscricao) <= 0 && count($res_banca) <= 0 && count($res_outro) <= 0)  {
  $pdf->AddPage();
  $pdf->MultiCell(0,5,$sql,1,'J');
  $pdf->Cell(0,20,'Não há registros para a consulta solicitada ou a votação não foi finalizada!',0,0,'C');
}
$pdf->Output("resultado","I");

function Consulta($sql) {
  if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
    $banco = $_SESSION[BANCO_SESSAO];
    if ($banco->abreConexao() == true) {
      $resultados = $banco->consultar($sql);
    }
  }
  return $resultados;
  $banco->fechaConsulta($sql);
  $banco->fechaConexao();
}

?>
