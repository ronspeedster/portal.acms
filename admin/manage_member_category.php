<?php
    require_once('../process_post.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $categories   =   $mysqli->query("SELECT * FROM member_category");
?>
<title>Member Category</title>

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
                            Member Category                        
                        </div>
                        <div class="card-body">
                            <table id="table_category" class="table table-hover text-sm">
                                <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>NAME</th>
                                      <th>IS ACTIVE</th>
                                      <th>IS DEFAULT</th>
                                      <th>CREATED AT</th>
                                      <th>UPDATED AT</th>
                                      <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1; ?> 
                                  <?php foreach($categories as $category):?> 
                                  <tr class="cursor-pointer">
                                    <td>
                                      <?=$i?>
                                    </td>
                                    <td>
                                      <?=$category['name']?>
                                    </td>
                                    <td>
                                      <?=$category['is_active'] == 1 ? 'YES' : 'NO'?> 
                                    </td>
                                    <td>
                                      <?=$category['is_default'] == 1 ? 'YES' : 'NO'?> 
                                    </td>
                                    <td>
                                      <?=$category['created_at']?> 
                                    </td>
                                    <td>
                                      <?=$category['updated_at']?> 
                                    </td>
                                    <td>
                                      <a href="member_category_view.php?category_id=<?=$category['id']?>" class="btn btn-sm bg-gradient-primary text-white">
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


      <!-- Category Create Modal-->
      <div class="modal fade" id="modal_create_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form action="process_member_category.php" method="POST">
              <div class="modal-body">
                <div class="row mt-2 mb-3">
                  <div class="col-md-12">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" id="name" value="" required>
                  </div>
                </div>
                <div class="row mt-2 mb-3">
                  <div class="col-md-12">
                    <label for="desc">Description</label>
                    <textarea class="form-control" name="desc" placeholder="Description" id="desc" value="" required></textarea>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="default" class="custom-control-input" id="default">
                      <label class="custom-control-label" for="default">Assign this by default to newly registered members?</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn bg-gradient-primary btn-sm text-white" name="create_category">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
       <!-- End Category Create Modal-->
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