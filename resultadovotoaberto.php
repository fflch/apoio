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
$votocedulahelper = new VotoCedulaHelper();
$votoinscricaohelper = new VotoInscricaoHelper();
$votobancahelper = new VotoBancaHelper();
$votorelatoriohelper = new VotoRelatorioHelper();
$votooutrohelper = new VotoOutroHelper();

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
  function VerificaX($limite) {
    $x = $this->GetX();
    if ($x == $limite) {
      $this->Cell(95,5,'',1,1,'L');
    }
    else if ($x > $limite) {
      $this->Ln();
    }
  }
}

//Instanciation of inherited class
$pdf=new PDF('P','mm', 'A4');
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(225,225,225);

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
  $banco = $_SESSION[BANCO_SESSAO];
}

#consulta inscricao
$sql = "SELECT C.ID, C.IDCONCURSO, C.ITEM, C.PAUTA, C.BRANCO, C.NULO,
        CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO
        FROM CEDULAS C INNER JOIN CONCURSOS CO ON(C.IDCONCURSO=CO.ID)
        WHERE C.DATA='$data' AND C.TIPO='I' AND C.PERTENCE='$composicao' AND C.VOTACAO='F';";
$res_inscricao = Consulta($sql, $banco);
#consulta banca
$sql = "SELECT C.ID, C.IDCONCURSO, C.ITEM, C.PAUTA, C.BRANCO, C.NULO,
        CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO
        FROM CEDULAS C INNER JOIN CONCURSOS CO ON(C.IDCONCURSO = CO.ID)
        WHERE C.DATA='$data' AND C.TIPO='B' AND C.PERTENCE='$composicao' AND C.VOTACAO='F';";
$res_banca = Consulta($sql, $banco);
#consulta relatorio
$sql = "SELECT C.ID, C.ITEM, C.PAUTA, C.BRANCO, C.NULO,
        R.PERGUNTA, R.SIM, R.NAO, CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO
        FROM CEDULAS C INNER JOIN RELATORIOS R ON(C.ID = R.IDCEDULA) INNER JOIN CONCURSOS CO ON(C.IDCONCURSO=CO.ID)
        WHERE C.DATA='$data' AND C.TIPO='R' AND C.PERTENCE='$composicao' AND C.VOTACAO='F';";
$res_relatorio = Consulta($sql, $banco);
#consulta outro
$sql = "SELECT C.ID, C.ITEM, C.PAUTA, C.DESCRICAOOUTRO, C.BRANCO, C.NULO, O.PERGUNTA, O.SIM, O.NAO
        FROM CEDULAS C INNER JOIN OUTROS O ON(C.ID = O.IDCEDULA)
        WHERE C.DATA='$data' AND C.TIPO='O' AND C.PERTENCE='$composicao' AND C.VOTACAO='F';";
$res_outro = Consulta($sql, $banco);

