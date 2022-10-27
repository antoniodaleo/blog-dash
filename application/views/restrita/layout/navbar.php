 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search Removido -->

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-bell fa-fw"></i>
      <!-- Counter - Alerts -->
      <span class="badge badge-danger badge-counter">0</span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
         Central de Notificações
      </h6>
      <a class="dropdown-item d-flex align-items-center" href="#">
        <div class="mr-3">
          <div class="icon-circle bg-primary">
            <i class="fas fa-file-alt text-white"></i>
          </div>
        </div>
        <div>
        <div class="small text-gray-500"></div>
          <span class="font-weight-bold">A new monthly report is ready to download!</span>
        </div>
        </a>                
    </div>
  </li>

  <!-- Nav Item - Messages -->
  <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter"><?php echo $novo_email->qtd_nova_email;   ?></span>
      </a>
      <!-- Dropdown - Messages -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
          Novas mensagens
        </h6>

        <?php foreach($email_view as $email): ?> 
          <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('restrita/email/mensagem/'.$email->email_id); ?>">
            <div class="font-weight-bold">
              <div class="text-truncate"><?php echo $email->email_mensagem;  ?></div>
              <div class="small text-gray-500"><?php echo $email->email_descricao;  ?> · <?php echo formata_data_banco_sem_hora($email->email_data) ;  ?></div>
            </div>
          </a>

        <?php endforeach;  ?>
        
      </div>
    </li>




  <div class="topbar-divider d-none d-sm-block"></div>
    
  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php $user = $this->ion_auth->user()->row();  ?>
      <span class="mr-2 d-none d-lg-inline text-gray-900 "><?php echo $user->first_name;  ?></span>
      <i class="far fa-user fa-2x text-gray-900"></i>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="<?php echo base_url('restrita/usuarios/edit/'.$this->session->userdata('user_id')); ?>">
        <i class="far fa-user fa-sm fa-fw mr-2 text-gray-900"></i>
        Perfil
      </a>
      
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo base_url('restrita/login/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Sair
      </a>
    </div>
  </li>


</ul>

</nav>
<!-- End of Topbar -->