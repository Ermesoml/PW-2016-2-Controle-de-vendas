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
                <label for="exampleInputEmail1">Código</label>
                <input type="email" class="form-control" id="exampleInputEmail1" readonly>
              </div>
              <div class="col-md-10">
                <label for="exampleInputEmail1">Nome</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2">
                <label for="exampleInputEmail1">Telefone</label>
                <input type="email" class="form-control" id="exampleInputEmail1">
              </div>
              <div class="col-md-10">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
              </div>
            </div>
          </div>
        <div>
      </div>
    </div>
  </section>
    <!-- /.content -->
<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/footer.php");
?>