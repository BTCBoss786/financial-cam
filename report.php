<?php
require_once("php/init.php");
$customJs[] = "js/report.js";
?>
<?php include_once('inc/header.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-12 col-md-10 m-auto">
      <div class="card">
        <h5 class="card-header bg-info text-light">CAM Report</h5>
        <div class="card-body">
          <form id="reportForm">
            <div class="form-row">
              <div class="form-group col-12">
                <label for="firmId">Firm Name</label>
                <select class="custom-select" id="firmId" name="firmId">
                  <option value="" hidden></option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="financialYear">Financial Year</label>
                <div class="row col" id="financialYear"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <!-- <input type="hidden" name="tokenNumber" value="<?php echo Token::generate(); ?>"> -->
                <button type="submit" class="btn btn-secondary btn-block">Get Report</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-10 m-auto">
      <div class="card">
        <div class="card-body" id="tableData">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="firmDetails"></table>
            <table class="table table-bordered table-hover" id="financialDetails"></table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<?php include_once('inc/footer.php'); ?>
