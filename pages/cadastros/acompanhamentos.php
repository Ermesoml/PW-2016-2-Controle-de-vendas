<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/header.php");
?>

  <section class="content-header">
    <h1>
      Cadastro de acompanhamentos <small>KikADMIN</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=<?php $_SERVER['DOCUMENT_ROOT'] ?>"/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Cadastro de acompanhamentos</li>
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
              <div class="col-md-1">
                <label for="eAcompanhamentoID">Código</label>
                <input type="text" class="form-control" id="eAcompanhamentoID" readonly>
              </div>

              <div class="col-md-5">
                <label for="lbCliente">Cliente</label>
                

                <select class="form-control" name="eCliente" id="eCliente" onchange="setRedesSociais(this.value, 0)">
                  <option selected="true" value="void" style="display:none;">Cliente do acompanhamento</option>
                  <?php
                    $stmt = $pdo->prepare('SELECT cliente_id, nome FROM clientes');
                    $stmt->execute();
                    
                    $html = '';
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $html .= '<option value="'.$row['cliente_id'].'">'.$row['cliente_id'].' - '.$row['nome'].'</option>';
                    }
                    echo $html;
                  ?>
                </select>
              </div>

              <div class="col-md-2">
                <label for="eTelefone">Telefone</label>
                <input type="text" class="form-control" id="eTelefone" readonly>
              </div>

              <div class="col-md-2">
                <label for="eRedeSocial">Rede social</label>
                <select class="form-control" name="order-service" id="eRedeSocial" onchange="setRedeSocialLogin(this.value)">
                  <option selected="true" value="void" style="display:none;">Rede social</option>
                </select>
              </div>

              <div class="col-md-2">
                <label for="eLogin">Login</label>
                <input type="text" class="form-control" id="eLogin" readonly>
              </div>
              
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label for="eDescricao">Descrição</label>
                <input type="text" class="form-control" id="eDescricao" placeholder="Descrição do que será feito">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6">
                <label for="eResponsavel">Responsável</label>
                <input type="text" class="form-control" id="eResponsavel" placeholder="Responsável">
              </div>
              <div class="col-md-3">
                <label for="ePreco">Preço</label>
                <input type="number" class="form-control" id="ePreco" placeholder="0,00">
              </div>
              <div class="col-md-3">
                <label for="eComissao">Comissão</label>
                <input type="number" class="form-control" id="eComissao" placeholder="0,00">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-3">
                <label for="eQtdSegInicial">Qtd seg. inicial</label>
                <input type="number" class="form-control" id="eQtdSegInicial" placeholder="0">
              </div>
              <div class="col-md-3">
                <label id="lbQtdSegAtual" for="eQtdSegAtual">Qtd seg. atual</label>
                <input type="number" class="form-control" id="eQtdSegAtual" placeholder="0">
              </div>

              <div class="col-md-3">
                <label id="lbStatus" for="eStatus">Status</label>
                <select class="form-control" id="eStatus">
                  <option value="A" selected="true">Aberto</option>
                  <option value="F">Fazendo</option>
                  <option value="B">Baixado</option>
                  <option value="C">Cancelado</option>
                </select>
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
            <h3 class="box-title">Estatísticas</h3>
            
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">
            <div class="form-group">
              <div class="col-md-2">
                <label for="ePercComissao">% de comissão</label>
                <input type="text" class="form-control" id="ePercComissao" readonly>
              </div>
              <div class="col-md-2">
                <label for="ePercLucro">% de lucro</label>
                <input type="text" class="form-control" id="ePercLucro" readonly>
              </div>
              <div class="col-md-2">
                <label for="eTotalLucro">Total de lucro</label>
                <input type="text" class="form-control" id="eTotalLucro" readonly>
              </div>
              <div class="col-md-3">
                <label for="ePercGanho">% de ganho (seguidores)</label>
                <input type="text" class="form-control" id="ePercGanho" readonly>
              </div>
              <div class="col-md-3">
                <label for="eQuantGanho">Quant. de ganho (seguidores)</label>
                <input type="text" class="form-control" id="eQuantGanho" readonly>
              </div>
            </div>
          </div>
        <div>
      </div>
    </div>

    <div class="form-group" align="right">
      <label class="col-lg-1"></label>
        <button type="button" class="btn btn-success" id="btGravarAcompanhamento" width="100%">Gravar</button>
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

    if (findGetParameter('acompanhamento-id') > 0){

      var dataString = 'action=get-acompanhamento&acompanhamento-id='+findGetParameter('acompanhamento-id');

      $.ajax({
        url: "/model/acompanhamentosModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          if(data) {
            var str_json = JSON.parse(data);
            var percComissao = 0;
            var percLucro = 0;
            var percGanho = 0;
            var quantGanho = 0;
            var totalLucro = 0.00;

            document.getElementById("eCliente").disabled = true;
            document.getElementById("eRedeSocial").disabled = true;
            document.getElementById("eQtdSegInicial").disabled = true;

            $('#eAcompanhamentoID').val(str_json[0].acompanhamento_id);
            $('#eCliente').val(str_json[0].cliente_id);
            setRedesSociais(str_json[0].cliente_id, str_json[0].cliente_rede_social_id);
            $('#eTelefone').val(str_json[0].telefone);
            $('#eLogin').val(str_json[0].login);
            $('#eResponsavel').val(str_json[0].representante);
            $('#ePreco').val(str_json[0].preco);
            $('#eComissao').val(str_json[0].comissao);
            $('#eDescricao').val(str_json[0].descricao);
            $('#eStatus').val(str_json[0].status);
            $('#eQtdSegInicial').val(str_json[0].qtd_seg_inicial);
            $('#eQtdSegAtual').val(str_json[0].qtd_seg_atual);

            percComissao = Number(str_json[0].preco) / Number(str_json[0].comissao);
            percLucro = (Number(str_json[0].preco) - Number(str_json[0].comissao)) / Number(str_json[0].preco) * 100;
            totalLucro = Number(str_json[0].preco) - Number(str_json[0].comissao);
            
            percGanho = (Number(str_json[0].qtd_seg_atual)  * 100) / Number(str_json[0].qtd_seg_inicial) - 100; 
            quantGanho = Number(str_json[0].qtd_seg_atual) - Number(str_json[0].qtd_seg_inicial); 

            $('#ePercComissao').val(percComissao);
            $('#ePercLucro').val(percLucro);
            $('#eTotalLucro').val(totalLucro);
            $('#ePercGanho').val(percGanho);
            $('#eQuantGanho').val(quantGanho);


          } else {
            $('#resultado').html('<div class="btn btn-danger" style="margin-top: 5px;">Algo não está certo, tente novamente!</div>');
            LimparCampos();
          }
        }
      });s
    }
    else {
      document.getElementById("eStatus").style.display = "none";
      document.getElementById("lbStatus").style.display = "none";

      document.getElementById("eQtdSegAtual").style.display = "none";
      document.getElementById("lbQtdSegAtual").style.display = "none";
    }

    $('#resultado').animate({opacity: 1}, 3000,function(){
      $('#resultado').html('');
    });

  });
  // Final do escopo - carregamento da página

  $('#btGravarAcompanhamento').click('input', function() {
    
    var acompanhamento = {};   
    acompanhamento.acompanhamentoID = $('#eAcompanhamentoID').val();  
    acompanhamento.clienteID = $('#eCliente').val();
    acompanhamento.redeSocialID = $('#eRedeSocial').val();
    acompanhamento.telefone = $('#eTelefone').val();
    acompanhamento.descricao = $('#eDescricao').val();
    acompanhamento.responsavel = $('#eResponsavel').val();
    acompanhamento.comissao = $('#eComissao').val();
    acompanhamento.preco = $('#ePreco').val();
    acompanhamento.status = $('#eStatus').val();
    acompanhamento.qtdSegInicial = $('#eQtdSegInicial').val();
    acompanhamento.qtdSegAtual = $('#eQtdSegAtual').val();
    

    if ((acompanhamento.clienteID == null) || (acompanhamento.clienteID == 'void')){
      alert('É necessário informar o cliente!');
      $('#eCliente').focus();
      Exit;	
    }

    if ((acompanhamento.redeSocialID == null) || (acompanhamento.redeSocialID == 'void')){
      alert('É necessário informar a rede social!');
      $('#eRedeSocial').focus();
      Exit; 
    }

    if (acompanhamento.descricao == ''){
      alert('É necessário informar a descrição!');
      $('#eDescricao').focus();
      Exit;	
    }

    if (acompanhamento.responsavel == ''){
      alert('É necessário informar o responsável!');
      $('#eResponsavel').focus();
      Exit;	
    }

    if (acompanhamento.preco == ''){
      alert('É necessário informar o preço!');
      $('#ePreco').focus();
      Exit; 
    }

    if (acompanhamento.comissao == ''){
      alert('É necessário informar a comissão!');
      $('#eComissao').focus();
      Exit;	
    }

    if (acompanhamento.qtdSegInicial == ''){
      alert('É necessário informar a quantidade de seguidores inicial!');
      $('#eComissao').focus();
      Exit; 
    }

    if ($('#eAcompanhamentoID').val() == ''){
      gravarAcompanhamento(
        acompanhamento.clienteID,
        acompanhamento.redeSocialID,
        acompanhamento.descricao,
        acompanhamento.responsavel,
        Number(acompanhamento.preco),
        Number(acompanhamento.comissao),
        Number(acompanhamento.qtdSegInicial)
      );
    } else {
      alterarAcompanhamento(
        acompanhamento.acompanhamentoID,
        acompanhamento.descricao,
        acompanhamento.responsavel,
        Number(acompanhamento.preco),
        Number(acompanhamento.comissao),
        acompanhamento.status,
        Number(acompanhamento.qtdSegAtual)
      );
    }

  });

  (function($) {

    setRedesSociais = function (clienteID, redeSocialSetada) {
      var dataString = 'action=get-redes-sociais'+'&cliente-id='+clienteID;

      $('#eRedeSocial').html('');
      $('#eLogin').val('');
      $.ajax({
        url: "/model/clientesModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          $('#eRedeSocial').append(' <option selected="true" value="void" style="display:none;">Rede social</option>');
          $('#eRedeSocial').append(data);

          if (redeSocialSetada > 0){
            $('#eRedeSocial').val(redeSocialSetada);
          }
        }
      });

      setClienteTelefone(clienteID);
    }

    setClienteTelefone = function (clienteID) {
      var dataString = 'action=get-cliente-telefone'+'&cliente-id='+clienteID;

      $('#eTelefone').val('');
      $.ajax({
        url: "/model/clientesModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          $('#eTelefone').val(data);
        }
      });
    }

    setRedeSocialLogin = function (redeSocialID) {
      var dataString = 'action=get-rede-social-login'+'&rede-social-id='+redeSocialID;

      $('#eLogin').val('');
      $.ajax({
        url: "/model/clientesModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          $('#eLogin').val(data);
        }
      });
    }

    LimparCampos = function(){
      // Limpando informações da tela
      $('#eAcompanhamentoID').val('');
      $('#eCliente').val('');
      $('#eRedeSocial').val('');
      $('#eDescricao').val('');
      $('#eResponsavel').val('');
      $('#ePreco').val('');
      $('#eComissao').val('');
      $('#eLogin').val('');
      $('#eQtdSegAtual').val('');
      $('#eQtdSegInicial  ').val('');	 	
    };

    gravarAcompanhamento = function (clienteID, redeSocialID, descricao, responsavel, preco, comissao, qtdSegInicial) {

      var dataString = 
        'action=gravar-acompanhamento&cliente-id='+clienteID+
        '&rede-social-id='+redeSocialID+
        '&descricao='+descricao+
        '&responsavel='+responsavel+
        '&preco='+preco+
        '&comissao='+comissao+
        '&qtd-seg-inicial='+qtdSegInicial;
      
      $.ajax({
        url: "/model/acompanhamentosModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          if(data) {
            $('#resultado').html('<div class="btn btn-danger" style="margin-top: 5px;">'+data+'</div>');
          } else {
            $('#resultado').html('<div class="btn btn-success" style="margin-top: 5px;">Acompanhamento inserido com sucesso!</div>');
            LimparCampos();
          }
        }
      });

      $('#resultado').animate({opacity: 1}, 3000,function(){
        $('#resultado').html('');
      });
    }

    alterarAcompanhamento = function (acompanhamentoID, descricao, responsavel, preco, comissao, status, qtdSegAtual) {

      var dataString = 
        'action=alterar-acompanhamento&acompanhamento-id='+acompanhamentoID+
        '&descricao='+descricao+
        '&responsavel='+responsavel+
        '&preco='+preco+
        '&comissao='+comissao+
        '&status='+status+
        '&qtd-seg-atual='+qtdSegAtual;
      
      $.ajax({
        url: "/model/acompanhamentosModel.php",
        type: 'POST',
        data: dataString,
        success: function(data) {
          if(data) {
            $('#resultado').html('<div class="btn btn-danger" style="margin-top: 5px;">'+data+'</div>');
          } else {
            $('#resultado').html('<div class="btn btn-success" style="margin-top: 5px;">Acompanhamento alterado com sucesso!</div>');
            LimparCampos();
          }
        }
      });

      $('#resultado').animate({opacity: 1}, 1500,function(){
        $('#resultado').html('');
        $(location).attr('href', '/pages/relatorios/acompanhamentos.php');
      });
    }

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