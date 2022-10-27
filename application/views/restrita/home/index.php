

<?php $this->load->view('restrita/layout/sidebar'); ?>

    

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('restrita/layout/navbar'); ?>
 
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Home</h1>

    <!-- Mensagem de sucesso -->
    <?php if($message = $this->session->flashdata('sucesso')): ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong><i class="fas fa-check-circle"></i></i>&nbsp;<?php echo $message ?></strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        </div>
      </div>    
    <?php endif; ?>

    <!-- Mensagem de info -->
    <?php if($message = $this->session->flashdata('info')): ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-info alert-dismissible fade show" role="alert">
              <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;<?php echo $message ?></strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        </div>
      </div>    
    <?php endif; ?>

    <?php /* 
    <!-- 1º  Content -->
      <div class="row">
        <!-- Total de vendas -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">TITULO</div>
                  <div class="h5 mb-0 font-weight-bold text-success"></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-shopping-cart text-success"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Total de servicos -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TITULO</div>
                  <div class="h5 mb-0 font-weight-bold text-primary"><?php //8echo 'R$&nbsp;'. $soma_ordem_servicos->ordem_servico_valor_total ?>  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-shopping-basket fa-2x text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Contas a pagar -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">TITULO</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-danger"><?php //echo 'R$&nbsp;'.$total_pagar->conta_pagar_valor; ?></div>
                    </div>
            
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-money-bill-alt fa-3x text-danger"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Contas a receber -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">TITULO</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-warning"><?php //echo 'R$&nbsp;'.($total_receber->conta_receber_valor == null ? '0,00' : $total_receber->conta_receber_valor) ; ?></div>
                    </div>
            
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-hand-holding-usd fa-3x text-warning"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    */ ?>
    <!-- 2º Content -->
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <h5 class="card-header">Bem vindo no Blog Easy</h5>
          <div class="card-body">
            <a href="<?php echo base_url('restrita/blog/core') ?>" > <i class="fa fa-edit"></i> </a> Escreva um post
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <h5 class="card-header">Conteudo</h5>
          <div class="card-body">
          
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <i class="fas fa-folder-open" aria-hidden="true"></i> <a href="<?php echo base_url('restrita/categoria') ?>">Categorias</a> 
              <span class="badge badge-primary badge-pill"><?php echo $categorias_tot;  ?></span>
            </li>
          
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <i class="fas fa-edit" aria-hidden="true"></i> Post
              <span class="badge badge-primary badge-pill"><?php echo $post_tot;  ?></span>
            </li>
           
          </ul>
        
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

