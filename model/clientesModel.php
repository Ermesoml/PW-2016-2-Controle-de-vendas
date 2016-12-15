<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'/model/connection.php');

  /* Inserir Cliente */
	if(isset($_POST['action']) && $_POST['action'] == 'gravar-cliente') {
		if(isset($_POST['cliente-nome']) &&  is_string($_POST['cliente-nome']) && !empty($_POST['cliente-nome']) &&
      (
        isset($_POST['cliente-email']) &&  is_string($_POST['cliente-email']) && !empty($_POST['cliente-email']) || 
        isset($_POST['cliente-telefone']) &&  is_string($_POST['cliente-telefone']) && !empty($_POST['cliente-telefone'])
      )
    ) {
				
			$nome = stripslashes(strip_tags($_POST['cliente-nome']));
      $telefone = stripslashes(strip_tags($_POST['cliente-telefone']));
      $email = stripslashes(strip_tags($_POST['cliente-email']));
			
			$stmt = $pdo->prepare('insert into clientes(NOME, TELEFONE, EMAIL) values (:nome, :telefone, :email)');
			$stmt->execute(
        array(
          ':nome' => $nome, 
          ':telefone' => $telefone, 
          ':email' => $email
        )
      );	

      echo $pdo->lastInsertId();
			
		} else {
			echo('Erro: Preencha todos os campos corretamente!');
		}
	}

  /* Inserir ou alterar Rede social de Cliente */
	if(isset($_POST['action']) && $_POST['action'] == 'gravar-rede-social-cliente') {
		if(isset($_POST['cliente-id']) && !empty($_POST['cliente-id']) &&
      isset($_POST['rede-social']) &&  is_string($_POST['rede-social']) && !empty($_POST['rede-social']) &&
      isset($_POST['login']) &&  is_string($_POST['login']) && !empty($_POST['login']) &&
      isset($_POST['senha']) &&  is_string($_POST['senha']) && !empty($_POST['senha'])
    ) {
				
			$clienteId = stripslashes(strip_tags($_POST['cliente-id']));
      $redeSocial = stripslashes(strip_tags($_POST['rede-social']));
      $login = stripslashes(strip_tags($_POST['login']));
      $senha = stripslashes(strip_tags($_POST['senha']));
			
      $stmt = $pdo->prepare('delete from clientes_redes_sociais where cliente_id =:cliente_id');
      $stmt->execute(array(':cliente_id' => $clienteId));

			$stmt = $pdo->prepare('insert into clientes_redes_sociais(CLIENTE_ID, REDE_SOCIAL, LOGIN, SENHA) values (:cliente_id, :rede_social, :login, :senha)');
			$stmt->execute(
        array(
          ':cliente_id' => $clienteId,
          ':rede_social' => $redeSocial,
          ':login' => $login,
          ':senha' => $senha
        )
      );	
			
		} else {
			echo('Erro ao gravar as redes sociais: Preencha todos os campos corretamente!');
		}
	}

  /* Alterar Cliente */
  if(isset($_POST['action']) && $_POST['action'] == 'alterar-cliente') {
    if(
      isset($_POST['cliente-id']) &&  is_numeric($_POST['cliente-id']) && !empty($_POST['cliente-id']) &&
      isset($_POST['cliente-nome']) &&  is_string($_POST['cliente-nome']) && !empty($_POST['cliente-nome']) &&
      (
        isset($_POST['cliente-email']) &&  is_string($_POST['cliente-email']) && !empty($_POST['cliente-email']) || 
        isset($_POST['cliente-telefone']) &&  is_string($_POST['cliente-telefone']) && !empty($_POST['cliente-telefone'])
      )
    ) {
        
      $clienteID = stripslashes(strip_tags($_POST['cliente-id']));
      $nome = stripslashes(strip_tags($_POST['cliente-nome']));
      $telefone = stripslashes(strip_tags($_POST['cliente-telefone']));
      $email = stripslashes(strip_tags($_POST['cliente-email']));
      
      $stmt = $pdo->prepare('update clientes set NOME = :nome, TELEFONE = :telefone, EMAIL = :email where cliente_id = :cliente_id');
      $stmt->execute(
        array(
          ':cliente_id' => $clienteID,
          ':nome' => $nome, 
          ':telefone' => $telefone, 
          ':email' => $email
        )
      );  
      
    } else {
      echo('Erro ao alterar cliente: Preencha todos os campos corretamente!');
    }
  }

  /* Buscar redes sociais de um cliente para que esja adicionado em um select */
  if(isset($_POST['action']) && $_POST['action'] == 'get-redes-sociais') {
    $clienteID = stripslashes(strip_tags($_POST['cliente-id']));
    
    $stmt = $pdo->prepare('SELECT * FROM clientes_redes_sociais WHERE cliente_id = :cliente_id');
    $stmt->bindParam(':cliente_id', $clienteID);
    $stmt->execute();
  
    $html = '';
    
    foreach($stmt->fetchAll() as $rows) {
      $html .= '<option value="'.$rows['rede_social_id'].'">'.$rows['rede_social'].'</option>';
    }
    
    echo $html;
  }

  /* Buscar redes sociais de um cliente para que esja adicionado em um select */
  if(isset($_POST['action']) && $_POST['action'] == 'get-cliente-telefone') {
    $clienteID = stripslashes(strip_tags($_POST['cliente-id']));
    
    $stmt = $pdo->prepare('SELECT telefone FROM clientes WHERE cliente_id = :cliente_id');
    $stmt->bindParam(':cliente_id', $clienteID);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo $row['telefone'];
  }

  /* Buscar redes sociais de um cliente para que esja adicionado em um select */
  if(isset($_POST['action']) && $_POST['action'] == 'get-rede-social-login') {
    $redeSocialID = stripslashes(strip_tags($_POST['rede-social-id']));
    
    $stmt = $pdo->prepare('SELECT login FROM clientes_redes_sociais WHERE rede_social_id = :rede_social_id');
    $stmt->bindParam(':rede_social_id', $redeSocialID);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo $row['login'];
  }

  // Buscar usuário
  if(isset($_POST['action']) && $_POST['action'] == 'get-cliente') {
    if(isset($_POST['cliente-id']) && !empty($_POST['cliente-id'])
    ) {
        
      $clienteID = stripslashes(strip_tags($_POST['cliente-id']));

      $stmt = $pdo->prepare('SELECT * FROM clientes WHERE cliente_id = :cliente_id');
      $stmt->bindParam(':cliente_id', $clienteID);
      $stmt->execute();

      $arr = array();
      foreach($stmt->fetchAll() as $rows) {
        $arr[] = $rows;
      }

      echo $o_json = json_encode($arr);
      
    } else {
      echo('Erro ao carregar o cliente: Preencha todos os campos corretamente!');
    }
  }

  // Buscar usuário
  if(isset($_POST['action']) && $_POST['action'] == 'get-cliente-rede-social') {
    if(isset($_POST['cliente-id']) && !empty($_POST['cliente-id'])
    ) {
        
      $clienteID = stripslashes(strip_tags($_POST['cliente-id']));

      $stmt = $pdo->prepare('SELECT * FROM clientes_redes_sociais WHERE cliente_id = :cliente_id');
      $stmt->bindParam(':cliente_id', $clienteID);
      $stmt->execute();

      $arr = array();
      foreach($stmt->fetchAll() as $rows) {
        $arr[] = $rows;
      }

      echo $o_json = json_encode($arr);
      
    } else {
      echo('Erro ao carregar as redes sociais do cliente: Preencha todos os campos corretamente!');
    }
  }

?>
