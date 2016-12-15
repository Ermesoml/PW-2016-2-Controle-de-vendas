<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/header.php");
?>
  
  <section class="content-header">
    <h1>
      Cadastro de clientes <small>KikADMIN</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=<?php $_SERVER['DOCUMENT_ROOT'] ?>"/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Cadastro de clientes</li>
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
                <label for="eClienteID">Código</label>
                <input type="text" class="form-control" id="eClienteID" readonly>
              </div>
              <div class="col-md-10">
                <label for="eNome">Nome</label>
                <input type="text" class="form-control" id="eNome" placeholder="Informe o nome do cliente">
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
          </div>
        <div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Redes sociais</h3>
            
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">
            <div class="form-group">
              <div class="col-md-12">
                <table class="table">
                  <tr>
                    <th>Rede social</th>
                    <th>Login</th>
                    <th>Senha</th>
                  </tr>
                  <tr>
                    <td><input type="text" class="form-control" id="eRedeSocial" placeholder="Rede social"></td>
                    <td><input type="text" class="form-control" id="eLogin" placeholder="Login"></td>
                    <td><input type="text" class="form-control" id="eSenha" placeholder="Senha"></span></td>
                    <td><button class="btn btn-info" style='width:100%' id='bt-add-item'>Adicionar</button></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <table class="table" id="products-table">
                  <tr>
                    <th>Rede social</th>
                    <th>Login</th>
                    <th>Senha</th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        <div>
      </div>
    </div>

    <div class="form-group" align="right">
      <label class="col-lg-1"></label>
        <button type="button" class="btn btn-success" id="gravar-cliente" width="100%">Gravar</button>
      </div>
    </div>

    <div id="resultado"></div>
  </section>
    <!-- /.content -->
<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/footer.php");
?>

