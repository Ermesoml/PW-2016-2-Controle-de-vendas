<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'/model/connection.php');

  /* Inserir acompanhamento Cliente */
  if(isset($_POST['action']) && $_POST['action'] == 'gravar-acompanhamento') {
    if(isset($_POST['cliente-id']) && !empty($_POST['cliente-id']) &&
      isset($_POST['rede-social-id']) &&  is_string($_POST['rede-social-id']) && !empty($_POST['rede-social-id']) &&
      isset($_POST['descricao']) &&  is_string($_POST['descricao']) && !empty($_POST['descricao']) &&
      isset($_POST['responsavel']) &&  is_string($_POST['responsavel']) && !empty($_POST['responsavel']) &&
      isset($_POST['qtd-seg-inicial']) &&  is_numeric($_POST['qtd-seg-inicial']) && !empty($_POST['qtd-seg-inicial']) 
    ) {
        
      $clienteID = stripslashes(strip_tags($_POST['cliente-id']));
      $redeSocialID = stripslashes(strip_tags($_POST['rede-social-id']));
      $descricao = stripslashes(strip_tags($_POST['descricao']));
      $responsavel = stripslashes(strip_tags($_POST['responsavel']));
      $preco = stripslashes(strip_tags($_POST['preco']));
      $comissao = stripslashes(strip_tags($_POST['comissao']));
      $qtd_seg_inicial = stripslashes(strip_tags($_POST['qtd-seg-inicial']));


      $usuarioInserindo = $user->GetData('usuario_id');

      //$dataCadastro = date('Y-m-d',$dataCadastro);
      
      $stmt = $pdo->prepare('insert into clientes_acompanhamentos(CLIENTE_ID, CLIENTE_REDE_SOCIAL_ID, DESCRICAO, REPRESENTANTE, PRECO, COMISSAO, USUARIO_ID, QTD_SEG_INICIAL) values (:cliente_id, :rede_social_id, :descricao, :responsavel, :preco, :comissao, :usuario_id, :qtd_seg_inicial)');

      try {
        $stmt->execute(
        array(
          ':cliente_id' => $clienteID,
          ':rede_social_id' => $redeSocialID,
          ':descricao' => $descricao,
          ':responsavel' => $responsavel,
          ':preco' => $preco,
          ':comissao' => $comissao,
          ':usuario_id' => $usuarioInserindo,
          ':qtd_seg_inicial' => $qtd_seg_inicial
        )
      );
      } catch (Exception $e) {
          echo 'Erro: ',  $e->getMessage(), "\n";
      }  
      
    } else {
      echo('Erro ao gravar o acompanhamento: Preencha todos os campos corretamente!');
    }
  }

  /* Alterar Acompanhamento */
  if(isset($_POST['action']) && $_POST['action'] == 'alterar-acompanhamento') {
    if(
      isset($_POST['acompanhamento-id']) &&  is_numeric($_POST['acompanhamento-id']) && !empty($_POST['acompanhamento-id']) &&
      isset($_POST['descricao']) &&  is_string($_POST['descricao']) && !empty($_POST['descricao']) &&
      isset($_POST['responsavel']) &&  is_string($_POST['responsavel']) && !empty($_POST['responsavel']) 
    ) {
        
      $acompanhamentoID = stripslashes(strip_tags($_POST['acompanhamento-id']));
      $descricao = stripslashes(strip_tags($_POST['descricao']));
      $responsavel = stripslashes(strip_tags($_POST['responsavel']));
      $preco = stripslashes(strip_tags($_POST['preco']));
      $comissao = stripslashes(strip_tags($_POST['comissao']));
      $status = stripslashes(strip_tags($_POST['status']));
      $qtdSegAtual = stripslashes(strip_tags($_POST['qtd-seg-atual']));

      //$dataCadastro = date('Y-m-d',$dataCadastro);
      
      $stmt = $pdo->prepare('update clientes_acompanhamentos set DESCRICAO = :descricao, REPRESENTANTE = :responsavel, PRECO = :preco, COMISSAO = :comissao, STATUS = :status, QTD_SEG_ATUAL = :qtd_seg_atual where ACOMPANHAMENTO_ID = :acompanhamento_id');

      try {
        $stmt->execute(
        array(
          ':acompanhamento_id' => $acompanhamentoID,
          ':descricao' => $descricao,
          ':responsavel' => $responsavel,
          ':preco' => $preco,
          ':status' => $status,
          ':comissao' => $comissao,
          ':qtd_seg_atual' => $qtdSegAtual
        )
      );
      } catch (Exception $e) {
          echo 'Erro ',  $e->getMessage(), "\n";
      }  
      
    } else {
      echo('Erro ao gravar o acompanhamento: Preencha todos os campos corretamente!');
    }
  }

  /* Buscar acompanhamento */
  if(isset($_POST['action']) && $_POST['action'] == 'get-acompanhamento') {
    if(isset($_POST['acompanhamento-id']) && !empty($_POST['acompanhamento-id'])
    ) {
        
      $acompanhamentoID = stripslashes(strip_tags($_POST['acompanhamento-id']));

      $stmt = $pdo->prepare('SELECT * FROM vw_acompanhamentos WHERE acompanhamento_id = :acompanhamento_id');
      $stmt->bindParam(':acompanhamento_id', $acompanhamentoID);
      $stmt->execute();

      $arr = array();
      foreach($stmt->fetchAll() as $rows) {
        $arr[] = $rows;
      }

      echo $o_json = json_encode($arr);
      
    } else {
      echo('Erro ao gravar o acompanhamento: Preencha todos os campos corretamente!');
    }
  }

?>