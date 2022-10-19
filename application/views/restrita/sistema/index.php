

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
           
            <!-- Formulario -->
            <div class="card-body">
              <form method="post" name="form_edit" class="user">
                  
                  <!-- Primeira Linha -->
                  <div class="form-group row">
                      <div class="col-md-3">
                          <label>Razão Social</label>
                          <input type="text" class="form-control form-control-user" name="sistema_razao_social" placeholder="Razão Social" value="<?php echo (isset($sistema)? $sistema->sistema_razao_social : 'ID');  ?>">
                          <?php echo form_error('sistema_razao_social','<small class="form-text text-danger">','</small>',''); ?>  
                      </div>
                      <div class="col-md-3">
                          <label>Nome Fantasia</label>
                          <input type="text" class="form-control form-control-user" name="sistema_nome_fantasia" placeholder="Nome Fantasia" value="<?php echo  $sistema->sistema_nome_fantasia; ?>">
                          <?php echo form_error('sistema_nome_fantasia','<small class="form-text text-danger">','</small>',''); ?>  
                      </div>
                      <div class="col-md-3">
                          <label>Cnpj</label>
                          <input type="text" class="form-control form-control-user cnpj" name="sistema_cnpj" placeholder="CNPJ" value="<?php echo $sistema->sistema_cnpj; ?>">
                          <?php echo form_error('sistema_cnpj','<small class="form-text text-danger">','</small>',''); ?>  
                      </div>
                      <div class="col-md-3">
                          <label>Sistema IE</label>
                          <input type="text" class="form-control form-control-user" name="sistema_ie" placeholder="sistema_ie" value="<?php echo $sistema->sistema_ie; ?>">
                          <?php echo form_error('sistema_ie','<small class="form-text text-danger">','</small>',''); ?>  
                      </div>

                  </div>
                  
                  <!-- Segunda Linha -->
                  <div class="form-group mb-3 row">
                    <div class="col-md-3">
                          <label>Telefone Fixo</label>
                          <input type="text" class="form-control form-control-user phone_with_ddd" name="sistema_telefone_fixo" placeholder="Telefone Fixo" value="<?php echo $sistema->sistema_telefone_fixo; ?>">
                          <?php echo form_error('sistema_telefone_fixo','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
                    <div class="col-md-3">
                          <label>Telefone movel</label>
                          <input type="sistema_telefone_movel" class="form-control form-control-user sp_celphones" name="sistema_telefone_movel" placeholder="Sua email" value="<?php echo $sistema->sistema_telefone_movel; ?>">
                          <?php echo form_error('sistema_telefone_movel','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
                    <div class="col-md-3">
                          <label>Email</label>
                          <input type="email" class="form-control form-control-user" name="sistema_email" placeholder="Sua email" value="<?php echo $sistema->sistema_email; ?>">
                          <?php echo form_error('username','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
                    <div class="col-md-3">
                          <label>Site Url</label>
                          <input type="text" class="form-control form-control-user" name="sistema_site_url" placeholder="Site url" value="<?php echo $sistema->sistema_site_url; ?>">
                          <?php echo form_error('username','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
              
                  </div>

                  <!-- Terceira Linha -->
                  <div class="form-group mb-3  row">
                    <div class="col-md-3">
                        <label>Endereço</label>
                        <input type="text" class="form-control form-control-user" name="sistema_endereco" placeholder="Endereço" value="<?php echo $sistema->sistema_endereco; ?>">
                        <?php echo form_error('sistema_endereco','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
                    <div class="col-md-3">
                        <label>Numero</label>
                        <input type="text" class="form-control form-control-user " name="sistema_numero" placeholder="sistema_numero" value="<?php echo $sistema->sistema_numero; ?>">
                        <?php echo form_error('sistema_numero','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
                    <div class="col-md-3">
                        <label>CEP</label>
                        <input type="text" class="form-control form-control-user cep" name="sistema_cep" placeholder="sistema_cep" value="<?php echo $sistema->sistema_cep; ?>">
                        <?php echo form_error('sistema_cep','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
                    <div class="col-md-3">
                        <label>Cidade</label>
                        <input type="text" class="form-control form-control-user" name="sistema_cidade" placeholder="sistema_cidade" value="<?php echo $sistema->sistema_cidade; ?>">
                        <?php echo form_error('sistema_cidade','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
                    <div class="col-md-3">
                        <label>Estado</label>
                        <input type="text" class="form-control form-control-user uf" name="sistema_estado" placeholder="sistema_estado" value="<?php echo $sistema->sistema_estado; ?>">
                        <?php echo form_error('sistema_estado','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
                   
                    <input type="hidden" name="usuario_id" value="">
                  </div>
                  
                  <!-- Quarta Linha(Text Area) -->
                  <div class="form-group mb-3  row">
                    <div class="col-md-12">
                        <label>Sistema de ordem de serviço</label>
                        <textarea class="form-control form-control-user" name="sistema_txt_ordem_servico" placeholder="sistema_txt_ordem_servico"><?php echo $sistema->sistema_txt_ordem_servico; ?></textarea>
                        <?php echo form_error('sistema_txt_ordem_servico','<small class="form-text text-danger">','</small>',''); ?>
                    </div>
                  </div>


                  <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
              </form>
            </div>
            
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     