<?php $this->load->view('restrita/layout/sidebar') ?>

<!-- Main Content -->
<div id="content">

<?php $this->load->view('restrita/layout/navbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('restrita/categoria') ?>">Categoria</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ;?></li>
  </ol>
</nav>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <!-- Link para voltar menu Usuario -->
      <div class="card-header py-3">
        <a title="Voltar" href="<?php echo base_url('restrita/categoria'); ?>" class="btn btn-success btn-sm float-right" > <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
      </div>

      <!-- Formulario -->
      <div class="card-body">
        <?php
            $attributos = array(
                'name' => 'form_core', 
                ); 

                if(isset($categoria)){
                    $categoria_id = $categoria->categoria_id; 
                    }else{
                    $categoria_id = ''; 
                }
        ?>  
        <!-- Primeira Linha -->
        <?php echo form_open('restrita/categoria/core/'.$categoria_id); ?>
        <div class="form-group row">
            <div class="col-md-4">
                <label>Nome da categoria</label>
                <input type="text" name="categoria_nome" class="form-control" value="<?php echo (isset($categoria) ? $categoria->categoria_nome : set_value('categoria_nome')) ; ?>">
                <?php echo form_error('categoria_nome','<div class="text-danger">','</div>') ?>
            </div>

            <div class="form-group col-md-2">
                <label for="inpState">Ativa</label>
                <select name="categoria_ativa" id="inpState" class="form-control">

                <?php if(isset($categoria)) : ?>

                    <option value="1" <?php echo ($categoria->categoria_ativa == 1? 'selected' : ''  ) ; ?> >Sim</option>
                    <option value="0" <?php echo ($categoria->categoria_ativa == 0? 'selected' : ''  ) ; ?> >Não</option>
                <?php else:  ?>
                    <option value="1" >Sim</option>
                    <option value="0" >Não</option>

                <?php endif;  ?>
                            
                </select>
            </div>
            
            <?php if(isset($categoria)): ?>
            <div class="form-group col-md-3">
                <label>Metalink da categoria</label>
                <input type="text" name="categoria_pai_meta_link" class="form-control border-0" value="<?php echo $categoria->categoria_meta_link ; ?>" readonly>
            </div>
            <?php endif; ?>
        </div>

        

            <?php if(isset($categoria)): ?>
                <input type="hidden" name="categoria_id" value="<?php echo $categoria->categoria_id; ?>">
            <?php endif;  ?>    
            
        <div class="card-footer">
            <button class="btn btn-primary mr-2">Salvar</button>
            <a href="<?php echo base_url('restrita/categoria'); ?>" class="btn btn-dark">Voltar</a>
        </div>
      </div>
      <?php echo form_close(); ?>
      
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->     