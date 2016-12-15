<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/header.php");
?>

    <section class="content-header">
      <h1>
        Clientes
        <small>Relação de clientes cadastrados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href=<?php $_SERVER['DOCUMENT_ROOT'] ?>"/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Relatórios</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Clientes</h3>
            </div>  
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group table-responsive">
                <table id="tbClientes" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Nome</th>
                      <th>Telefone</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $stmt = $pdo->prepare('SELECT * FROM clientes');
                      //$stmt->bindParam(':cliente_id', $UserID);
                      $stmt->execute();
                      
                      $html = '';

                      if($stmt->rowCount() > 0) {
                        foreach($stmt->fetchAll() as $row) {

                          $html .= '<tr>';
                          $html .= '<td class="col-md-1" align="right">'.$row['cliente_id'].'</td>';
                          $html .= '<td><a href="../cadastros/clientes.php?cliente-id='.$row['cliente_id'].'">'.$row['nome'].'</td>';
                          $html .= '<td>'.$row['telefone'].'</td>';
                          $html .= '<td>'.$row['email'].'</td>';
                          
                          $html .= '</tr>';
                        }
                        echo $html;
                      }
                    ?>
                  </tfoot>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
    $("#tbClientes").DataTable();
});

/*$(document).ready(function(){
    alert('ok');
});*/
</script>
