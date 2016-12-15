<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/header.php");
?>

    <section class="content-header">
      <h1>
        Acompanhamentos
        <small>Acompanhamentos cadastrados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href=<?php $_SERVER['DOCUMENT_ROOT'] ?>"/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Relatórios</li>
        <li class="active">Acompanhamentos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Acompanhamentos <small>em aberto</small></h3>
            </div>  
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group table-responsive">
                <table id="tbAcompanhamentosAbertos" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Acompanhamento</th>
                      <th>Cliente</th>  
                      <th>Responsável</th>
                      <th>Preço</th>
                      <th>Comissão</th>
                      <th>Qtd. seg. inicial</th>
                      <th>Qtd. seg. atual</th>
                      <th>Ganho atual</th>
                      <th>Data de cadastro</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $tipoUsuario = $user->GetData('tipo');
                      $usuarioID = $user->GetData('usuario_id');

                      if ($tipoUsuario == 'V'){
                        $stmt = $pdo->prepare('SELECT * FROM vw_acompanhamentos WHERE status in ("A", "F") and usuario_id = :usuario_id');
                        $stmt->bindParam(':usuario_id', $usuarioID);
                      }
                      else{
                        $stmt = $pdo->prepare('SELECT * FROM vw_acompanhamentos WHERE status in ("A", "F")');  
                      }

                      $stmt->execute();
                      
                      $html = '';
                      $totalAberto = 0.00;
                      $totalFazendo = 0.00;
                      $totalMesCorrente = 0.00;

                      if($stmt->rowCount() > 0) {
                        foreach($stmt->fetchAll() as $row) {

                          $status = '';

                          if ($row['status'] == 'A') {
                            $status = '<button type="button" class="btn-xs btn-block btn-primary">Aberto</button>';
                            $totalAberto += $row['preco'];

                            if (date('m', strtotime(str_replace('-','/', $row['data_cadastro']))) == date('m'))
                              $totalMesCorrente += $row['preco'];

                          }
                          else if ($row['status'] == 'B')
                            $status = '<button type="button" class="btn-xs btn-block btn-success">Baixado</button>';
                          else if ($row['status'] == 'F'){
                            $status = '<button type="button" class="btn-xs btn-block btn-warning">Fazendo</button>';
                            $totalFazendo += $row['preco'];
                          }
                          else if ($row['status'] == 'C')
                            $status = '<button type="button" class="btn-xs btn-block btn-danger">Cancelado</button>';

                          $qtdGanho = $row['qtd_seg_atual'] - $row['qtd_seg_inicial'];

                          $html .= '<tr>';
                          $html .= '<td class="col-md-1" align="right">'.$row['acompanhamento_id'].'</td>';
                          $html .= '<td><a href="../cadastros/acompanhamentos.php?acompanhamento-id='.$row['acompanhamento_id'].'">'.$row['nome'].'</a></td>';
                          $html .= '<td>'.$row['representante'].'</td>';
                          $html .= '<td>R$ '.$row['preco'].'</td>';
                          $html .= '<td>R$  '.$row['comissao'].'</td>';
                          $html .= '<td>'.$row['qtd_seg_inicial'].'</td>';
                          $html .= '<td>'.$row['qtd_seg_atual'].'</td>';
                          $html .= '<td>'.$qtdGanho.'</td>';
                          $html .= '<td>'.date('d/m/Y', strtotime(str_replace('-','/', $row['data_cadastro']))).'</td>';
                          $html .= '<td>'.$status.'</td>';
                          
                          $html .= '</tr>';
                        }
                        echo $html;
                      }
                    ?>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Totalizadores</h3><small> em aberto</small>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <div class="form-group">
                <div class="col-md-4">
                  <label class="text-primary" for="eTotalMes" >Total do mês de <?php echo strftime(' %B de %Y', strtotime('today')); ?></label>
                  <input type="text" class="form-control" id="eTotalMes" placeholder="0.00" value="<?php printf ("%10.2f", $totalMesCorrente); ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label class="text-primary" for="eTotalAberto" >Total geral aberto</label>
                  <input type="text" class="form-control" id="eTotalAberto" placeholder="0.00" value="<?php printf ("%10.2f", $totalAberto); ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label class="text-warning" for="eTotalFazendo">Total geral fazendo</label>
                  <input type="text" class="form-control" id="eTotalFazendo" placeholder="0.00" value="<?php printf ("%10.2f", $totalFazendo); ?>" readonly>
                </div>
              </div>
            </div>
          <div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Acompanhamentos <small>finalizados</small></h3>
            </div>  
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group table-responsive">
                <table id="tbAcompanhamentosFinalizados" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Acompanhamento</th>
                      <th>Cliente</th>  
                      <th>Responsável</th>
                      <th>Preço</th>
                      <th>Comissão</th>
                       <th>Qtd. seg. inicial</th>
                      <th>Qtd. seg. final</th>
                      <th>Ganho</th>
                      <th>Data de cadastro</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $tipoUsuario = $user->GetData('tipo');
                      $usuarioID = $user->GetData('usuario_id');

                      if ($tipoUsuario == 'V'){
                        $stmt = $pdo->prepare('SELECT * FROM vw_acompanhamentos WHERE status in ("B", "C") and usuario_id = :usuario_id');
                        $stmt->bindParam(':usuario_id', $usuarioID);
                      }
                      else{
                        $stmt = $pdo->prepare('SELECT * FROM vw_acompanhamentos WHERE status in ("B", "C")');  
                      }

                      $stmt->execute();
                      
                      $html = '';
                      $totalBaixado = 0.00;
                      $totalComissao = 0.00;

                      if($stmt->rowCount() > 0) {
                        foreach($stmt->fetchAll() as $row) {

                          $status = '';

                          if ($row['status'] == 'A') 
                            $status = '<button type="button" class="btn-xs btn-block btn-primary">Aberto</button>';
                          else if ($row['status'] == 'B'){
                            $status = '<button type="button" class="btn-xs btn-block btn-success">Baixado</button>';
                            $totalBaixado += $row['preco'];

                            if (date('m', strtotime(str_replace('-','/', $row['data_cadastro']))) == date('m')){
                              $totalComissao += $row['comissao'];
                            }
                          }
                          else if ($row['status'] == 'F')
                            $status = '<button type="button" class="btn-xs btn-block btn-warning">Fazendo</button>';
                          else if ($row['status'] == 'C')
                            $status = '<button type="button" class="btn-xs btn-block btn-danger">Cancelado</button>'; 

                          $qtdGanho = $row['qtd_seg_atual'] - $row['qtd_seg_inicial'];

                          $html .= '<tr>';
                          $html .= '<td class="col-md-1" align="right">'.$row['acompanhamento_id'].'</td>';
                          $html .= '<td><a href="../cadastros/acompanhamentos.php?acompanhamento-id='.$row['acompanhamento_id'].'">'.$row['nome'].'</a></td>';
                          $html .= '<td>'.$row['representante'].'</td>';
                          $html .= '<td>R$ '.$row['preco'].'</td>';
                          $html .= '<td>R$  '.$row['comissao'].'</td>';
                          $html .= '<td>'.$row['qtd_seg_inicial'].'</td>';
                          $html .= '<td>'.$row['qtd_seg_atual'].'</td>';
                          $html .= '<td>'.$qtdGanho.'</td>';
                          $html .= '<td>'.date('d/m/Y', strtotime(str_replace('-','/', $row['data_cadastro']))).'</td>';
                          $html .= '<td>'.$status.'</td>';
                          
                          $html .= '</tr>';
                        }
                        echo $html;
                      }
                    ?>
                  </tfoot>
                </table>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Totalizadores</h3><small> finalizados</small>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <div class="form-group">
                <div class="col-md-6">
                  <label class="text-success" for="eTotalComissao" >Total de comissão de <?php echo strftime(' %B de %Y', strtotime('today')); ?> (baixado)</label>
                  <input type="text" class="form-control" id="eTotalComissao" placeholder="0.00" value="<?php printf ("%10.2f", $totalComissao); ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label class="text-success" for="eTotalBaixado" >Total baixado</label>
                  <input type="text" class="form-control" id="eTotalBaixado" placeholder="0.00" value="<?php printf ("%10.2f", $totalBaixado); ?>" readonly>
                </div>
              </div>
            </div>
          <div>
        </div>
      </div>
    </section>
    
  </div>

    
<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/footer.php");
?>

<!-- DataTables -->
<script src=<?php $_SERVER['DOCUMENT_ROOT']?>"/plugins/datatables/jquery.dataTables.js"></script>
<script src=<?php $_SERVER['DOCUMENT_ROOT']?>"/plugins/datatables/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href=<?php $_SERVER['DOCUMENT_ROOT']?>"/plugins/datatables/dataTables.bootstrap.css">

<script>
$(function () {
    $("#tbAcompanhamentosAbertos").DataTable();
    $("#tbAcompanhamentosFinalizados").DataTable();
    $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false
    });
});

/*$(document).ready(function(){
    alert('ok');
});*/
</script>