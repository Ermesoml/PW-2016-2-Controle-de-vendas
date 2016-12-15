<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/header.php");
  if ($user->GetData('tipo') != 'A'){
    echo '<div class="col-md-12 btn btn-danger" width="100%" margin-top=3px>Usuário não autorizado!</div>';
  }
  else{
?>
  
  <section class="content-header">
    <h1>
      Cadastro de usuários <small>KikADMIN</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=<?php $_SERVER['DOCUMENT_ROOT'] ?>"/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Cadastro de usuários</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Informações principais</h3>
            
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">
            <div class="form-group">
              <div class="col-md-2">
                <label for="eUsuarioID">Código</label>
                <input type="text" class="form-control" id="eUsuarioID" readonly>
              </div>
              <div class="col-md-5">
                <label for="eNome">Nome</label>
                <input type="text" class="form-control" id="eNome" placeholder="Informe o nome do cliente">
              </div>
              <div class="col-md-3">
                <label for="eLogin">Login</label>
                <input type="text" class="form-control" id="eLogin" placeholder="Login">
              </div>
              <div class="col-md-2">
                <label for="eSenha">Senha</label>
                <input type="password" class="form-control" id="eSenha">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2">
                <label for="eTelefone">Telefone</label>
                <input type="text" class="form-control" id="eTelefone">
              </div>
              <div class="col-md-10">
                <label for="eEmail">Email</label>
                <input type="email" class="form-control" id="eEmail" placeholder="Informe o endereço">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-7">
                <label for="eCargo">Cargo</label>
                <input type="text" class="form-control" id="eCargo">
              </div>
              <div class="col-md-3">
                <label for="eTipo">Tipo de usuário</label>
                <select class="form-control" id="eTipo">
                  <option value="V" selected="true">Vendedor</option>
                  <option value="S">Supservisor</option>
                  <option value="A">Administrador</option>
                </select>
              </div>
              <div class="col-md-2">
                <label for="eBanido">Banido</label>
                <select class="form-control" id="eBanido">
                  <option value="S">Sim</option>
                  <option value="N" selected="true">Não</option>
                </select>
              </div>
            </div>
          </div>
        <div>
      </div>
    </div>

    <div class="form-group" align="right">
      <label class="col-lg-1"></label>
        <button type="button" class="btn btn-success" id="gravar-usuario" width="100%">Gravar</button>
      </div>
    </div>

    <div id="resultado"></div>
  </section>

<?php
  } // Fechamento da autorização
?>

<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/footer.php");
?>

