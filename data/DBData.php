<!-- Database Name -->
CREATE DATABASE `lk_cam` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;


<!-- Firm Table -->
CREATE TABLE `firms`(
    `firmid` INT NOT NULL AUTO_INCREMENT,
    `firmname` VARCHAR(64) NULL,
    `firmtype` VARCHAR(16) NULL,
    `status` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`firmid`)
) ENGINE = INNODB;

CREATE VIEW `firmData` AS
SELECT
   `firmId` AS `Firm ID`,
   `firmName` AS `Firm Name`,
   `firmType` AS `Firm Type`,
   `status` AS `Status`
FROM
   `firms`;


<!-- Financial Table -->
CREATE TABLE `financials`(
    `financialId` INT NOT NULL AUTO_INCREMENT,
    `firmId` INT NOT NULL,
    `financialYear` VARCHAR(8) NOT NULL,
    `filingDate` DATE NULL,
    `taxPaid` DOUBLE NULL,
    `cogs` DOUBLE NULL,
    `totalSales` DOUBLE NULL,
    `directIncome` DOUBLE NULL,
    `directExpense` DOUBLE NULL,
    `proSalary` DOUBLE NULL,
    `depreciation` DOUBLE NULL,
    `interestOnCapital` DOUBLE NULL,
    `interestPaid` DOUBLE NULL,
    `netProfit` DOUBLE NULL,
    `shareCapital` DOUBLE NULL,
    `fixedAsset` DOUBLE NULL,
    `reserves` DOUBLE NULL,
    `investments` DOUBLE NULL,
    `shortTermLoan` DOUBLE NULL,
    `loanAdvances` DOUBLE NULL,
    `longTermLoan` DOUBLE NULL,
    `sundryDebtors` DOUBLE NULL,
    `unsecuredLoans` DOUBLE NULL,
    `cashBankBalance` DOUBLE NULL,
    `sundryCreditors` DOUBLE NULL,
    `provisions` DOUBLE NULL,
    `closingStock` DOUBLE NULL,
    `otherLiability` DOUBLE NULL,
    `otherAssets` DOUBLE NULL,
    `status` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`financialId`)
) ENGINE = INNODB;

CREATE VIEW `financialData` AS
SELECT
   `financials`.`financialId` AS `Financial ID`,
   `financials`.`firmId` AS `Firm ID`,
   `financials`.`financialYear` AS `Financial Year`,
   `financials`.`status` AS `Status`
FROM
   `financials`

CREATE VIEW `profitLoss` AS
SELECT
   `financials`.`financialId` AS `Financial ID`,
   `financials`.`financialYear` AS `Financial Year`,
   `financials`.`filingDate` AS `Filing Date`,
   `financials`.`totalSales` AS `Total Sales`,
   `financials`.`directIncome` AS `Other Business Income`,
   `financials`.`totalSales` + `financials`.`directIncome` AS `Total Sales with Other Income`,
   `financials`.`cogs` AS `Cost of Goods Sold`,
   `financials`.`directExpense` AS `Direct Expense`,
   `financials`.`totalSales` + `financials`.`directIncome` - (`financials`.`cogs` + `financials`.`directExpense`) AS `Gross Profit`,
   `financials`.`totalSales` + `financials`.`directIncome` - (`financials`.`cogs` + `financials`.`directExpense`) - `financials`.`netProfit` AS `Other Expenses`,
   `financials`.`proSalary` AS `Partners / Directors Salary`,
   `financials`.`interestOnCapital` AS `Partners Interest
   on Capital`,
   `financials`.`netProfit` AS `Net Profit / Profit Before Tax`,
   `financials`.`depreciation` AS `Depreciation`,
   `financials`.`interestPaid` AS `Interest Paid`,
   `financials`.`proSalary` + `financials`.`interestOnCapital` + `financials`.`netProfit` + `financials`.`depreciation` + `financials`.`interestPaid` AS `Profit Before Depreciation,
   Interest & Tax`,
   `financials`.`taxPaid` AS `Tax`,
   `financials`.`netProfit` - `financials`.`taxPaid` AS `Profit After Tax`,
   `financials`.`proSalary` + `financials`.`interestOnCapital` + `financials`.`depreciation` + (`financials`.`netProfit` - `financials`.`taxPaid`) AS `Cash Profits`