if (count($res_inscricao) > 0) {
  $pdf->AddPage();
  foreach ($res_inscricao as $inscricao) {
  	foreach ($inscricao as $campo => $valor) {
      if (strcasecmp($campo, "id") == 0) {
	      $idcedula = $valor;
      }
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
    $sql = "SELECT IDPESSOA, NOME, SIM, NAO FROM CONCURSOSXCANDIDATOS
            INNER JOIN PESSOAS P ON(IDPESSOA = ID) WHERE IDCONCURSO=$idconcurso ORDER BY SIM DESC;";
    $nom_inscricao = Consulta($sql, $banco);
    foreach ($nom_inscricao as $candidato) {
      $pdf->VerificaX(105.00125);
  	  foreach ($candidato as $campo => $valor) {
        if (strcasecmp($campo, "idpessoa") == 0) {
          $idpessoa = $valor;
        }
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
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(130,5,$nome,'L',0,'L',true);
      $pdf->Cell(30,5,$sim,0,0,'C',true);
      $pdf->Cell(30,5,$nao,'R',1,'C',true);
      $pdf->SetFont('Arial','',8);
      if (!is_null($idpessoa)) {
        $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $idcedula, "idcandidato" => $idpessoa));
        try {
          $result_votoinscricao = $votoinscricaohelper->consultar($banco, array("nome","voto"), $filtro, array("nome"));
        }
        catch(Exception $e) {
          $mensagem = "Erro ao executar a consulta. Erro: " . $e->getMessage();
        }
        $voto_nao = array();
        if (count($result_votoinscricao) > 0) {
          $pdf->SetFont('Arial','B',8);
          $pdf->Cell(190,5,"Voto Sim",1,1,'C');
          $pdf->SetFont('Arial','',8);
          foreach($result_votoinscricao as $votoinscricao) {
            $nome_votante = $votoinscricao->getNome();
            $voto_votante = $votoinscricao->getVoto();
            if (strcasecmp($voto_votante, "sim") == 0) {
              $pdf->Cell(95,5,$nome_votante,1,0,'L');
            }
            elseif (strcasecmp($voto_votante, "nao") == 0) {
              $voto_nao[] = $nome_votante;
            }
            $pdf->VerificaX(200);
          }
          $pdf->VerificaX(105.00125);
          if (count($voto_nao) > 0) {
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(190,5,"Voto Não",1,1,'C');
            $pdf->SetFont('Arial','',8);
            foreach($voto_nao as $nome) {
              $pdf->Cell(95,5,$nome,1,0,'L');
              $pdf->VerificaX(200);
            }
          }
        }
      }
    }
    $pdf->VerificaX(105.00125);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(0,5,'Total em Branco = '.$branco.' e em Nulo = '.$nulo,1,1,'L',true);
    $pdf->SetFont('Arial','',8);
    $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $idcedula));
    try {
      $result_votocedula = $votocedulahelper->consultar($banco, array("nome","voto"), $filtro, array("nome"));
    }
    catch(Exception $e) {
      $mensagem = "Erro ao executar a consulta. Erro: " . $e->getMessage();
    }
    $voto_nulo = array();
    if (count($result_votocedula) > 0) {
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(190,5,"Voto Branco",1,1,'C');
      $pdf->SetFont('Arial','',8);
      foreach($result_votocedula as $votocedula) {
        $nome_votante = $votocedula->getNome();
        $voto_votante = $votocedula->getVoto();
        if (strcasecmp($voto_votante, "branco") == 0) {
          $pdf->Cell(95,5,$nome_votante,1,0,'L');
        }
        elseif (strcasecmp($voto_votante, "nulo") == 0) {
          $voto_nulo[] = $nome_votante;
        }
        $pdf->VerificaX(200);
      }
      $pdf->VerificaX(105.00125);
      if (count($voto_nulo) > 0) {
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(190,5,"Voto Nulo",1,1,'C');
        $pdf->SetFont('Arial','',8);
        foreach($voto_nulo as $nome) {
          $pdf->Cell(95,5,$nome,1,0,'L');
          $pdf->VerificaX(200);
        }
      }
    }
    $pdf->Ln(5);
  }
}
if(count($res_banca) > 0 ) {
  $pdf->AddPage();
  foreach ($res_banca as $banca) {
  	foreach ($banca as $campo => $valor) {
      if (strcasecmp($campo, "id") == 0) {
        $idcedula = $valor;
      }
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
    $pdf->MultiCell(0,5,"$descricao, área de $area, conforme edital $edital, publicado em $datapublicacao.",1,'L');
    $sql = "SELECT C.IDPESSOA, P.NOME, C.ORIGEM, C.VOTO FROM COMISSOES C INNER JOIN PESSOAS P ON(C.IDPESSOA=P.ID)
            WHERE C.IDCONCURSO=$idconcurso ORDER BY C.ORIGEM, C.VOTO DESC;";
    $nom_banca = Consulta($sql, $banco);
    foreach ($nom_banca as $banca) {
      $pdf->VerificaX(105.00125);
  	  foreach ($banca as $campo => $valor) {
        if (strcasecmp($campo, "idpessoa") == 0) {
          $idpessoa = $valor;
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
      }
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(130,5,$nome,'L',0,'L',true);
      $pdf->Cell(30,5,$origem,0,0,'C',true);
      $pdf->Cell(30,5,$voto,'R',1,'C',true);
      $pdf->SetFont('Arial','',8);
      if (!is_null($idpessoa)) {
        $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $idcedula, "idpessoacomissao" => $idpessoa));
        try {
          $result_votobanca = $votobancahelper->consultar($banco, array("nome"), $filtro, array("nome"));
        }
        catch(Exception $e) {
          $mensagem = "Erro ao executar a consulta. Erro: " . $e->getMessage();
        }
        if (count($result_votobanca) > 0) {
          $pdf->SetFont('Arial','B',8);
          $pdf->Cell(190,5,"Votantes",1,1,'C');
          $pdf->SetFont('Arial','',8);
          foreach($result_votobanca as $votobanca) {
            $nome_votante = $votobanca->getNome();
            $pdf->Cell(95,5,$nome_votante,1,0,'L');
            $pdf->VerificaX(200);
          }
        }
      }
    }
    $sql = "SELECT ID, NOME, ORIGEM FROM COMISSOESEXTERNAS WHERE IDCONCURSO=$idconcurso ORDER BY ORIGEM;";
    $banca_externa = Consulta($sql, $banco);
      if (count($banca_externa) > 0 ) {
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(0,5,'Nomes Digitados',1,1,'C');
      $pdf->SetFont('Arial','',8);
      $votobancaexternahelper = new VotoBancaExternaHelper();
      foreach ($banca_externa as $externa) {
        $pdf->VerificaX(105.00125);
  	    foreach ($externa as $campo => $valor) {
          if (strcasecmp($campo, "id") == 0 ) {
            $idpessoa = $valor;
          }
      	  if (strcasecmp($campo, "nome") == 0) {
	          $nome = $valor;
          }
	        if (strcasecmp($campo, "origem") == 0) {
	          $origem = $valor;
          }
        }
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(130,5,$nome,'L',0,'L',true);
        $pdf->Cell(30,5,$origem,0,0,'C',true);
        $pdf->Cell(30,5,"1",'R',1,'C',true);
        $pdf->SetFont('Arial','',8);
        if (!is_null($idpessoa)) {
          $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $idcedula, "idpessoacomissao" => $idpessoa));
          try {
            $result_votobancaexterna = $votobancaexternahelper->consultar($banco, array("nome"), $filtro, array("nome"));
          }
          catch(Exception $e) {
            $mensagem = "Erro ao executar a consulta. Erro: " . $e->getMessage();
          }
          if (count($result_votobancaexterna) > 0) {
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(190,5,"Votantes",1,1,'C');
            $pdf->SetFont('Arial','',8);
            foreach($result_votobancaexterna as $votobancaexterna) {
              $nome_votante = $votobancaexterna->getNome();
              $pdf->Cell(95,5,$nome_votante,1,0,'L');
              $pdf->VerificaX(200);
            }
          }
        }
      }
    }
    $pdf->VerificaX(105.00125);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(0,5,'Total em Branco = '.$branco.' e em Nulo = '.$nulo,1,1,'L',true);
    $pdf->SetFont('Arial','',8);
    $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $idcedula));
    try {
      $result_votocedula = $votocedulahelper->consultar($banco, array("nome","voto"), $filtro, array("nome"));
    }
    catch(Exception $e) {
      $mensagem = "Erro ao executar a consulta. Erro: " . $e->getMessage();
    }
    $voto_nulo = array();
    if (count($result_votocedula) > 0) {
      $pdf->VerificaX(105.00125);
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(190,5,"Voto Branco",1,1,'C');
      $pdf->SetFont('Arial','',8);
      foreach($result_votocedula as $votocedula) {
        $nome_votante = $votocedula->getNome();
        $voto_votante = $votocedula->getVoto();
        if (strcasecmp($voto_votante, "branco") == 0) {
          $pdf->Cell(95,5,$nome_votante,1,0,'L');
        }
        elseif (strcasecmp($voto_votante, "nulo") == 0) {
          $voto_nulo[] = $nome_votante;
        }
        $pdf->VerificaX(200);
      }
      if (count($voto_nulo) > 0) {
        $pdf->VerificaX(10.00125);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(190,5,"Voto Nulo",1,1,'C');
        $pdf->SetFont('Arial','',8);
        foreach($voto_nulo as $nome) {
          $pdf->Cell(95,5,$nome,1,0,'L');
          $pdf->VerificaX(200);
        }
      }
    }
    $pdf->VerificaX(105.00125);
    $pdf->Ln(5);
  }
}

