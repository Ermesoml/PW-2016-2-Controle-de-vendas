<?php
  //$UserID = 12;
  //$_SESSION['auth'] = $UserID;

  require_once($_SERVER['DOCUMENT_ROOT'].'/model/connection.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../login.php"><b>Kik</b>ADMIN</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Insira seu usuário e senha</p>

    <form method="POST">
      <div class="form-group has-feedback">
        <input type="user" name="username" class="form-control" placeholder="Usuário">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Lembrar credenciais
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>

      <?php
        if(isset($_POST['login'])) {
          if(isset($_POST['username']) && isset($_POST['password']) &&
          is_string($_POST['username']) && is_string($_POST['password']) &&
          !empty($_POST['username']) && !empty($_POST['password'])) {
            $username = stripslashes(strip_tags($_POST['username']));
            $password = md5($_POST['password']);

            //$password = $_POST['password'];
            
            $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE login = :login');
            $stmt->bindParam(':login', $username);
            $stmt->execute();
            
            if($stmt->rowCount() > 0) {
              $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE login = :login AND senha = :senha');
              $stmt->execute(array(':login' => $username, ':senha' => $password));

              if($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
              
                $UserID = $row['usuario_id'];
                $time = time();
                //$IPAddress = $_SERVER['REMOTE_ADDR'];
                
                $_SESSION['auth'] = $UserID;
                
                /*$stmt = $pdo->prepare('INSERT INTO logs (LogUserID, LogDate, LogIPAddress) VALUES (:LogUserID, :LogDate, :LogIPAddress)');
                $stmt->execute(array(':LogUserID' => $UserID, ':LogDate' => $time, ':LogIPAddress' => $IPAddress));
                
                $display->ReturnSuccess('Login realizado com sucesso. Bem vindo '.$row['UserFirstName'].' '.$row['UserLastName'].' !');*/
                $settings->forceRedirect('index.php', 1);

                //echo $_SESSION['auth'] = $UserID;
                
              } else {
                echo ('Usuário ou senha inválidos! Favor tente novamente.');
              }
            } else {
              echo ('Usuário ou senha inválidos! Favor tente novamente.');
            }
          }
        }
      ?>

    <a href="#">Esqueci minha senha</a><br>

  </div>
</div>

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>


    <!-- <div class="social-auth-links text-center">
      <p>- OU -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in usando Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in usando Google+</a>
    </div>
    -->
    <!-- /.social-auth-links -->