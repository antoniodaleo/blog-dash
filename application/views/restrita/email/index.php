
<?php $this->load->view('restrita/layout/sidebar'); ?>

    
<!-- Main Content -->
<div id="content">

  <?php $this->load->view('restrita/layout/navbar'); ?>
 
  <!-- Begin Page Content -->
  <div class="container-fluid">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
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
    
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>id</th>
                <th>Email</th>
                <th>Mensagem</th>
                <th>Status</th>
                <th class="text-right no-sort">Ações</th>
                
              </tr>
            </thead>
            <tbody>
                <?php foreach($email as $e): ?>
                  <tr>
                      <td><?php echo $e->email_id ?></td>
                      <td><?php echo $e->email_descricao ?></td>
                      <td><?php echo $e->email_mensagem ?></td>
                      
                      <td>
                        <?php if($e->email_status == 0): ?>
                          <?php echo '<span class="badge badge-warning btn-sm">Nova mensagem</span>'; ?>
                        <?php else:  ?>
                          <?php echo '<span class="badge badge-info btn-sm">Mensagem já lida</span>'; ?>
                        <?php endif;  ?>
                      </td>
                      <td class="text-right">
                        <a href="<?php echo base_url('restrita/email/mensagem/'.$e->email_id)?>" class="btn btn-sm btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Ler msg</a>
                        <a href="javascript(void)" data-toggle="modal" data-target="#email-<?php echo $e->email_id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-user-times" aria-hidden="true"></i> Excluir</a>
                      </td>
                  </tr>


                  <!-- Qui mi apparirá la finestra per cancellare l usuario -->
                  <div class="modal fade" id="email-<?php echo $e->email_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tem certeza da deleção?</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Se você deseja realmente deletar o usuario clique em <strong>Sim</strong> </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Não</button>
                          <a class="btn btn-danger btn-sm" href="<?php echo base_url('restrita/email/del/'.$e->email_id) ?>">Sim</a>
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

