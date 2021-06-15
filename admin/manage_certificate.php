<?php
    include('sidebar.php');
?>
<title>Manage Certificate</title>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

<?php require('topbar.php'); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php if(isset($_SESSION['message'])): ?> 
            <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$_SESSION['message']?> 
                <?php unset($_SESSION['message']);?>
            </div>
        <?php endif ?> 
        <!-- Alert Here -->
        <?php if(isset($_SESSION['errors'])): ?> 
          <?php foreach($_SESSION["errors"] as $key => $value): ?>  
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$value?> 
            </div>
            <?php endforeach ?> 
          <?php unset($_SESSION['errors']); ?> 
        <?php endif ?> 
        <!-- End Alert Here -->

        <?php 
            $query  = $mysqli->query("SELECT * from certificates WHERE name='GOOD STANDING'"); 
            $cert   = $query->fetch_assoc();

            if(isset($cert['signature']) && !empty($cert['signature']))
            {
                $filePath = "../storage/certificate/{$cert['signature']}";
            }
            else 
            {
                $filePath = "../storage/misc/no-image.jpg"; 
            }
        ?> 
        <div class="row">
            <div class="col-md-8">
              <div class="card shadow">
                <div class="card-header">
                  Certificate Signature with Signee Name (.png)(200 Width x 100 Height Recommended)
                </div>
                <form action="process_certificate.php" method="post" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="text-center">
                          <img src="<?=$filePath?>" id="preview_image" alt="" class="text-center">
                        </div>
                        <div class="custom-file my-4">
                            <input type="file" class="custom-file-input" name="signature" id="file_signature" aria-describedby="customFileInput">
                            <label class="custom-file-label" for="customFileInput">Select file</label>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label for="holder">Signature Holder's Name</label>
                        <input type="text" name='holder' id="holder" class="form-control" placeholder="Holder" value="<?=$cert['holder']?>" required>                
                      </div> 
                    </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end">
                    <?php if(isset($cert['signature']) && !empty($cert['signature'])): ?> 
                      <button class="btn btn-sm btn-danger mr-2" name="check_certificate">Check</button>
                    <?php endif ?> 
                    <button class="btn btn-sm btn-success" name="upload_signature">Submit</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-md-6">
            
            </div>
        </div>

<?php
  include('footer.php');
  ?>
<script>
  $(document).ready(function() 
      {
          $('.custom-file-input').on('change', function (e) 
              {
                  let name                  = $("#file_signature")[0].files[0].name;
                  let nextSibling           = e.target.nextElementSibling
                      nextSibling.innerText = name

                  readURL(this);
              }
          );

          function readURL(input) 
          {
              if (input.files && input.files[0]) 
              {
                  const reader = new FileReader();
                  
                  reader.onload = function (e) {
                      $('#preview_image').attr('src', e.target.result);
                  }
                  
                  reader.readAsDataURL(input.files[0]);
              }
          }
      }
  );
</script>

      </div>
      <!-- End of Main Content -->