//
if(count($res_relatorio) > 0 ) {
  $pdf->AddPage();
  foreach ($res_relatorio as $relatorio) {
  	foreach ($relatorio as $campo => $valor) {
      if (strcasecmp($campo, "id") == 0 ) {
        $idcedula = $valor;
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
    $pdf->SetFont('Arial','B',8);
    $pdf->MultiCell(0,5,$pergunta."\nSim = ".$sim.'      Não = '.$nao,1,'C',true);
    $pdf->SetFont('Arial','',8);
    if (!is_null($idcedula)) {
      $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $idcedula));
      try {
        $result_votorelatorio = $votorelatoriohelper->consultar($banco, array("nome","voto"), $filtro, array("nome"));
      }
      catch(Exception $e) {
        $mensagem = "Erro ao executar a consulta. Erro: " . $e->getMessage();
      }
      $voto_nao = array();
      if (count($result_votorelatorio) > 0) {
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(190,5,"Voto Sim",1,1,'C');
        $pdf->SetFont('Arial','',8);
        foreach($result_votorelatorio as $votorelatorio) {
          $nome_votante = $votorelatorio->getNome();
          $voto_votante = $votorelatorio->getVoto();
          if (strcasecmp($voto_votante, "sim") == 0) {
            $pdf->Cell(95,5,$nome_votante,1,0,'L');
          }
          elseif (strcasecmp($voto_votante, "nao") == 0) {
            $voto_nao[] = $nome_votante;
          }
          $pdf->VerificaX(200);
        }
        if (count($voto_nao) > 0) {
          $pdf->VerificaX(105.00125);
          $pdf->SetFont('Arial','B',8);
          $pdf->Cell(190,5,"Voto Não",1,1,'C');
          $pdf->SetFont('Arial','',8);
          foreach($voto_nao as $nome) {
            $pdf->Cell(95,5,$nome,1,0,'L');
            $pdf->VerificaX(200);
          }
        }
      } 
    }
    $pdf->VerificaX(105.00125);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(190,5,'Total em Branco = '.$branco.' e em Nulo = '.$nulo,1,1,'L',true);
    $pdf->SetFont('Arial','',8);
    $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $idcedula));
    try {
      $result_votocedula = $votocedulahelper->consultar($banco, array("nome","voto"), $filtro, array("nome"));
    }
    catch(Exception $e) {
      $mensagem = "Erro ao executar a consulta. Erro: " . $e->getMessage();
    }
    $voto_nulo = array();
    if (count($result_votocedula) > 0) {
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(190,5,"Voto Branco",1,1,'C');
      $pdf->SetFont('Arial','',8);
      foreach($result_votocedula as $votocedula) {
        $nome_votante = $votocedula->getNome();
        $voto_votante = $votocedula->getVoto();
        if (strcasecmp($voto_votante, "branco") == 0) {
          $pdf->Cell(95,5,$nome_votante,1,0,'L');
        }
        elseif (strcasecmp($voto_votante, "nulo") == 0) {
          $voto_nulo[] = $nome_votante;
        }
        $pdf->VerificaX(200);
      }
      if (count($voto_nulo) > 0) {
        $pdf->VerificaX(105.00125);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(190,5,"Voto Nulo",1,1,'C');
        $pdf->SetFont('Arial','',8);
        foreach($voto_nulo as $nome) {
          $pdf->Cell(95,5,$nome,1,0,'L');
          $pdf->VerificaX(200);
        }
      }
    }
    $pdf->VerificaX(105.00125);
    $pdf->Ln(5);
  }
}
//

