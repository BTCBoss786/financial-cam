<?php
require_once("php/init.php");
$customJs[] = "js/index.js";
?>
<?php include_once('inc/header.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-12 col-md-10 m-auto">
      <div class="card">
        <h5 class="card-header bg-info text-light">Firm Information</h5>
        <div class="card-body">
          <p class="card-text text-muted small">* Fill the information below to Register Firm</p>
          <form id="firmForm">
            <div class="form-group">
              <label for="firmName">Firm Name</label>
              <input type="text" class="form-control" name="firmName" id="firmName" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="firmType">Firm Type</label>
              <select class="custom-select" name="firmType" id="firmType">
                <option value="" hidden></option>
                <option value="Proprietorship">Proprietorship</option>
                <option value="Partnership">Partnership</option>
                <option value="Private Limited">Private Limited</option>
                <option value="Unlisted Public Limited">Unlisted Public Limited</option>
              </select>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="formAgree">
                <label class="custom-control-label" for="formAgree">I Agree to Register Firm</label>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="tokenNumber" value="<?php echo Token::generate(); ?>">
              <button type="submit" class="btn btn-secondary btn-block">Register Firm</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('inc/footer.php'); ?>