<script>
  $(document).ready(function() {
    if (findGetParameter('usuario-id') > 0){

      var dataString = 'action=get-usuario&usuario-id='+findGetParameter('usuario-id');
      document.getElementById("eSenha").disabled = true;

      $.ajax({
        url: "/model/usuariosModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          if(data) {
            var str_json = JSON.parse(data);

            $('#eUsuarioID').val(str_json[0].usuario_id);
            $('#eNome').val(str_json[0].nome);
            $('#eLogin').val(str_json[0].login);
            //$('#eSenha').val(str_json[0].senha);
            $('#eTelefone').val(str_json[0].telefone);
            $('#eEmail').val(str_json[0].email);
            $('#eCargo').val(str_json[0].cargo);
            $('#eTipo').val(str_json[0].tipo);
            $('#eBanido').val(str_json[0].banido);
          } else {
            $('#resultado').html('<div class="col-md-12 btn btn-danger" style="margin-top: 5px;">Algo não está certo, tente novamente!</div>');
            LimparCampos();
          }
        },
        error: function(data){
          $('#resultado').html('<div class="col-md-12 btn btn-danger" style="margin-top: 5px;">Ocorreu um erro!</div>');
        }
      });
    }

    $('#resultado').animate({opacity: 1}, 3000,function(){
      $('#resultado').html('');
    });

  });


  $('#gravar-usuario').click('input', function() {
    
    if ($('#eNome').val() == ''){
      alert('É necessário informar o nome do nome!');
      $('#eNome').focus();
      Exit;
    }

    if (($('#eTelefone').val() == '') && ($('#eEmail').val() == '')){
      alert('É necessário informar o telefone ou o email do usuário!');
      Exit;
    }

    if ($('#eLogin').val() == ''){
      alert('É necessário informar o nome do login!');
      $('#eLogin').focus();
      Exit;
    }

    if (($('#eSenha').val() == '') && ($('#eUsuarioID').val() == '')){
      alert('É necessário informar o nome do senha!');
      $('#eSenha').focus();
      Exit;
    }

    if ($('#eUsuarioID').val == ''){
      gravarUsuario(
        $('#eNome').val(), 
        $('#eTelefone').val(), 
        $('#eEmail').val(), 
        $('#eLogin').val(), 
        $('#eSenha').val(),
        $('#eCargo').val(),
        $('#eTipo').val(),
        $('#eBanido').val()
      );
    }
    else {
      alterarUsuario(
        $('#eUsuarioID').val(),
        $('#eNome').val(), 
        $('#eTelefone').val(), 
        $('#eEmail').val(), 
        $('#eLogin').val(), 
        $('#eCargo').val(),
        $('#eTipo').val(),
        $('#eBanido').val()
      )
    }
  });

  (function($) {

    findGetParameter = function (parameterName) {
      var result = null,
          tmp = [];
      var items = location.search.substr(1).split("&");
      for (var index = 0; index < items.length; index++) {
          tmp = items[index].split("=");
          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
      }
      return result;
    }

    LimparCampos = function(){
      $('#eUsuarioID').val('');
      $('#eNome').val('');
      $('#eTelefone').val('');	
      $('#eEmail').val('');
      $('#eLogin').val('');
      $('#eSenha').val('');
      $('#eCargo').val('');
      $('#eTipo').val('V');
      $('#eBanido').val('N'); 	
    };

    gravarUsuario = function (nome, telefone, email, login, senha, cargo, tipo, banido) {
      var dataString = 'action=gravar-usuario&usuario-nome='+nome+
      '&usuario-telefone='+telefone+
      '&usuario-email='+email+
      '&usuario-login='+login+
      '&usuario-senha='+senha+
      '&usuario-cargo='+cargo+
      '&usuario-tipo='+tipo+
      '&usuario-banido='+banido;

      $.ajax({
        url: "/model/usuariosModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          if(data) {
            $('#resultado').html('<div class="col-md-12 btn btn-danger" style="margin-top: 5px;">'+data+'</div>');
          } else {          
            $('#resultado').html('<div class="col-md-12 btn btn-success" style="margin-top: 5px;">Usuário inserido com sucesso!</div>');
            LimparCampos();
          }
        }
      });

      $('#resultado').animate({opacity: 1}, 3000,function(){
        $('#resultado').html('');
      });
    };

    alterarUsuario = function (usuarioID, nome, telefone, email, login, cargo, tipo, banido) {
      var dataString = 'action=alterar-usuario&usuario-id='+ usuarioID +
        '&usuario-nome='+nome+
        '&usuario-telefone='+telefone+
        '&usuario-email='+email+
        '&usuario-login='+login+
        '&usuario-cargo='+cargo+
        '&usuario-tipo='+tipo+
        '&usuario-banido='+banido;

      $.ajax({
        url: "/model/usuariosModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          if(data) {
            $('#resultado').html('<div class="col-md-12 btn btn-danger" style="margin-top: 5px;">'+data+'</div>');
          } else {          
            $('#resultado').html('<div class="col-md-12 btn btn-success" style="margin-top: 5px;">Usuário alterado com sucesso!</div>');
            LimparCampos();
          }
        }
      });

      $('#resultado').animate({opacity: 1}, 1500,function(){
        $('#resultado').html('');
        $(location).attr('href', '/pages/relatorios/usuarios.php');
      });
    };

	})(jQuery);

  (function($) {RemoverLinha = function(handler) {
      var tr = $(handler).closest('tr');

      tr.fadeOut(400, function(){ 
        tr.remove(); 
      }); 

      return false;
    };
  })(jQuery);
</script>