FROM
   `financials`

CREATE VIEW `balanceSheet` AS
SELECT
   `financials`.`financialId` AS `Financial ID`,
   `financials`.`financialYear` AS `Financial Year`,
   `financials`.`shareCapital` AS `Equity Share Capital`,
   `financials`.`reserves` AS `Reserves (excluding Revaluation Reserves)`,
   `financials`.`shareCapital` + `financials`.`reserves` AS `Tangible Networth`,
   `financials`.`shortTermLoan` AS `Short Term Debt (CC / OD Facility)`,
   `financials`.`longTermLoan` AS `Long Term Debt (Term Loans)`,
   `financials`.`unsecuredLoans` AS `Unsecured Loans from within Group`,
   `financials`.`shareCapital` + `financials`.`reserves` + `financials`.`shortTermLoan` + `financials`.`longTermLoan` + `financials`.`unsecuredLoans` AS `Total Funds in Business`,
   `financials`.`sundryCreditors` AS `Sundry Creditors`,
   `financials`.`otherLiability` AS `Other Liability`,
   `financials`.`provisions` AS `Provisions`,
   `financials`.`sundryCreditors` + `financials`.`otherLiability` + `financials`.`provisions` AS `Total Current Liabilities`,
   `financials`.`shareCapital` + `financials`.`reserves` + `financials`.`shortTermLoan` + `financials`.`longTermLoan` + `financials`.`unsecuredLoans` + (`financials`.`sundryCreditors` + `financials`.`otherLiability` + `financials`.`provisions`) AS `Total Liabilities`,
   `financials`.`fixedAsset` AS `Net Fixed Assets`,
   `financials`.`investments` AS `Investments`,
   `financials`.`loanAdvances` AS `Loans & Advances`,
   `financials`.`sundryDebtors` AS `Sundry Debtors`,
   `financials`.`closingStock` AS `Inventories / Closing Stock`,
   `financials`.`cashBankBalance` AS `Cash / Bank Balance`,
   `financials`.`otherAssets` AS `Other Current Assets`,
   `financials`.`sundryDebtors` + `financials`.`closingStock` + `financials`.`cashBankBalance` + `financials`.`otherAssets` AS `Total Current Assets`,
   `financials`.`fixedAsset` + `financials`.`investments` + `financials`.`loanAdvances` + (`financials`.`sundryDebtors` + `financials`.`closingStock` + `financials`.`cashBankBalance` + `financials`.`otherAssets`) AS `Total Assets`
FROM
   `financials`

