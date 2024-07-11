<?php
$page_title = 'Sale Report';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="col-md-6">
    <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel">
      <div class="panel-heading">

      </div>
      <div style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);" class="panel-body">
          <form class="clearfix" method="post" action="sale_report_process.php">
            <div class="form-group">
              <label class="form-label">Date Range</label>
                <div class="input-group">
                  <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="text" class="datepicker form-control" name="start-date" placeholder="From">
                  <span style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);"  type="text" class="datepicker form-control" name="end-date" placeholder="To">
                </div>
            </div>
            <div class="form-group">
                 <button style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="submit" class="btn btn-primary">Generate Report</button>
            </div>
          </form>
      </div>

    </div>
  </div>

</div>
<?php include_once('layouts/footer.php'); ?>
