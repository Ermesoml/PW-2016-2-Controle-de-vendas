<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'/model/connection.php');

  /* Inserir usuario */
	if(isset($_POST['action']) && $_POST['action'] == 'gravar-usuario') {

		if(isset($_POST['usuario-nome']) &&  is_string($_POST['usuario-nome']) && !empty($_POST['usuario-nome']) &&
      (
        isset($_POST['usuario-email']) &&  is_string($_POST['usuario-email']) && !empty($_POST['usuario-email']) || 
        isset($_POST['usuario-telefone']) &&  is_string($_POST['usuario-telefone']) && !empty($_POST['usuario-telefone'])
      ) &&
      isset($_POST['usuario-login']) &&  is_string($_POST['usuario-login']) && !empty($_POST['usuario-login']) &&
      isset($_POST['usuario-senha']) &&  is_string($_POST['usuario-senha']) && !empty($_POST['usuario-senha']) &&
      isset($_POST['usuario-cargo']) &&  is_string($_POST['usuario-cargo']) && !empty($_POST['usuario-cargo']) &&
      isset($_POST['usuario-tipo']) &&  is_string($_POST['usuario-tipo']) && !empty($_POST['usuario-tipo']) &&
      isset($_POST['usuario-banido']) &&  is_string($_POST['usuario-banido']) && !empty($_POST['usuario-banido'])
    ) {

			$nome = stripslashes(strip_tags($_POST['usuario-nome']));
      $telefone = stripslashes(strip_tags($_POST['usuario-telefone']));
      $email = stripslashes(strip_tags($_POST['usuario-email']));
      $login = stripslashes(strip_tags($_POST['usuario-login']));
      $senha = md5(stripslashes(strip_tags($_POST['usuario-senha'])));

      $cargo = stripslashes(strip_tags($_POST['usuario-cargo']));
      $tipo = stripslashes(strip_tags($_POST['usuario-tipo']));
      $banido = stripslashes(strip_tags($_POST['usuario-banido']));
			
			$stmt = $pdo->prepare('insert into usuarios(NOME, TELEFONE, EMAIL, LOGIN, SENHA, CARGO, TIPO, BANIDO) values (:nome, :telefone, :email, :login, :senha, :cargo, :tipo, :banido)');

      try {
    		$stmt->execute(
          array(
            ':nome' => $nome, 
            ':telefone' => $telefone, 
            ':email' => $email,
            ':login' => $login,
            ':senha' => $senha,
            ':cargo' => $cargo,
            ':tipo' => $tipo,
            ':banido' => $banido
          )
        );	
      } catch(Exception $e){
        echo 'Erro: ', $e->getMessage(), "\n";
      }
			
		} else {
			echo('Erro: Preencha todos os campos corretamente!');
		}
	}

  /* Inserir usuario */
  if(isset($_POST['action']) && $_POST['action'] == 'alterar-usuario') {
    if(
      isset($_POST['usuario-id']) &&  is_numeric($_POST['usuario-id']) && !empty($_POST['usuario-id']) &&
      isset($_POST['usuario-nome']) &&  is_string($_POST['usuario-nome']) && !empty($_POST['usuario-nome']) &&
      (
        isset($_POST['usuario-email']) &&  is_string($_POST['usuario-email']) && !empty($_POST['usuario-email']) || 
        isset($_POST['usuario-telefone']) &&  is_string($_POST['usuario-telefone']) && !empty($_POST['usuario-telefone'])
      ) &&
      isset($_POST['usuario-login']) &&  is_string($_POST['usuario-login']) && !empty($_POST['usuario-login']) &&
      isset($_POST['usuario-cargo']) &&  is_string($_POST['usuario-cargo']) && !empty($_POST['usuario-cargo']) &&
      isset($_POST['usuario-tipo']) &&  is_string($_POST['usuario-tipo']) && !empty($_POST['usuario-tipo']) &&
      isset($_POST['usuario-banido']) &&  is_string($_POST['usuario-banido']) && !empty($_POST['usuario-banido'])
    ) {

      $usuarioID = stripslashes(strip_tags($_POST['usuario-id']));
      $nome = stripslashes(strip_tags($_POST['usuario-nome']));
      $telefone = stripslashes(strip_tags($_POST['usuario-telefone']));
      $email = stripslashes(strip_tags($_POST['usuario-email']));
      $login = stripslashes(strip_tags($_POST['usuario-login']));

      $cargo = stripslashes(strip_tags($_POST['usuario-cargo']));
      $tipo = stripslashes(strip_tags($_POST['usuario-tipo']));
      $banido = stripslashes(strip_tags($_POST['usuario-banido']));
      
      $stmt = $pdo->prepare('update usuarios set NOME = :nome, TELEFONE = :telefone, EMAIL = :email, LOGIN = :login,  CARGO = :cargo, TIPO = :tipo, BANIDO = :banido where usuario_id = :usuario_id');

      try {
        $stmt->execute(
          array(
            ':usuario_id' => $usuarioID,
            ':nome' => $nome, 
            ':telefone' => $telefone, 
            ':email' => $email,
            ':login' => $login,
            ':cargo' => $cargo,
            ':tipo' => $tipo,
            ':banido' => $banido
          )
        );  
      } catch(Exception $e){
        echo 'Erro: ', $e->getMessage(), "\n";
      }
      
    } else {
      echo($_POST['usuario-id']);
    }
  }

  // Buscar usuário
  if(isset($_POST['action']) && $_POST['action'] == 'get-usuario') {
    if(isset($_POST['usuario-id']) && !empty($_POST['usuario-id'])
    ) {
        
      $usuarioID = stripslashes(strip_tags($_POST['usuario-id']));

      $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE usuario_id = :usuario_id');
      $stmt->bindParam(':usuario_id', $usuarioID);
      $stmt->execute();

      $arr = array();
      foreach($stmt->fetchAll() as $rows) {
        $arr[] = $rows;
      }

      echo $o_json = json_encode($arr);
      
    } else {
      echo('Erro ao gravar o usuario: Preencha todos os campos corretamente!');
    }
  }
?>