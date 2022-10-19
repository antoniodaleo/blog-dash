<?php $this->load->view('restrita/layout/sidebar'); ?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php $this->load->view('restrita/layout/navbar'); ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('restrita/blog') ?>">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ;?></li>
                    </ol>
                </nav>

                 <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <!-- Link para voltar menu Usuario -->
                    <div class="card-header py-3">
                        <a title="Voltar" href="<?php echo base_url('restrita/blog'); ?>" class="btn btn-success btn-sm float-right" > <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
                    </div>

                    <!-- Formulario -->
                    <div class="card-body">
                        <?php
                            $attributos = array(
                                'name' => 'form_core', 
                            ); 

                            if(isset($blog)){
                            $blog_id = $blog->blog_id; 
                            }else{
                            $blog_id = ''; 
                            }
                        ?>



                    <?php echo form_open('restrita/blog/core/'.$blog_id); ?>


                    <?php  if(isset($blog)):   ?>
                        <div class="form-row">
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp; Ùltima alteração: </strong> <?php echo formata_data_banco_com_hora($blog->blog_data_alteracao);  ?></p>    
                            </div>
                            <div class="col-md-6">
                                <label><strong>Meta Link do post</strong></label>
                                <p class="text-info"> <i class=""></i>  <?php echo $blog->blog_meta_link; ?> </p>
                            </div>
                        </div>            
                    <?php  endif;   ?>

    
                    <!-- Primeira Linha -->
                    <div class="form-group row">


                        <div class="col-md-1">
                            <label>ID do post</label>
                            <input type="text" name="blog_id"  class="form-control b-0" readonly disabled value="<?php echo (isset($blog)? $blog->blog_id : 'ID post');  ?>"> 
                        </div>
                        <div class="col-md-6">
                            <label>Titulo do post</label>
                            <input type="text" name="blog_titulo" class="form-control" value="<?php echo (isset($blog)? $blog->blog_titulo : set_value('blog_titulo'));  ?>">
                            <?php echo form_error('blog_titulo','<div class="text-danger">','</div>') ?>
                        </div>
                        <div class="col-md-2">
                            <label>Data do post</label>                                         
                            <input type="date" class="form-control" name="blog_data" placeholder="Data do post" value="<?php echo (isset($blog)? $blog->blog_data : set_value('blog_data'));  ?>">
                            <?php echo form_error('blog_data','<small class="form-text text-danger">','</small>',''); ?>  
                        </div>

                        <!-- Categoria -->
                        <div class="form-group col-md-3">
                            <label for="inpState">Categoria</label>
                            <select name="blog_categoria_id" id="inpState" class="form-control">
                                <option value="">Escolha..</option>
                                <?php foreach($categorias as $categoria) : ?>
                                    <?php if(isset($blog)) : ?>
                                        
                                        <option value="<?php echo ($categoria->categoria_id); ?>" <?php echo ($categoria->categoria_id == $blog->blog_categoria_id ? 'selected' : '');  ?> ><?php echo  $categoria->categoria_nome; ?></option>
                                        
                                    <?php else:  ?>

                                        <option value="<?php echo ($categoria->categoria_id); ?>" ><?php echo  $categoria->categoria_nome; ?></option>
                                    <?php endif;  ?>

                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('blog_categoria_id','<div class="text-danger">','</div>') ?>
                        </div>
                    </div>

                    <!-- Segunda Linha Descricao-->
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Descrição do post</label>
                            <textarea name="blog_descricao" id="blog_descricao" class="form-control"><?php echo (isset($blog) ? $blog->blog_descricao : set_value('blog_descricao')) ; ?></textarea>
                            <?php echo form_error('blog_descricao','<div class="text-danger">','</div>') ?>
                        </div>
                    </div>

                    <!-- Terza Linha Artigo-->
                    <div class="form-grou row">
                        <div class="col-md-12">
                            <label >Escreva seu artigo</label>
                            <textarea name="blog_body" id="editor1" class="form-control"><?php echo (isset($blog) ? $blog->blog_body : set_value('blog_body')) ; ?></textarea>
                            <?php echo form_error('blog_body','<div class="text-danger">','</div>') ?>
                        </div>

                    </div>
                    

                    <!-- Setima linha de dados -->
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Imagens do post</label>
                                <div id="fileuploader"> 
                                        
                                </div>

                                <div id="erro_uploaded" class="text-danger">

                                </div>
                            <?php //echo form_error('fotos_produtos', '<div class="text-danger">','</div>'); ?>
                        </div>
                    </div>
                    
                    <!-- Quinta linha de dados -->
                    <div class="form-row">
                        <div class="col-md-12">

                        <?php if(isset($blog)): ?>

                        <div id="uploaded_image" class="text-danger">
                            <?php foreach($fotos_produto as $foto): ?>
                                <ul style="list-style: none; display: inline-block">
                                    <li>
                                        <img src="<?php echo base_url('uploads/produtos/'.$foto->foto_caminho) ;?>" width="80" class="img-thumbnail mr-1 mb-2"  >
                                        <input type="hidden" name="fotos_produtos[]" value="<?php echo $foto->foto_caminho ;?>">
                                        <a href="javascript:(void)" class="btn btn-danger d-block btn-icon mx-auto mb-30 btn-remove"><i class="fas fa-times"></i></a>
                                    </li>
                                </ul>
                            <?php endforeach; ?>
                        </div>

                        <?php else: ?>

                            <div id="uploaded_image" class="text-danger">

                            </div>

                        <?php endif; ?>
                        </div>
                    </div>
                        
              
                    <?php if(isset($blog)): ?>
                        <input type="hidden" name="blog_id" value="<?php echo $blog->blog_id; ?>">
                    <?php endif;  ?>

                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    <?php echo form_close(); ?>

                </div>
      
            </div>


            <script>
                CKEDITOR.replace('editor1', {
                    filebrowserBrowseUrl: '../../assets/ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl: '../../assets/ckfinder/ckfinder.html?type=Images',
                    filebrowserUploadUrl: '../../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl: '../../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                });
            </script>
            
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    
