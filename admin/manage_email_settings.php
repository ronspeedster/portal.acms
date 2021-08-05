<?php
    require_once('../process_post.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $settings   =   $mysqli->query("SELECT * FROM settings_email");
?>
<title>Email Settings</title>

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
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow overflow-auto">
                        <div class="card-header bg-gradient-primary text-white font-weight-bold">
                            Emails                      
                        </div>
                        <div class="card-body">
                            <table id="table_category" class="table table-hover text-sm">
                                <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>NAME</th>
                                      <th>HOST</th>
                                      <th>IS DEFAULT</th>
                                      <th>CREATED AT</th>
                                      <th>UPDATED AT</th>
                                      <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1; ?> 
                                  <?php foreach($settings as $setting):?> 
                                  <tr class="cursor-pointer">
                                    <td>
                                      <?=$i?>
                                    </td>
                                    <td>
                                      <?=$setting['name']?>
                                    </td>
                                    <td>
                                      <?=$setting['host']?>
                                    </td>
                                    <td>
                                      <?=$setting['is_default'] == 1 ? 'YES' : 'NO'?> 
                                    </td>
                                    <td>
                                      <?=$setting['created_at']?> 
                                    </td>
                                    <td>
                                      <?=$setting['updated_at']?> 
                                    </td>
                                    <td>
                                      <a href="view_email_setting.php?setting_id=<?=$setting['id']?>" class="btn btn-sm bg-gradient-primary text-white">
                                        <i class='fas fa-eye mr-2'></i>View
                                      </a>
                                    </td>
                                  </tr>
                                  <?php $i++; ?> 
                                  <?php endforeach ?> 
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <td colspan='6'>
                                    </td>
                                    <td colspan='1'>
                                      <button class="btn btn-sm bg-gradient-primary text-white" data-toggle="modal" data-target="#modal_create_category">
                                        <i class='fas fa-plus mr-2'></i>Add
                                      </button>
                                    </td>
                                  </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


      <!-- Setting Create Modal-->
      <div class="modal fade" id="modal_create_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Email Setting</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form action="process_email_settings.php" method="POST">
              <div class="modal-body">
                <div class="row my-2 mb-3">
                  <div class="col-md-12">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" id="name" value="" required>
                  </div>
                </div>
                <div class="row my-2 mb-3">
                    <div class="col-md-12">
                        <?php 
                            $hosts = ['smtp.mailtrap.io', 'smtp.gmail.com', 'mail.acms.org.ph'];
                        ?> 
                        <label for="host">Host</label>
                        <select class="form-control" name="host" id="host">
                            <?php foreach($hosts as $host): ?> 
                                <option value="<?=$host?>">
                                    <?=$host?>
                                </option>
                            <?php endforeach ?> 
                        </select>
                    </div>
                </div>
                <div class="row my-2 mb-3">
                  <div class="col-md-12">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" id="username" value="" required>
                  </div>
                </div>
                <div class="row my-2 mb-3">
                    <div class="col-md-12">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Password" id="password" value="" required>
                    </div>
                </div>
                <div class="row my-2 mb-3">
                    <div class="col-md-12">
                    <?php 
                        $ports  = [465, 587, 2525]; 
                    ?>
                        <label for="port">Port</label>            
                        <select class="form-control" name="port" id="port">
                            <?php foreach($ports as $port): ?> 
                                <option value="<?=$port?>">
                                    <?=$port?>
                                </option>
                            <?php endforeach ?> 
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6 my-2">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="auth" class="custom-control-input" id="auth">
                      <label class="custom-control-label" for="auth">Enable Auth</label>
                    </div>
                  </div>
                  <div class="col-md-6 my-2">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="default" class="custom-control-input" id="default">
                      <label class="custom-control-label" for="default">Make Default</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn bg-gradient-primary btn-sm text-white" name="create_setting">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
       <!-- End Setting Create Modal-->
<?php
  include('footer.php');
?>

<script>
    $(document).ready(function() {
        $('#table_category').DataTable(
            {
                "pageLength": 50,
            }
        ); 
    } );
</script>