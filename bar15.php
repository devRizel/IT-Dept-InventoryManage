<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
date_default_timezone_set('Asia/Manila');
  $page_title = 'All Image';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php $hddssdgb_files = find_all('hddssdgb');?>
<?php
if (isset($_POST['submit'])) {
  $photo = new hddssdgb();
  $photo->upload($_FILES['file_upload']);
  
  if ($photo->process_hddssdgb()) {
      $session->msg('s', 'Photo has been uploaded.');
      redirect('bar15.php?success=true'); // Redirect with success parameter
  } else {
      $js_error_msgs[] = "" . join($photo->errors);
  }
}


?>
<?php include_once('layouts/header.php'); ?>
<center><h1>Add Barcode|HDD|SSD|GB</h1></center>
     <div class="row">

      <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="col-md-12">
        <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
          <div  style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading clearfix">
            <span class="glyphicon glyphicon-camera"></span>
            <span style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);">All Photos</span>
            <div class="pull-right">
              <form class="form-inline" action="bar15.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">
                    <input   style=" border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="file" name="file_upload" multiple="multiple" class="btn btn-primary btn-file"/>
                 </span>

                 <button   style=" border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="submit" name="submit" class="btn btn-default">Upload</button>
               </div>
              </div>
             </form>
            </div>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center" style="width: 50px;">#</th>
                  <th class="text-center">Photo</th>
                  <th class="text-center">Photo Name</th>
                  <th class="text-center" style="width: 20%;">Photo Type</th>
                  <th class="text-center" style="width: 50px;">Actions</th>
                </tr>
              </thead>
                <tbody>
                <?php foreach ($hddssdgb_files as $hddssdgb_file): ?>
                <tr class="list-inline">
                 <td class="text-center"><?php echo count_id();?></td>
                  <td class="text-center">
                      <img src="uploads/products/<?php echo $hddssdgb_file['file_name'];?>" class="img-thumbnail" />
                  </td>
                <td class="text-center">
                  <?php echo $hddssdgb_file['file_name'];?>
                </td>
                <td class="text-center">
                  <?php echo $hddssdgb_file['file_type'];?>
                </td>
                <td class="text-center">
                  <a href="delete_bar15.php?id=<?php echo (int) $hddssdgb_file['id'];?>" class="btn btn-danger btn-xs"  title="Edit">
                    <span class="glyphicon glyphicon-trash"></span>
                  </a>
                </td>
               </tr>
              <?php endforeach;?>
            </tbody>
          </div>
        </div>
      </div>
</div>
<?php include_once('layouts/footer.php'); ?>
<?php if (!empty($js_error_msgs)): ?>
  <script src="sweetalert.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessages = <?php echo json_encode($js_error_msgs); ?>;
            errorMessages.forEach(function(msg) {
                swal({
                    title: "",
                    text: msg,
                    icon: "warning",
                    dangerMode: true
                });
            });
        });
    </script>
<?php endif; ?>
<script src="sweetalert.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');
    let successMessage = "";

    if (successParam === 'true') {
        if (urlParams.get('delete_photo')) {
            successMessage = "Photo Deleted Successfully.";
        } else {
            successMessage = "Photo has been uploaded.";
        }

        swal("", successMessage, "success")
            .then((value) => {
                window.location.href = 'bar15.php'; // Redirect back to media.php after user closes alert
            });
    }
});
</script>