if(count($res_outro) > 0 ) {
  $pdf->AddPage();
  foreach ($res_outro as $outro) {
  	foreach ($outro as $campo => $valor) {
      if (strcasecmp($campo, "id") == 0 ) {
        $idcedula = $valor;
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
    $pdf->SetFont('Arial','B',8);
    $pdf->MultiCell(0,5,$pergunta."\nSim = ".$sim.'      Não = '.$nao,1,'C',true);
    $pdf->SetFont('Arial','',8);
    if (!is_null($idcedula)) {
      $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $idcedula));
      try {
        $result_votooutro = $votooutrohelper->consultar($banco, array("nome","voto"), $filtro, array("nome"));
      }
      catch(Exception $e) {
        $mensagem = "Erro ao executar a consulta. Erro: " . $e->getMessage();
      }
      $voto_nao = array();
      if (count($result_votooutro) > 0) {
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(190,5,"Voto Sim",1,1,'C');
        $pdf->SetFont('Arial','',8);
        foreach($result_votooutro as $votooutro) {
          $nome_votante = $votooutro->getNome();
          $voto_votante = $votooutro->getVoto();
          if (strcasecmp($voto_votante, "sim") == 0) {
            $pdf->Cell(95,5,$nome_votante,1,0,'L');
          }
          elseif (strcasecmp($voto_votante, "nao") == 0) {
            $voto_nao[] = $nome_votante;
          }
          $pdf->VerificaX(200);
        }
        if (count($voto_nao) > 0) {
          $pdf->VerificaX(105.00125);
          $pdf->SetFont('Arial','B',8);
          $pdf->Cell(190,5,"Voto Não",1,1,'C');
          $pdf->SetFont('Arial','',8);
          foreach($voto_nao as $nome) {
            $pdf->Cell(95,5,$nome,1,0,'L');
            $pdf->VerificaX(200);
          }
        }
      }
    }
    $pdf->VerificaX(105.00125);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(190,5,'Total em Branco = '.$branco.' e em Nulo = '.$nulo,1,1,'L',true);
    $pdf->SetFont('Arial','',8);
    $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $idcedula));
    try {
      $result_votocedula = $votocedulahelper->consultar($banco, array("nome","voto"), $filtro, array("nome"));
    }
    catch(Exception $e) {
      $mensagem = "Erro ao executar a consulta. Erro: " . $e->getMessage();
    }
    $voto_nulo = array();
    if (count($result_votocedula) > 0) {
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(190,5,"Voto Branco",1,1,'C');
      $pdf->SetFont('Arial','',8);
      foreach($result_votocedula as $votocedula) {
        $nome_votante = $votocedula->getNome();
        $voto_votante = $votocedula->getVoto();
        if (strcasecmp($voto_votante, "branco") == 0) {
          $pdf->Cell(95,5,$nome_votante,1,0,'L');
        }
        elseif (strcasecmp($voto_votante, "nulo") == 0) {
          $voto_nulo[] = $nome_votante;
        }
        $pdf->VerificaX(200);
      }
      if (count($voto_nulo) > 0) {
        $pdf->VerificaX(105.00125);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(190,5,"Voto Nulo",1,1,'C');
        $pdf->SetFont('Arial','',8);
        foreach($voto_nulo as $nome) {
          $pdf->Cell(95,5,$nome,1,0,'L');
          $pdf->VerificaX(200);
        }
      }
    }
    $pdf->VerificaX(105.00125);
    $pdf->Ln(5);
  }
}
if (count($res_inscricao) <= 0 && count($res_banca) <= 0 && count($res_relatorio) <= 0 && count($res_outro) <= 0)  {
  $pdf->AddPage();
  $pdf->Cell(0,20,'Não há registros para a consulta solicitada ou a votação não foi finalizada!',0,0,'C');
}

$pdf->Output("resultado","I");

function Consulta($sql, $banco) {
  if ($banco->abreConexao() == true) {
    $resultados = $banco->consultar($sql, $banco);
  }
  return $resultados;
  $banco->fechaConsulta($sql);
  $banco->fechaConexao();
}

?>