<script>
  $(document).ready(function() {
    if (findGetParameter('cliente-id') > 0){

      var dataString = 'action=get-cliente&cliente-id='+findGetParameter('cliente-id');

      $.ajax({
        url: "/model/clientesModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          if(data) {
            var str_json = JSON.parse(data);

            $('#eClienteID').val(str_json[0].cliente_id);
            $('#eNome').val(str_json[0].nome);
            $('#eTelefone').val(str_json[0].telefone);
            $('#eEmail').val(str_json[0].email);
          } else {
            $('#resultado').html('<div class="col-md-12 btn btn-danger" style="margin-top: 5px;">Algo não está certo, tente novamente!</div>');
            LimparCampos();
          }

          var dataStringRedesSociais = 'action=get-cliente-rede-social&cliente-id='+findGetParameter('cliente-id');

          $.ajax({
            url: "/model/clientesModel.php",
            type: 'POST',
            data: dataStringRedesSociais,
            success: function(data) {
              if(data) {
                var str_json_rede_social = JSON.parse(data);
                
                for (var i in str_json_rede_social) {
                  AddTableRow(str_json_rede_social[i]);
                }
              } else {
                $('#resultado').html('<div class="col-md-12 btn btn-danger" style="margin-top: 5px;">Algo não está certo, tente novamente!</div>');
                LimparCampos();
              }
            },
            error: function(data){
              $('#resultado').html('<div class="col-md-12 btn btn-danger" style="margin-top: 5px;">Ocorreu um erro!</div>');
            }
          });

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


  $('#bt-add-item').click('input', function() {
    
    var orderItem = {};     
    orderItem.rede_social = $('#eRedeSocial').val();
    orderItem.login = $('#eLogin').val();
    orderItem.senha = $('#eSenha').val();
    

    if (orderItem.rede_social == ''){
      alert('É necessário informar a rede social!');
      $('#eRedeSocial').focus();
      Exit;	
    }

    if (orderItem.login == ''){
      alert('É necessário informar o login!');
      $('#eLogin').focus();
      Exit;	
    }

    if (orderItem.senha == ''){
      alert('É necessário informar a senha!');
      $('#eSenha').focus();
      Exit;	
    }

    AddTableRow(orderItem);
  });

  $('#gravar-cliente').click('input', function() {
    if ($('#eNome').val() == ''){
      alert('É necessário informar o nome do cliente!');
      $('#eNome').focus();
      Exit;
    }
    if (($('#eTelefone').val() == '') && ($('#eEmail').val() == '')){
      alert('É necessário informar o telefone ou o email do cliente!');
      Exit;
    }

    var arrItens = new Array();
    var tabel = document.getElementById('products-table');
    var rijen = tabel.rows.length;

    for (i = 0; i < rijen; i++){
      var objItem = new Object();
      var input = tabel.rows.item(i).getElementsByTagName("input");
      var inputslength = input.length;   

      if (inputslength > 0){
        for(var n = 0; n < inputslength; n++){
          if (input[n].id == 'eRedeSocialCliente'){
            objItem.redeSocial = input[n].value;
          }

          if (input[n].id == 'eLoginCliente'){
            objItem.login = input[n].value;
          }

          if (input[n].id == 'eSenhaCliente'){
            objItem.senha = input[n].value;
          }
        }
      }

      if (objItem.redeSocial != null){
        arrItens.push(objItem);
      }
    }

    if ($('#eClienteID').val() == '')
      gravarCliente($('#eNome').val(), $('#eTelefone').val(), $('#eEmail').val(), arrItens);
    else
      alterarCliente($('#eClienteID').val(),$('#eNome').val(), $('#eTelefone').val(), $('#eEmail').val(), arrItens);  
    //submitOrder($('#eNome').val(), $('#eTelefone').val(), $('#eEmail').val(), arrItens);
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

	  AddTableRow = function(data) {
			var newRow = $("<tr>");
			var cols = "";
			var dataString = 'action=get-products'+'&option=12';

	   	cols += '<td><input type="text" class="form-control" rows="1" id="eRedeSocialCliente" autocomplete="off" value="' + data.rede_social +'" readonly></td>';
	    cols += '<td><input type="text" class="form-control" rows="1" id="eLoginCliente" autocomplete="off" value="' + data.login +'" readonly></td>';
	   	cols += '<td><input type="text" class="form-control" rows="1" id="eSenhaCliente" autocomplete="off" value="' + data.senha +'" readonly></td>';
	    cols += '<td>';
	    cols += '<button class="btn btn-danger" onclick="RemoverLinha(this)" type="button" style="width:100%">Remover</button>';
	    cols += '</td>';
	    cols += '</tr>';

			newRow.append(cols);
			$("#products-table").append(newRow);

			$('#eRedeSocial').val('');
			$('#eLogin').val('');
			$('#eSenha').val('');

      $('#eRedeSocial').focus();
	    return false;
	  };

    LimparCampos = function(){
      // Limpando informações principais
      $('#eClienteID').val('');
      $('#eNome').val('');
      $('#eTelefone').val('');	
      $('#eEmail').val(''); 	
      
      // Limpando redes sociais
      var cabecalho ='';
      cabecalho += 	'<tr>';
      cabecalho += 		'<th>Rede social</th>';
      cabecalho += 	  '<th>Login</th>';
      cabecalho += 	  '<th>Senha</th>';
      cabecalho += 	'</tr>';

      var Table = document.getElementById("products-table");
      Table.innerHTML = cabecalho;
    };

    gravarCliente = function (nome, telefone, email, arrItens) {
      var dataString = 'action=gravar-cliente&cliente-nome='+nome+'&cliente-telefone='+telefone+'&cliente-email='+email;
      
      $.ajax({
        url: "/model/clientesModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          if(data.search('Erro') > -1) {
            $('#resultado').html('<div class="btn btn-danger" style="margin-top: 5px;">'+data+'</div>');
          } else {

            var clienteID = data;

            // Gravando as redes sociais
            for (var i = 0; i < arrItens.length; i++) { 

              var dataStringItem = 
                'action=gravar-rede-social-cliente'
                +'&cliente-id=' + clienteID
                +'&rede-social=' + arrItens[i].redeSocial
                +'&login=' + arrItens[i].login
                +'&senha=' + arrItens[i].senha;

              $.ajax({
                url: '/model/clientesModel.php',
                type: 'POST',
                data: dataStringItem,
                success: function(data) {

                  if(data.search('Erro') > -1) {
                    $('#resultado').html('<div class="btn btn-danger" style="margin-top: 5px;">'+data+'</div>');
                  }
                }
              });
            }

            $('#eNome').val('');
            $('#eTelefone').val('');	
            $('#eEmail').val('');
          
            $('#resultado').html('<div class="btn btn-success" style="margin-top: 5px;">Cliente inserido com sucesso!</div>');
            LimparCampos();
          }
        }
      });

      $('#resultado').animate({opacity: 1}, 3000,function(){
        $('#resultado').html('');
      });
    }

    alterarCliente = function (clienteID, nome, telefone, email, arrItens) {
      var dataString = 'action=alterar-cliente&cliente-id='+clienteID+'&cliente-nome='+nome+'&cliente-telefone='+telefone+'&cliente-email='+email;
      
      $.ajax({
        url: "/model/clientesModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          if(data.search('Erro') > -1) {
            $('#resultado').html('<div class="col-md-12 btn btn-danger" style="margin-top: 5px;">'+data+'</div>');
          } else {
            
            for (var i = 0; i < arrItens.length; i++) { 

              var dataStringItem = 
                'action=gravar-rede-social-cliente'
                +'&cliente-id=' + clienteID
                +'&rede-social=' + arrItens[i].redeSocial
                +'&login=' + arrItens[i].login
                +'&senha=' + arrItens[i].senha;

              $.ajax({
                url: '/model/clientesModel.php',
                type: 'POST',
                data: dataStringItem,
                success: function(data) {

                  if(data.search('Erro') > -1) {
                    $('#resultado').html('<div class="col-md-12 btn btn-danger" style="margin-top: 5px;">'+data+'</div>');
                  }
                }
              });
            }

            $('#eNome').val('');
            $('#eTelefone').val('');  
            $('#eEmail').val('');
          
            $('#resultado').html('<div class="col-md-12 btn btn-success" style="margin-top: 5px;">Cliente alterado com sucesso!</div>');
            LimparCampos();
          }
        }
      });

      $('#resultado').animate({opacity: 1}, 1500,function(){
        $('#resultado').html('');
        $(location).attr('href', '/pages/relatorios/clientes.php');
      });
    }

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