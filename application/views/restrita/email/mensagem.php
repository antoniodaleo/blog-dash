
<?php $this->load->view('restrita/layout/sidebar'); ?>

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('restrita/layout/navbar'); ?>
 
  <!-- Begin Page Content -->
  <div class="container-fluid">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url('restrita/email') ?>">Email</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ;?></li>
    </ol>
  </nav>

 
  <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <!-- Link para voltar menu Usuario -->
      <div class="card-header py-3">
        <a title="Voltar" href="<?php echo base_url('restrita/email'); ?>" class="btn btn-success btn-sm float-right" > <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
      </div>

      <!-- Formulario -->
      <div class="card-body">
        <p><strong><i class="fas fa-clock"></i>&nbsp;  Data de recebimento: <?php echo formata_data_banco_com_hora($email->email_data)  ?> </strong></p>
        <?php echo form_open('restrita/email/mensagem/'.$email->email_id); ?>

            <!-- Primeira Linha -->
            <div class="form-group row">
              <div class="col-md-5">
                <label>Email</label>
                <input type="text" class="form-control" disabled name="email_descricao" placeholder="Email.." value="<?php echo $email->email_descricao; ?>">
              </div>
              <div class="col-md-5">
                <label>Nome</label>
                <input type="text" class="form-control" disabled name="email_nome" placeholder="Nome ..."  value="<?php echo $email->email_nome; ?>">
              </div>
              <div class="col-md-2">
                  <label><span class="badge badge-info btn-sm"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp; Status</span></label>
                  <select id="email_status" name="email_status"  class="form-control custom-select conta_receber" onchange="escondaCamposPresenciais()">
                    <option value="0" <?php echo ($email->email_status ==0) ? 'selected': '' ?>>Pendente</option>
                    <option value="1" <?php echo ($email->email_status ==1) ? 'selected': '' ?>>Lida</option>       
                  </select>              
              </div>
            </div>
             <!-- Segunda Linha -->
            <div class="form-group row">
              <div class="col-md-12">
                <label>Mensagem</label>

                <textarea class="form-control" disabled><?php echo $email->email_mensagem ?></textarea>
              </div>
            </div>

            <a href="javascript(void)" data-toggle="modal" data-target="#email-<?php echo $email->email_id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-envelope" aria-hidden="true"></i> Excluir</a>

            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
          <?php echo form_close(); ?>


            <!-- Qui mi apparirá la finestra per cancellare l usuario -->
            <div class="modal fade" id="email-<?php echo $email->email_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url('restrita/email/del/'.$email->email_id) ?>">Sim</a>
                  </div>
                </div>
              </div>
            </div>



        <input type="hidden" class="form-control" name="service_id" placeholder="" value="<?php echo $email->email_id; ?>">

      </div>
      
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->