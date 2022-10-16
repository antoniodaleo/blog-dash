<?php $this->load->view('restrita/layout/sidebar'); ?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

     

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Home</h1>
                    <textarea name="txt_text" id="editor1" ></textarea>









                    
                    <script>
                        CKEDITOR.replace('editor1', {
                            filebrowserBrowseUrl: '../assets/ckfinder/ckfinder.html',
                            filebrowserImageBrowseUrl: '../assets/ckfinder/ckfinder.html?type=Images',
                            filebrowserUploadUrl: '../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                            filebrowserImageUploadUrl: '../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                        });

                    </script>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

          