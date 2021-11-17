<?php
require_once("php/init.php");
$customJs[] = "js/financial.js";
?>
<?php include_once('inc/header.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-12 col-md-10 m-auto">
      <div class="card">
        <h5 class="card-header bg-info text-light">Financial Information</h5>
        <div class="card-body">
          <form id="financialForm">
            <div class="form-row">
              <div class="form-group col-12">
                <label for="firmId">Firm Name</label>
                <select class="custom-select" id="firmId" name="firmId">
                  <option value="" hidden></option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4 col-12">
                <label for="financialYear">Financial Year</label>
                <select class="custom-select" id="financialYear" name="financialYear">
                  <option value="" hidden></option>
                  <option value="2019-20">2019-20</option>
                  <option value="2018-19">2018-19</option>
                  <option value="2017-18">2017-18</option>
                  <option value="2016-17">2016-17</option>
                </select>
              </div>
              <div class="form-group col-md-4 col-12">
                <label for="filingDate">Filing Date</label>
                <input type="date" class="form-control" id="filingDate" name="filingDate">
              </div>
              <div class="form-group col-md-4 col-12">
                <label for="taxPaid">Tax Paid</label>
                <input type="text" class="form-control" name="taxPaid" id="taxPaid">
              </div>
            </div>
            <p class="text-muted small">* Fill the Financial Information below</p>
            <fieldset>
              <hr class="my-0">
              <h6 class="m-0 py-3">Trading Account<span class="float-right">-</span></h6>
              <hr class="mt-0">
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="cogs">Cost of Goods Sold</label>
                  <input type="text" class="form-control" name="cogs" id="cogs">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="totalSales">Total Sales</label>
                  <input type="text" class="form-control" name="totalSales" id="totalSales">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="directExpense">Direct Expense</label>
                  <input type="text" class="form-control" name="directExpense" id="directExpense">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="directIncome">Direct Income</label>
                  <input type="text" class="form-control" name="directIncome" id="directIncome">
                </div>
              </div>
            </fieldset>
            <fieldset>
              <hr class="mb-0">
              <h6 class="m-0 py-3">Profit and Loss Account</h6>
              <hr class="mt-0">
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="proSalary">Partners/Directors Salary</label>
                  <input type="text" class="form-control" name="proSalary" id="proSalary">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="depreciation">Depreciation</label>
                  <input type="text" class="form-control" name="depreciation" id="depreciation">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="interestCapital">Interest on Partners Capital</label>
                  <input type="text" class="form-control" name="interestOnCapital" id="interestOnCapital">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="interestPaid">Interest Paid</label>
                  <input type="text" class="form-control" name="interestPaid" id="interestPaid">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="netProfit">Net Profit</label>
                  <input type="text" class="form-control" name="netProfit" id="netProfit">
                </div>
              </div>
            </fieldset>
            <fieldset>
              <hr class="mb-0">
              <h6 class="m-0 py-3">Balance Sheet</h6>
              <hr class="mt-0">
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="shareCapital">Share Capital</label>
                  <input type="text" class="form-control" name="shareCapital" id="shareCapital">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="fixedAsset">Fixed Assets</label>
                  <input type="text" class="form-control" name="fixedAsset" id="fixedAsset">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="reserves">Reserves</label>
                  <input type="text" class="form-control" name="reserves" id="reserves">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="investments">Investments</label>
                  <input type="text" class="form-control" name="investments" id="investments">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="shortTermLoans">Short Term Loans (CC/OD)</label>
                  <input type="text" class="form-control" name="shortTermLoan" id="shortTermLoan">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="loanAdvances">Loan & Advances</label>
                  <input type="text" class="form-control" name="loanAdvances" id="loanAdvances">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="longTermLoan">Long Term Loans (Secured)</label>
                  <input type="text" class="form-control" name="longTermLoan" id="longTermLoan">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="sundryDebtors">Sundry Debtors</label>
                  <input type="text" class="form-control" name="sundryDebtors" id="sundryDebtors">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="unsecuredLoans">Unsecured Loans</label>
                  <input type="text" class="form-control" name="unsecuredLoans" id="unsecuredLoans">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="cashBankBalance">Cash / Bank Balance</label>
                  <input type="text" class="form-control" name="cashBankBalance" id="cashBankBalance">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="sundryCreditors">Sundry Creditors</label>
                  <input type="text" class="form-control" name="sundryCreditors" id="sundryCreditors">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="closingStock">Closing Stock</label>
                  <input type="text" class="form-control" name="closingStock" id="closingStock">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="provisions">Provisions</label>
                  <input type="text" class="form-control" name="provisions" id="provisions">
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="otherAssets">Other Assets</label>
                  <input type="text" class="form-control" name="otherAssets" id="otherAssets">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 col-12">
                  <label for="otherLiabilities">Other Liabilities</label>
                  <input type="text" class="form-control" name="otherLiability" id="otherLiability">
                </div>
              </div>
            </fieldset>
            <div class="form-row">
              <div class="form-group col-12">
                <input type="hidden" name="tokenNumber" value="<?php echo Token::generate(); ?>">
                <button type="submit" class="btn btn-secondary btn-block">Submit Financial</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('inc/footer.php'); ?>
