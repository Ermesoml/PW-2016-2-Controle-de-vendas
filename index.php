<?php
  include_once('./functions/header.php');
?>

  <section class="content-header">
    <h1>
      Painel de controle<small>KikADMIN</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Painel de controle</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="fa fa-bookmark-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Acomp. pendentes</span>

            <?php
              $stmt = $pdo->prepare('SELECT count(*) as quant_acompanhamentos FROM clientes_acompanhamentos where status = "A"');
              $stmt->execute();
              
              $html = '';
              $row = $stmt->fetch(PDO::FETCH_ASSOC) 
              //$html .= '<option value="'.$row['cliente_id'].'">'.$row['cliente_id'].' - '.$row['nome'].'</option>';
            ?>

            <span class="info-box-number"><?php echo ($row['quant_acompanhamentos']);?></span>
          </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-bookmark"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Acomp. em processo</span>

            <?php
              $stmt = $pdo->prepare('SELECT count(*) as quant_acompanhamentos FROM clientes_acompanhamentos where status = "F"');
              $stmt->execute();
              
              $html = '';
              $row = $stmt->fetch(PDO::FETCH_ASSOC) 
              //$html .= '<option value="'.$row['cliente_id'].'">'.$row['cliente_id'].' - '.$row['nome'].'</option>';
            ?>

            <span class="info-box-number"><?php echo ($row['quant_acompanhamentos']);?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Acomp. mês</span>
            
            <?php
              $stmt = $pdo->prepare('select sum(preco) as total_acompanhamentos from clientes_acompanhamentos where status <> "C" and month(data_cadastro) = month(now())');
              $stmt->execute();
              
              $html = '';
              $row = $stmt->fetch(PDO::FETCH_ASSOC) 
              //$html .= '<option value="'.$row['cliente_id'].'">'.$row['cliente_id'].' - '.$row['nome'].'</option>';
            ?>

            <span class="info-box-number">R$ <?php echo ($row['total_acompanhamentos']);?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-olive"><i class="fa fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Clientes</span>

             <?php
              $stmt = $pdo->prepare('SELECT count(*) as quant_clientes FROM clientes');
              $stmt->execute();
              
              $html = '';
              $row = $stmt->fetch(PDO::FETCH_ASSOC) 
              //$html .= '<option value="'.$row['cliente_id'].'">'.$row['cliente_id'].' - '.$row['nome'].'</option>';
            ?>

            <span class="info-box-number"><?php echo ($row['quant_clientes']);?></span>
            
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Relação de vendas mensais</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong>Vendas: 1 Mai, 2016 - 06 Out, 2016</strong>
                </p>

                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" style="height: 180px;"></canvas>
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <p class="text-center">
                  <strong>Vendas completadas</strong>
                </p>

                <div class="progress-group">
                  <span class="progress-text">Vendas site</span>
                  <span class="progress-number"><b>160</b>/200</span>

                  <div class="progress sm">
                    <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Equipe vermelha</span>
                  <span class="progress-number"><b>310</b>/400</span>

                  <div class="progress sm">
                    <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Equipe verde</span>
                  <span class="progress-number"><b>480</b>/800</span>

                  <div class="progress sm">
                    <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Equipe amarela</span>
                  <span class="progress-number"><b>250</b>/500</span>

                  <div class="progress sm">
                    <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./box-body -->
          <div class="box-footer">
            <div class="row">
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                  <h5 class="description-header">$35,210.43</h5>
                  <span class="description-text">TOTAL BRUTO</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                  <h5 class="description-header">$10,390.90</h5>
                  <span class="description-text">CUSTO TOTAL</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                  <h5 class="description-header">$24,813.53</h5>
                  <span class="description-text">TOTAL_LIQUIDO</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-xs-6">
                <div class="description-block">
                  <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                  <h5 class="description-header">1200</h5>
                  <span class="description-text">VENDAS COMPLETADAS</span>
                </div>
                <!-- /.description-block -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->

      <div class="col-md-12">
        <!-- /.box -->
        <!-- Lista de acompanhamentos -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Ultimas vendas realizadas</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-50x50.gif" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">90 dias servidor - Instagram
                    <span class="label label-warning pull-right">$320</span></a>
                      <span class="product-description">
                        @perfilcliente. Tags: Vendas, Outback, Outratag
                      </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-50x50.gif" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">30 dias servidor - Instagram
                    <span class="label label-info pull-right">$150</span></a>
                      <span class="product-description">
                        @perfilcliente. Tags: Vendas, Outback, Outratag
                      </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-50x50.gif" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">30 dias servidor - Instagram <span class="label label-danger pull-right">$120</span></a>
                      <span class="product-description">
                        @perfilcliente. Tags: Vendas, Outback, Outratag
                      </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-50x50.gif" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">180 dias servidor - Instagram
                    <span class="label label-success pull-right">$400</span></a>
                      <span class="product-description">
                        @perfilcliente. Tags: Vendas, Outback, Outratag
                      </span>
                </div>
              </li>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="javascript:void(0)" class="uppercase">Relatório de Vendas\Usuário</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
    <!-- /.content -->
  
<?php
  include_once("./functions/footer.php")
?>

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/js/pages/dashboard2.js"></script>
