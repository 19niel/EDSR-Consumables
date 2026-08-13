<?php
    include ('../php/uploadFile.php');
    include ('../php/autoRedirect.php');
    include ('../php/dates.php');
    include ('../php/userList.php');
    include ('../php/categoryList.php');
    include ('../php/subcategoryList.php');
    include ('../php/config.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="E-DSR — DSR Encoding Engine. Submit your daily sales activity report.">
        <title>Encode — E-DSR Cons</title>

        <!-- Anti-flash: apply saved theme before render -->
        <script>
        (function(){
            var t = localStorage.getItem('edsr-theme') || 'light';
            document.documentElement.setAttribute('data-theme', t);
            document.documentElement.setAttribute('data-bs-theme', t);
            window.EDSR_THEME = t;
        })();
        </script>

        <!-- Inter Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Bootstrap 5.3.2 & Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Theme & App CSS -->
        <link rel="stylesheet" href="/e-dsr-cons/css/theme.css" />
        <link rel="stylesheet" href="/e-dsr-cons/css/sidebar.css" />
        <link rel="stylesheet" href="/e-dsr-cons/css/encode.css" />

        <script src="../js/hideElement.js" defer></script>
    </head>
    <body>
        <?php include ('header.php'); ?>

        <!-- Sidebar -->
        <div class="container-fluid">
            <div class="row">
                <!-- Main Content -->
                <main class="col-12 col-md-10 mx-auto px-4">
                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom mb-4">
                        <div>
                            <h3 class="m-0 fw-bold" style="color:var(--text-primary);">Encode Account</h3>
                            <p class="text-muted small m-0 mt-1">Submit your daily sales activity report.</p>
                        </div>
                    </div>
                    
                    <div class="row py-3">
                        <form action="../php/encodeAccount.php" method="POST">
                            
                            <!-- Segment 1: Pipeline Information -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Pipeline Information</h5>
                                <div class="row g-3">
                                    <!-- SBU -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="sbu" class="form-label">SBU/Segment<span class="req"> *</span></label>
                                        <select id="sbu" name="sbu" class="form-select" required>
                                            <option value="N/A" data-id="N/A" selected disabled>Choose...</option>
                                            <?php foreach ($sbuResult as $sbuRow) { ?>
                                                <option value="<?php echo $sbuRow['category_name']; ?>" data-id="<?php echo $sbuRow['id']; ?>"><?php echo $sbuRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Account Executive -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountExecutive" class="form-label">Account Executive<span class="req">*</span></label>
                                        <div id="accountExecutiveContainer"></div>
                                    </div>

                                    <!-- Date of Activity -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="callDate" class="form-label">Date of Activity <span class="req">*</span></label>
                                        <input type="date" class="form-control" id="callDate" required name="callDate" min="<?php echo $min; ?>" max="<?php echo $max; ?>" />
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                       <label for="team" class="form-label">Branch <span class="req">*</span></label>
                                        <select name="team" class="form-control form-select" id="team" required>
                                            <option value="" disabled selected>-- Select Branch --</option>
                                            <option value="MM">MM</option>
                                            <option value="ANG">ANG</option>
                                            <option value="CAB">CAB</option>
                                            <option value="LAU">LAU</option>
                                            <option value="BAT">BAT</option>
                                            <option value="NAG">NAG</option>
                                            <option value="SUB">SUB</option>
                                            <option value="BAC">BAC</option>
                                            <option value="CEB">CEB</option>
                                            <option value="DUM">DUM</option>
                                            <option value="ILO">ILO</option>
                                            <option value="TAC">TAC</option>
                                            <option value="CDO">CDO</option>
                                            <option value="DAV">DAV</option>
                                            <option value="GEN">GEN</option>
                                            <option value="ZAM">ZAM</option>
                                        </select> 
                                        <!-- these are branches options but I just reuse the team columns and id for easy storage, disregard the naming  -->
                                    </div>

                                </div>
                            </div>

                            <hr class="text-secondary my-4">

                            <!-- Segment 2: Client Information -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Client Information</h5>
                                <div class="row g-3">
                                    <!-- Customer ID -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="customerId" class="form-label">Customer ID</label>
                                        <input type="text" class="form-control" id="customerId" name="customerId" />
                                    </div>

                                    <!-- Account Name -->
                                    <div class="col-md-6 col-lg-4 col-xl-3 position-relative">
                                        <label for="accountName" class="form-label">Account Name <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="accountName" required name="accountName" onchange="searchAccounts(this.value)" autocomplete="off"/>
                                        <ul id="accountList" class="account-list"></ul>
                                    </div>

                                    <!-- ARS Expiry Date -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="arsExpiryDate" class="form-label">ARS Expiry Date<span class="req">*</span></label>
                                        <input type="date" class="form-control" id="arsExpiryDate" name="arsExpiryDate" min="<?php echo $min_expiry; ?>"/>
                                    </div>

                                    <!-- Account Category -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountCategory" class="form-label">Account Category <span class="req">*</span></label>
                                        <select id="accountCategory" name="accountCategory" class="form-select" required>
                                            <option value="N/A" selected disabled>Choose...</option>
                                            <?php foreach ($accountCategoryResult as $accountCategoryRow) { ?>
                                                <option value="<?php echo $accountCategoryRow['category_name']; ?>"><?php echo $accountCategoryRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Existing System (conditionally displayed) -->
                                    <div class="col-md-6 col-lg-4 col-xl-3" id="existingSystemContainer" style="display: none;">
                                        <label for="existingSystem" class="form-label">Existing System</label>
                                        <select id="existingSystem" name="existingSystem" class="form-select">
                                            <option value="N/A" selected disabled>Choose...</option>
                                            <?php foreach ($existingSystemResult as $existingSystemRow) { ?>
                                                <option value="<?php echo $existingSystemRow['category_name']; ?>"><?php echo $existingSystemRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- End of Contract (For Competitor) (conditionally displayed) -->
                                    <div class="col-md-6 col-lg-4 col-xl-3" id="contractEndCompetitorContainer" style="display: none;">
                                        <label for="contractEndCompetitor" class="form-label">End of Contract (For Competitor)</label>
                                        <input type="date" class="form-control" id="contractEndCompetitor" name="contractEndCompetitor" min="<?php echo $min_expiry; ?>" />
                                    </div>

                                    <!-- Type of End-User -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="endUserType" class="form-label">Type of End-User <span class="req">*</span></label>
                                        <select id="endUserType" name="endUserType" class="form-select" required>
                                            <option value="N/A" selected disabled>Choose...</option>
                                            <?php foreach ($endUserTypeResult as $endUserTypeRow) { ?>
                                                <option value="<?php echo $endUserTypeRow['category_name']; ?>"><?php echo $endUserTypeRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Industry -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="segment" class="form-label">Industry <span class="req">*</span></label>
                                        <select id="segment" name="segment" class="form-select" required>
                                            <option value="N/A" selected disabled>Choose...</option>
                                            <?php foreach ($segmentResult as $segmentRow) { ?>
                                                <option value="<?php echo $segmentRow['id']; ?>"><?php echo $segmentRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Industry Subcategory -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="industrySubcategory" class="form-label">Industry Subcategory</label>
                                        <select id="industrySubcategory" name="industrySubcategory" class="form-select">
                                            <option value="N/A" selected disabled>Choose...</option>
                                        </select>
                                    </div>

                                    <!-- Source of Account -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountSource" class="form-label">Lead Source<span class="req">*</span></label>
                                        <select id="accountSource" name="accountSource" class="form-select" required>
                                            <option value="N/A" selected disabled>Choose...</option>
                                            <?php while ($accountSourceRow = mysqli_fetch_assoc($accountSourceResult)) { ?>
                                                <option value="<?php echo $accountSourceRow['id']; ?>"><?php echo $accountSourceRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Source of Account Subcategory -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountSourceCategory" class="form-label">Lead Subcategory</label>
                                        <select id="accountSourceCategory" name="accountSourceCategory" class="form-select" disabled>
                                            <option value="N/A" selected disabled>Choose...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="text-secondary my-4">

                            <!-- Segment 3: Client Location Details -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Client Location Details</h5>
                                
                                <!-- Top Row: Branch and Region -->
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label for="branch1" class="form-label">Branch <span class="req">*</span></label>
                                        <select name="branch1" class="form-control form-select" id="branch1" required>
                                            <option value="" disabled selected>-- Select Branch --</option>
                                            <option value="MM">MM</option>
                                            <option value="ANG">ANG</option>
                                            <option value="CAB">CAB</option>
                                            <option value="LAU">LAU</option>
                                            <option value="BAT">BAT</option>
                                            <option value="NAG">NAG</option>
                                            <option value="SUB">SUB</option>
                                            <option value="BAC">BAC</option>
                                            <option value="CEB">CEB</option>
                                            <option value="DUM">DUM</option>
                                            <option value="ILO">ILO</option>
                                            <option value="TAC">TAC</option>
                                            <option value="CDO">CDO</option>
                                            <option value="DAV">DAV</option>
                                            <option value="GEN">GEN</option>
                                            <option value="ZAM">ZAM</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="region1" class="form-label">Region <span class="req">*</span></label>
                                        <select name="region1" class="form-control form-select" id="region1" required>
                                            <option value="" disabled selected>-- Select Region --</option>
                                            <option value="MM">MM</option>
                                            <option value="LUZON">LUZON</option>
                                            <option value="VISAYAS">VISAYAS</option>
                                            <option value="MINDANAO">MINDANAO</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Bottom Row: Address (Separate Line) -->
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="address" class="form-label">Address <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter full street address" required/>
                                    </div>
                                </div>
                            </div>

                            <hr class="text-secondary my-4">

                            <!-- Segment 4: Contact Information Section -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Contact Information</h5>
                                
                                <!-- Container for dynamic contact rows -->
                                <div id="contactEntries" class="mb-3">
                                    <div class="row contact-entry g-3 mb-3 align-items-end">
                                        <div class="col-md-6 col-lg-3">
                                            <label class="form-label">Contact Person <span class="req">*</span></label>
                                            <input type="text" class="form-control" name="contactPerson[]" required />
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <label class="form-label">Contact Person Designation <span class="req">*</span></label>
                                            <input type="text" class="form-control" name="designation[]" required />
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <label class="form-label">Contact Details <span class="req">*</span></label>
                                            <input type="text" class="form-control" name="contactNumber[]" required />
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <label class="form-label">Email Address <span class="req">*</span></label>
                                            <input type="email" class="form-control" name="emailAddress[]" required />
                                        </div>
                                        <div class="col-12 text-end contact-remove-container" style="display: none;">
                                            <button type="button" class="btn btn-danger btn-sm remove-contact"><i class="fa fa-trash"></i> Remove Contact</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-outline-primary btn-sm" id="addContactEntry">Add Another Contact</button>
                                    </div>
                                </div>

                            </div>

                            <hr class="text-secondary my-4">

                            <!-- Segment 5: Project Details -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Project Details</h5>
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="projTitle" class="form-label">Company Name / Project Title <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="projTitle" name="projTitle" required/>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="proposedPrice" class="form-label">Proposed Price </label>
                                        <input type="number" class="form-control" id="proposedPrice" name="proposedPrice" step="0.01"/>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label class="form-label d-block">VAT <span class="req">*</span></label>
                                        <div class="btn-group w-100" role="group" aria-label="VAT Type">
                                            <input type="radio" class="btn-check" name="vatType" id="vatInclusive" value="Inclusive" required>
                                            <label class="btn btn-outline-secondary text-dark" for="vatInclusive">Inclusive</label>
                                            
                                            <input type="radio" class="btn-check" name="vatType" id="vatExclusive" value="Exclusive" required>
                                            <label class="btn btn-outline-secondary text-dark" for="vatExclusive">Exclusive</label>
                                        </div>
                                        <style>
                                            .btn-check:checked + .btn-outline-secondary {
                                                background-color: #059669 !important;
                                                color: white !important;
                                                border-color: #059669 !important;
                                            }
                                        </style>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="paymentTerms" class="form-label">Terms of Payment <span class="req">*</span></label>
                                        <select id="paymentTerms" name="paymentTerms" class="form-select" required>
                                            <option value="N/A" selected disabled>Choose...</option>
                                            <?php foreach ($paymentTermsResult as $paymentTermsRow) { ?>
                                                <option value="<?php echo $paymentTermsRow['category_name']; ?>"><?php echo $paymentTermsRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="contractType" class="form-label">Contract Type <span class="req">*</span></label>
                                        <select id="contractType" name="contractType" class="form-select" required>
                                            <option value="N/A" selected disabled>Choose...</option>
                                            <?php foreach ($contractTypeResult as $contractTypeRow) { ?>
                                                <option value="<?php echo $contractTypeRow['category_name']; ?>"><?php echo $contractTypeRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                  
                                    <div class="col-lg-8 col-xl-6">
                                        <label for="projectAddress" class="form-label">Project Address <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="projectAddress" name="projectAddress" required/>
                                    </div>
                                </div>
                            </div>

                            <hr class="text-secondary my-4">
                                <div class="card p-4 shadow-sm mb-4" id="machinePricingCard" style="display: none;">
                                    <h5 class="text-secondary fw-semibold mb-3">Machine Product and Pricing Information</h5>
                                    <div id="productEntries">
                                        <div class="row product-entry g-3 mb-3 align-items-end">
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <label class="form-label">Product Type <span class="req">*</span></label>
                                                <select name="productType[]" class="form-select productType" required>
                                                    <option value="N/A" selected disabled>Choose...</option>
                                                    <?php 
                                                    mysqli_data_seek($machineProductTypeResult, 0);
                                                    while ($productTypeRow = mysqli_fetch_assoc($machineProductTypeResult)) { ?>
                                                        <option value="<?php echo $productTypeRow['id']; ?>"><?php echo $productTypeRow['category_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <label class="form-label">Model</label>
                                                <select name="productTypeSubcategory[]" class="form-select productTypeSubcategory" disabled>
                                                    <option value="N/A" selected disabled>Choose...</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <label class="form-label">Quantity <span class="req">*</span></label>
                                                <input type="number" class="form-control" name="quantity[]" min="1" required />
                                            </div>

                                            <div class="col-lg-3 col-md-6 col-6">
                                                <label class="form-label">Unit Price <span class="req">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="number" class="form-control" name="productAmount[]" step="0.01" required />
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-1 col-md-3 col-12">
                                                <button type="button" class="btn btn-outline-danger remove-entry w-100" title="Remove Product Row">
                                                    <i class="fa fa-trash-alt d-lg-none me-1"></i><span class="d-none d-lg-inline">Remove</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                        <button type="button" class="btn btn-outline-primary btn-sm" id="addProductEntry">
                                            <i class="fa fa-plus me-1"></i> Add Another Product
                                        </button>
                                        <div class="text-end">
                                            <strong>Total Qty:</strong> <span id="machineTotalQty">0</span> &nbsp;&nbsp;&nbsp;
                                            <strong>Total Amount:</strong> ₱<span id="machineTotalAmount">0.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card p-4 shadow-sm mb-4" id="consumablesPricingCard" style="display: none;">
                                    <h5 class="text-secondary fw-semibold mb-3">Consumables Product and Pricing Information</h5>
                                    <div id="consumableEntries">
                                        <div class="row product-entry g-3 mb-3 align-items-end">
                                            <div class="col-lg-1 col-md-3 col-12">
                                                <label class="form-label">Product Type <span class="req">*</span></label>
                                                <select name="consumableType[]" class="form-select productType" required>
                                                    <option value="N/A" selected disabled>Choose...</option>
                                                    <?php 
                                                    // Reset pointer if variable needs to be re-looped or shared
                                                    mysqli_data_seek($consumablesProductTypeResult, 0);
                                                    while ($productTypeRow = mysqli_fetch_assoc($consumablesProductTypeResult)) { ?>
                                                        <option value="<?php echo $productTypeRow['id']; ?>"><?php echo $productTypeRow['category_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-1 col-md-3 col-12">
                                                <label class="form-label">Model</label>
                                                <select name="consumableModel[]" class="form-select productTypeSubcategory" disabled>
                                                    <option value="N/A" selected disabled>Choose...</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-2 col-md-6 col-12">
                                                <label class="form-label">Consumable <span class="req">*</span></label>
                                                <select name="consumable[]" class="form-select consumableName" required disabled>
                                                    <option value="N/A" selected disabled>Choose Model first...</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-4 col-md-12 col-12">
                                                <label class="form-label">Item Code <span class="req">*</span></label>
                                                <select name="consumableItemCode[]" class="form-select itemCode" required disabled>
                                                    <option value="N/A" selected disabled>Choose Consumable first...</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-1 col-md-3 col-6">
                                                <label class="form-label">Qty <span class="req">*</span></label>
                                                <input type="number" class="form-control" name="consumableQuantity[]" min="1" required />
                                            </div>
                                            
                                            <div class="col-lg-2 col-md-6 col-6">
                                                <label class="form-label">Unit Price <span class="req">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="number" class="form-control" name="consumableAmount[]" step="0.01" required />
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-1 col-md-3 col-12">
                                                <button type="button" class="btn btn-outline-danger remove-entry w-100" title="Remove Consumable Row">
                                                    <i class="fa fa-trash-alt d-lg-none me-1"></i><span class="d-none d-lg-inline">Remove</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                        <button type="button" class="btn btn-outline-primary btn-sm" id="addConsumableEntry">
                                            <i class="fa fa-plus me-1"></i> Add Another Consumable
                                        </button>
                                        <div class="text-end">
                                            <strong>Total Qty:</strong> <span id="consumableTotalQty">0</span> &nbsp;&nbsp;&nbsp;
                                            <strong>Total Amount:</strong> ₱<span id="consumableTotalAmount">0.00</span>
                                        </div>
                                    </div>
                                </div>
                            

                            <hr class="text-secondary my-4">

                            <!-- Segment 7: Progress Updates -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Progress Updates</h5>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="progressDate" class="form-label">Date of Progress</label>
                                        <input type="date" class="form-control" id="progressDate" name="progressDate" min="<?php echo $min_expiry; ?>"/>
                                    </div>
                                  
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountStatus" class="form-label">Account Status <span class="req">*</span></label>
                                        <select id="accountStatus" name="accountStatus" class="form-select" required>
                                            <option value="N/A" selected disabled>Choose...</option>
                                            <?php foreach ($accountstatusResult as $accountstatusRow) { ?>
                                                <option value="<?php echo $accountstatusRow['id']; ?>"><?php echo $accountstatusRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="reasonSubcategory" class="form-label">Reason Subcategory</label>
                                        <select id="reasonSubcategory" name="reasonSubcategory" class="form-select" disabled>
                                            <option value="N/A" selected disabled>Choose...</option>
                                        </select>
                                    </div>
                                   
                                    <div class="col-md-12 col-xl-6">
                                        <label for="remarks" class="form-label">Remarks <span class="req">*</span></label>
                                        <textarea class="form-control" id="remarks" name="remarks" rows="2" required></textarea>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="estimatedDelivery" class="form-label">Estimated Delivery</label>
                                        <select id="estimatedDelivery" name="estimatedDelivery" class="form-select">
                                            <option value="" selected disabled>Choose Month...</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <!-- Conditional Elements -->
                                    <div class="col-md-6 col-lg-4 col-xl-3" id="deliveryDateContainer" style="display: none;">
                                        <label for="deliveryDate" class="form-label">Delivery Date</label>
                                        <input type="date" class="form-control" id="deliveryDate" name="deliveryDate" min="<?php echo $min_expiry; ?>" />
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3" id="contractEndContainer" style="display: none;">
                                        <label for="contractEnd" class="form-label">Contract End</label>
                                        <input type="date" class="form-control" id="contractEnd" name="contractEnd" min="<?php echo $min_expiry; ?>" />
                                    </div>
                                </div>
                            </div>

                            <!-- Form Action Button -->
                            <div class="col-12 mt-4 mb-5 text-end">
                                <button name="encodeAccount" id="encodeAccount" type="submit" class="btn btn-primary px-5 btn-lg shadow-sm">Submit Form</button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>

        <script>
            var userCategory = '<?php echo $category; ?>';
            var userName = '<?php echo $name; ?>';
            var userArrayManager = <?php echo $userArrayManagerJson; ?>;
            var userArrayAdmin = <?php echo $userArrayAdminJson; ?>;
            var category = "<?php echo $category; ?>";
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="../js/toggleDateFields.js"></script>
        <script src="../js/handleIndustryChange.js"></script>
        <script src="../js/handleAccountSourceChange.js"></script>
        <script src="../js/calculateTotals.js"></script>
        <script>
            $(document).ready(function () {
                function toggleInputs(containerId, enable) {
                    $(containerId).find('input, select, textarea').each(function() {
                        if (enable) {
                            $(this).prop('disabled', false);
                            if ($(this).hasClass('productTypeSubcategory') || $(this).hasClass('itemCode')) {
                                var parent = $(this).closest('.product-entry');
                                var typeVal = parent.find('.productType').val() || parent.find('.deviceCondition').val();
                                if (!typeVal || typeVal === 'N/A') {
                                    $(this).prop('disabled', true);
                                }
                            }
                        } else {
                            $(this).prop('disabled', true);
                        }
                    });
                }

                function checkSBU() {
                    var sbuVal = $('#sbu').val();
                    var sbuId = $('#sbu').find('option:selected').attr('data-id');
                    
                    if (!sbuVal || sbuVal === 'N/A') {
                        $('#machinePricingCard').hide();
                        $('#consumablesPricingCard').hide();
                        toggleInputs('#machinePricingCard', false);
                        toggleInputs('#consumablesPricingCard', false);
                        return;
                    }
                    
                    if (sbuId == '339' || sbuId == '340' || sbuId == '341') {
                        $('#machinePricingCard').show();
                        $('#consumablesPricingCard').hide();
                        toggleInputs('#machinePricingCard', true);
                        toggleInputs('#consumablesPricingCard', false);
                    } else if (sbuId == '342' || sbuId == '343') {
                        $('#machinePricingCard').hide();
                        $('#consumablesPricingCard').show();
                        toggleInputs('#machinePricingCard', false);
                        toggleInputs('#consumablesPricingCard', true);
                    } else {
                        $('#machinePricingCard').hide();
                        $('#consumablesPricingCard').hide();
                        toggleInputs('#machinePricingCard', false);
                        toggleInputs('#consumablesPricingCard', false);
                    }
                }

                // Initial run on page load
                checkSBU();

                // Trigger on change of SBU dropdown
                $('#sbu').on('change', function () {
                    checkSBU();
                });

                // Item Code cascade is now handled by handleConsumableChange.js

                // Add a new product entry
                $('#addProductEntry').on('click', function () {
                    let newEntry = $('#productEntries .product-entry').first().clone();
                    
                    newEntry.find('input, select').each(function() {
                        if ($(this).is('select')) {
                            $(this).prop('selectedIndex', 0);
                            if ($(this).hasClass('productTypeSubcategory')) {
                                $(this).prop('disabled', true).html('<option value="N/A" selected disabled>Choose...</option>');
                            }
                        } else {
                            $(this).val('');
                        }
                    });
                    
                    $('#productEntries').append(newEntry);
                });

                // Remove a product entry
                $('#productEntries').on('click', '.remove-entry', function () {
                    if ($('#productEntries .product-entry').length > 1) {
                        $(this).closest('.product-entry').remove();
                    } else {
                        alert("At least one product entry is required.");
                    }
                });

                // Add a new consumable entry
                $('#addConsumableEntry').on('click', function () {
                    let newEntry = $('#consumableEntries .product-entry').first().clone();
                    
                    newEntry.find('input, select').each(function() {
                        if ($(this).is('select')) {
                            $(this).prop('selectedIndex', 0);
                            if ($(this).hasClass('productTypeSubcategory') || $(this).hasClass('itemCode')) {
                                $(this).prop('disabled', true).html('<option value="N/A" selected disabled>Choose...</option>');
                            }
                        } else {
                            $(this).val('');
                        }
                    });
                    
                    $('#consumableEntries').append(newEntry);
                });

                // Remove a consumable entry
                $('#consumableEntries').on('click', '.remove-entry', function () {
                    if ($('#consumableEntries .product-entry').length > 1) {
                        $(this).closest('.product-entry').remove();
                    } else {
                        alert("At least one consumable entry is required.");
                    }
                });
            });
        </script>
        <script src="../js/addContacts.js"></script>
        <script src="../js/handleAccountCategoryChange.js"></script>
        <script src="../js/handleProductTypeChange.js"></script>
        <script src="../js/handleConsumableChange.js"></script>
        <script src="../js/handleAccountStatusChange.js"></script>
        <script src="../js/encodeAutofill.js"></script>
        <script src="../js/encode/prefillForm.js"></script>
        <script src="../js/hideElement.js"></script>
        <script type="text/javascript" src="../js/accExec.js"></script>
        <script type="text/javascript" src="../js/autoFill.js"></script>
        <script src="../js/ph-address-selector.js"></script>
        <script src="../js/handleBranchToRegion.js"></script>
    </body>
</html>