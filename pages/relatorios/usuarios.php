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
        <li class="active">Usuários</li>
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
                <table id="tbUsuarios" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Usuário</th>
                      <th>Nome</th>
                      <th>Telefone</th>
                      <th>Email</th>
                      <th>Cargo</th>
                      <th>Tipo</th>
                      <th>Banido</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $stmt = $pdo->prepare('SELECT * FROM usuarios');
                      //$stmt->bindParam(':cliente_id', $UserID);
                      $stmt->execute();
                      
                      $html = '';

                      if($stmt->rowCount() > 0) {
                        foreach($stmt->fetchAll() as $row) {


                          if ($row['banido'] == 'S')
                            $banido = '<label class="text-danger">Sim</label>';  
                          else
                            $banido = '<label class="text-primary">Não</label>';  

                          if ($row['tipo'] == 'V')
                            $tipo = '<label class="text-warning">Vendedor</label>';  
                          else if ($row['tipo'] == 'A')
                            $tipo = '<label class="text-success">Administrador</label>';
                          else if ($row['tipo'] == 'S')
                            $tipo = '<label class="text-primary">Supervisor</label>';

                          $html .= '<tr>';
                          $html .= '<td class="col-md-1" align="right">'.$row['usuario_id'].'</td>';
                          $html .= '<td><a href="../cadastros/usuarios.php?usuario-id='.$row['usuario_id'].'">'.$row['nome'].'</td>';
                          $html .= '<td>'.$row['telefone'].'</td>';
                          $html .= '<td>'.$row['email'].'</td>';
                          $html .= '<td>'.$row['cargo'].'</td>';
                          $html .= '<td>'.$tipo.'</td>';
                          $html .= '<td>'.$banido.'</td>';
                          
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
    $("#tbUsuarios").DataTable();
});

/*$(document).ready(function(){
    alert('ok');
});*/
</script>