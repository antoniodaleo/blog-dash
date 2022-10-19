

      <?php $this->load->view('restrita/layout/sidebar'); ?>

    

      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view('restrita/layout/navbar'); ?>
       
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('restrita/usuarios') ?>">Usuario</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ;?></li>
          </ol>
        </nav>

       
        <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!-- Link para voltar menu Usuario -->
            <div class="card-header py-3">
              <a title="Voltar" href="<?php echo base_url('restrita/usuarios'); ?>" class="btn btn-success btn-sm float-right" > <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
            </div>

            <!-- Formulario -->
            <div class="card-body">
              <form method="post" name="form_edit">
                  
                  <!-- Primeira Linha -->
                  <div class="form-group row">
                      <div class="col-md-4">
                          <label>Nome</label>
                          <input type="text" class="form-control" name="first_name" placeholder="Seu nome" value="<?php echo $usuario->first_name; ?>">
                          <?php echo form_error('first_name','<small class="form-text text-danger">','</small>',''); ?>  
                      </div>
                      <div class="col-md-4">
                          <label>Sobrenome</label>
                          <input type="text" class="form-control" name="last_name" placeholder="Seu sobrenome" value="<?php echo $usuario->last_name; ?>">
                          <?php echo form_error('last_name','<small class="form-text text-danger">','</small>',''); ?>  
                      </div>
                      <div class="col-md-4">
                          <label>Email&nbsp;(Login)</label>
                          <input type="email" class="form-control" name="email" placeholder="Sua email (login)" value="<?php echo $usuario->email; ?>">
                          <?php echo form_error('email','<small class="form-text text-danger">','</small>',''); ?>  
                      </div>

                  </div>
                  
                  <!-- Segunda Linha -->
                  <div class="form-group row">
                    <div class="col-md-4">
                          <label>Usuario</label>
                          <input type="text" class="form-control" name="username" placeholder="Usuario" value="<?php echo $usuario->username; ?>">
                          <?php echo form_error('username','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>

                    <div class="col-md-4">
                          <label>Ativo</label>
                          <select name="active"  class="form-control" <?php echo (!$this->ion_auth->is_admin() ? 'disabled' : ''); ?>>
                              <option value="0" <?php echo ($usuario->active ==0) ? 'selected': '' ?> >Não</option>
                              <option value="1" <?php echo ($usuario->active ==1) ? 'selected': '' ?> >Sim</option>
                          </select>
                    </div>
                
                    <div class="col-md-4">
                          <label>Perfil de acesso</label>
                          <select name="perfil_usuario" class="form-control" <?php echo (!$this->ion_auth->is_admin() ? 'disabled' : ''); ?>>
                              <option value="2" <?php echo ($perfil_usuario->id ==2) ? 'selected': '' ?>> Vendedor</option>
                              <option value="1" <?php echo ($perfil_usuario->id ==1) ? 'selected': '' ?> >Administrador</option>
                          </select>
                    </div>
                  </div>

                  <!-- Terceira Linha -->
                  <div class="form-group row">
                    <div class="col-md-6">
                        <label>Senha</label>
                        <input type="password" class="form-control" name="password" placeholder="Sua senha">
                        <?php echo form_error('password','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>
                    <div class="col-md-6">
                        <label>Confirme Senha</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirma sua senha">
                        <?php echo form_error('confirm_password','<small class="form-text text-danger">','</small>',''); ?>  
                    </div>


                    <input type="hidden" name="usuario_id" value="<?php echo $usuario->id ?>">

                  </div>


                  <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
              </form>
            </div>
            
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     