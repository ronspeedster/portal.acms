<?php
    if(!isset($_GET['setting_id']))
    {
      header("location: manage_email_settings.php");
    }

    include('sidebar.php');

    
    $protocol           = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI             = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;
    
    $setting           =  mysqli_fetch_assoc($mysqli->query("SELECT * FROM settings_notification WHERE id={$_GET['setting_id']}"));
?>
<title>Notification Setting Summary</title>
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
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Notification Setting Summary</h1>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold" style="color: green;">Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    Name 
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" value="<?=$setting['name']?>" readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    Email To
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" value="<?=$setting['email_to'] ?? 'NONE'?>" readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    Is Active 
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" value="<?=$setting['is_active'] == 1 ? 'YES' : 'NO'?> " readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    Created At 
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" value="<?=$setting['created_at']?>" readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    Updated At 
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" value="<?=$setting['updated_at']?>" readonly>
                                
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-end">
                          <form action="process_notification_settings.php" method="POST" class='align-self-start mr-2'>
                            <input type="hidden" name="id" value="<?=$setting['id']?>"> 
                            <button type="submit" name="delete_setting" class="btn btn-sm btn-danger text-white">
                                Delete
                            </button>
                          </form>
                          <form action="process_notification_settings.php" method="POST" class='align-self-start mr-2'>
                            <input type="hidden" name="id" value="<?=$setting['id']?>"> 
                            <button type="submit" name="test_setting" class="btn btn-sm btn-info text-white">
                                Test
                            </button>
                          </form>
                          <button class="btn btn-sm bg-gradient-primary text-white" data-toggle="modal" data-target="#modal_edit_setting">
                            Edit
                          </button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>

        <!-- Edit Setting Modal-->
        <!-- Setting Create Modal-->
        <div class="modal fade" id="modal_edit_setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Email Setting</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <form action="process_notification_settings.php" method="POST">
                    <input type="hidden" name="id" value="<?=$setting['id']?>">
                    <div class="modal-body">
                        <div class="row my-2 mb-3">
                        <div class="col-md-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" id="name" value="<?=$setting['name']?>" required>
                        </div>
                        </div>
                        <div class="row my-2 mb-3">
                        <div class="col-md-12">
                            <label for="email_to">Email To</label>
                            <input type="email" class="form-control" name="email_to" placeholder="Email To" id="email_to" value="<?=$setting['email_to']?>">
                        </div>
                        </div>
                        <div class="row mt-3">
                        <div class="col-md-6 my-2">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" <?=$setting['is_active'] ? 'checked' : ''?>>
                            <label class="custom-control-label" for="is_active">Enable</label>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn bg-gradient-primary btn-sm text-white" name="update_setting">Submit</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
       <!-- End Setting Create Modal-->
        <!-- End Edit Setting Modal-->
        <!-- /.container-fluid -->

<?php
  include('footer.php');
?>

      </div>
      <!-- End of Main Content -->