CREATE VIEW `ratio` AS
select `financialdata`.`Financial ID` AS `Financial ID`,`financialdata`.`Financial Year` AS `Financial Year`,if(`profitloss`.`Total Sales with Other Income` <> 0,concat(round(`profitloss`.`Gross Profit` / `profitloss`.`Total Sales with Other Income` * 100,2),'%'),0) AS `Gross Profit Ratio`,if(`profitloss`.`Total Sales with Other Income` <> 0,concat(round(`profitloss`.`Net Profit / Profit Before Tax` / `profitloss`.`Total Sales with Other Income` * 100,2),'%'),0) AS `Net Profit Ratio`,if(`profitloss`.`Total Sales with Other Income` <> 0,concat(round(`profitloss`.`Cash Profits` / `profitloss`.`Total Sales with Other Income` * 100,2),'%'),0) AS `Cash Profit Ratio`,if(`balancesheet`.`Total Current Liabilities` <> 0,round(`balancesheet`.`Total Current Assets` / `balancesheet`.`Total Current Liabilities`,2),0) AS `Current Ratio`,if(`profitloss`.`Interest Paid` <> 0,round(`profitloss`.`Profit Before Depreciation, Interest & Tax` / `profitloss`.`Interest Paid`,2),0) AS `Interest Coverage`,if(`balancesheet`.`Tangible Networth` <> 0,round((`balancesheet`.`Short Term Debt (CC/OD Facility)` + `balancesheet`.`Long Term Debt (Term Loans)`) / (`balancesheet`.`Tangible Networth` + `balancesheet`.`Unsecured Loans from within Group`),2),0) AS `Leverage`,if(`profitloss`.`Total Sales` <> 0,round(`balancesheet`.`Sundry Debtors` / `profitloss`.`Total Sales` * 365,0),0) AS `Debtor Days`,if(`profitloss`.`Total Sales` <> 0,round(`balancesheet`.`Inventories / Closing Stock` / `profitloss`.`Total Sales` * 365,0),0) AS `Stock Days`,if(`profitloss`.`Total Sales` <> 0,round(`balancesheet`.`Sundry Creditors` / `profitloss`.`Total Sales` * 365,0),0) AS `Creditors Days`,if(`profitloss`.`Total Sales with Other Income` <> 0,round(`balancesheet`.`Short Term Debt (CC/OD Facility)` / `profitloss`.`Total Sales with Other Income` * 365,0),0) AS `Cash Credit Days`,if(`balancesheet`.`Sundry Debtors` / `profitloss`.`Total Sales` * 365 <> 0,if(`balancesheet`.`Inventories / Closing Stock` / `profitloss`.`Total Sales` * 365 <> 0,if(`balancesheet`.`Sundry Creditors` / `profitloss`.`Total Sales` * 365 <> 0,round(`balancesheet`.`Sundry Debtors` / `profitloss`.`Total Sales` * 365 + `balancesheet`.`Inventories / Closing Stock` / `profitloss`.`Total Sales` * 365 - `balancesheet`.`Sundry Creditors` / `profitloss`.`Total Sales` * 365,0),0),0),0) AS `Working Capital Days`,round(`balancesheet`.`Sundry Debtors` + `balancesheet`.`Inventories / Closing Stock` - `balancesheet`.`Sundry Creditors`,0) AS `Working Capital Gap`,round(`balancesheet`.`Sundry Debtors` + `balancesheet`.`Inventories / Closing Stock` - `balancesheet`.`Sundry Creditors` - `balancesheet`.`Short Term Debt (CC/OD Facility)`,0) AS `Net Working Capital`,if(`balancesheet`.`Short Term Debt (CC/OD Facility)` / `profitloss`.`Total Sales with Other Income` * 365 <> 0,if(`balancesheet`.`Sundry Debtors` / `profitloss`.`Total Sales` * 365 + `balancesheet`.`Inventories / Closing Stock` / `profitloss`.`Total Sales` * 365 - `balancesheet`.`Sundry Creditors` / `profitloss`.`Total Sales` * 365 <> 0,round(`balancesheet`.`Sundry Debtors` / `profitloss`.`Total Sales` * 365 + `balancesheet`.`Inventories / Closing Stock` / `profitloss`.`Total Sales` * 365 - `balancesheet`.`Sundry Creditors` / `profitloss`.`Total Sales` * 365 - `balancesheet`.`Short Term Debt (CC/OD Facility)` / `profitloss`.`Total Sales with Other Income` * 365,0),0),0) AS `Net Working Capital Days`,if(`balancesheet`.`Tangible Networth` <> 0,concat(round(`profitloss`.`Cash Profits` / `balancesheet`.`Tangible Networth` * 100,0),'%'),0) AS `ROE (POST Tax)` from ((`financialdata` join `profitloss` on(`financialdata`.`Financial ID` = `profitloss`.`Financial ID`)) join `balancesheet` on(`financialdata`.`Financial ID` = `balancesheet`.`Financial ID`))
