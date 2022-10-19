
<?php $this->load->view('restrita/layout/sidebar'); ?>

    

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('restrita/layout/navbar'); ?>
 
  <!-- Begin Page Content -->
  <div class="container-fluid">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url('restrita/home') ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ;?></li>
    </ol>
  </nav>

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

  <!-- Mensagem de erro -->
  <?php if($message = $this->session->flashdata('error')): ?>

    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;<?php echo $message ?></strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      </div>
    </div>    
    
  <?php endif; ?>
 
  <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <a title="Cadastrar nova categoria" href="<?php echo base_url('restrita/categoria/core'); ?>" class="btn btn-success btn-sm float-right" > <i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>id</th>
                <th>Nome categoria</th>
                <th>Meta link da categoria</th>
                <th>Data de criação</th>
                <th>Ativa</th>  
                <th class="text-right no-sort">Ações</th>
                
              </tr>
            </thead>
            <tbody>
                <?php foreach($categorias as $categoria): ?>
                  <tr>
                    <td><?php echo $categoria->categoria_id; ?></td>
                    <td><?php echo $categoria->categoria_nome; ?></td>
                    <td><i data-feather="link-2" class="text-info"></i> <?php echo $categoria->categoria_meta_link; ?></td>
                    <td><?php echo formata_data_banco_com_hora($categoria->categoria_data_criacao); ?></td>
                    <td><?php echo ($categoria->categoria_ativa == 1 ? '<span class="badge badge-success"> Sim </span>' : '<span class="badge badge-danger">Não </span>' )  ?></td>

                    <td class="text-right">
                        <a href="<?php echo base_url('restrita/categoria/core/'.$categoria->categoria_id); ?>" class="btn btn-primary btn-icon"><i class="far fa-edit"></i></a>
                        <a href="javascript(void)" data-toggle="modal" data-target="#categoria-<?php echo $categoria->categoria_id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-user-times" aria-hidden="true"></i> </a>
                    </td>
                  </tr>


                  <!-- Qui mi apparirá la finestra per cancellare l usuario -->
                  <div class="modal fade" id="categoria-<?php echo $categoria->categoria_id ; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tem certeza da deleção?</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Se você deseja realmente deletar a Categoria clique em <strong>Sim</strong> </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Não</button>
                          <a class="btn btn-danger btn-sm" href="<?php echo base_url('restrita/categoria/delete/'. $categoria->categoria_id ) ?>">Sim</a>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->