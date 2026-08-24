<?php
    include ('../php/autoRedirect.php');
    include ('../php/dates.php');
    include ('../php/userList.php');
    include ('../php/categoryList.php');
    include ('../php/config.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="E-DSR — DSR Encoding Engine. Submit your daily call activity report.">
        <title>Call — E-DSR Cons</title>

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
    </head>
    <body>
        <?php include ('header.php'); ?>

        <div class="container-fluid">
            <div class="row">
                <main class="col-12 col-md-10 mx-auto px-4">
                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom mb-4">
                        <div>
                            <h3 class="m-0 fw-bold" style="color:var(--text-primary);">Call Account</h3>
                            <p class="text-muted small m-0 mt-1">Submit your daily call activity report.</p>
                        </div>
                    </div>
                    
                    <div class="row py-3">
                        <form action="../php/callAccount.php" method="POST">
                            
                            <!-- Segment 1: Activity Information -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Activity Information</h5>
                                <div class="row g-3">
                                    <!-- SBU -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="sbu" class="form-label">SBU <span class="req">*</span></label>
                                        <select id="sbu" name="sbu" class="form-select" required>
                                            <option value="" selected disabled>Choose...</option>
                                            <?php foreach ($sbuResult as $sbuRow) { ?>
                                                <option value="<?php echo $sbuRow['category_name']; ?>"><?php echo $sbuRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Nature of Call -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="natureOfCall" class="form-label">Nature of Call <span class="req">*</span></label>
                                        <select id="natureOfCall" name="natureOfCall" class="form-select" required>
                                            <option value="" selected disabled>Choose...</option>
                                            <option value="Courtesy Visit">Courtesy Visit</option>
                                            <option value="Message/Call">Message/Call</option>
                                            <option value="Virtual Meeting">Virtual Meeting</option>
                                        </select>
                                    </div>

                                    <!-- Account Executive -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountExecutive" class="form-label">Account Executive <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="accountExecutive" name="accountExecutive" value="<?php echo htmlspecialchars($name ?? ''); ?>" readonly />
                                    </div>

                                    <!-- Date of Activity -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="dateOfActivity" class="form-label">Date of Activity <span class="req">*</span></label>
                                        <input type="date" class="form-control" id="dateOfActivity" name="dateOfActivity" required />
                                    </div>

                                    <!-- Branch -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="activityBranch" class="form-label">Branch <span class="req">*</span></label>
                                        <select name="activityBranch" class="form-control form-select" id="activityBranch" required>
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
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountName" class="form-label">Account Name <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="accountName" name="accountName" required />
                                    </div>

                                    <!-- Branch -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="clientBranch" class="form-label">Branch <span class="req">*</span></label>
                                        <select name="clientBranch" class="form-control form-select" id="clientBranch" required>
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

                                    <!-- Region -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="region" class="form-label">Region <span class="req">*</span></label>
                                        <select name="region" class="form-control form-select" id="region" required>
                                            <option value="" disabled selected>-- Select Region --</option>
                                            <option value="MM">MM</option>
                                            <option value="LUZON">LUZON</option>
                                            <option value="VISAYAS">VISAYAS</option>
                                            <option value="MINDANAO">MINDANAO</option>
                                        </select>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-12">
                                        <label for="address" class="form-label">Address <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address" required />
                                    </div>
                                    
                                    <!-- Contact Person -->
                                    <div class="col-md-6 col-lg-3">
                                        <label for="contactPerson" class="form-label">Contact Person <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="contactPerson" name="contactPerson" required />
                                    </div>
                                    
                                    <!-- Contact Person Designation -->
                                    <div class="col-md-6 col-lg-3">
                                        <label for="designation" class="form-label">Contact Person Designation <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="designation" name="designation" required />
                                    </div>
                                    
                                    <!-- Contact Details -->
                                    <div class="col-md-6 col-lg-3">
                                        <label for="contactDetails" class="form-label">Contact Details <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="contactDetails" name="contactDetails" required />
                                    </div>
                                    
                                    <!-- Email Address -->
                                    <div class="col-md-6 col-lg-3">
                                        <label for="emailAddress" class="form-label">Email Address <span class="req">*</span></label>
                                        <input type="email" class="form-control" id="emailAddress" name="emailAddress" required />
                                    </div>
                                </div>
                            </div>

                            <hr class="text-secondary my-4">

                            <!-- Segment 3: Progress Updates -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Progress Updates</h5>
                                <div class="row g-3">
                                    <!-- Date of Progress -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="dateOfProgress" class="form-label">Date of Progress <span class="req">*</span></label>
                                        <input type="date" class="form-control" id="dateOfProgress" name="dateOfProgress" required />
                                    </div>

                                    <!-- Accounts Status -->
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountsStatus" class="form-label">Accounts Status <span class="req">*</span></label>
                                        <select id="accountsStatus" name="accountsStatus" class="form-select" required>
                                            <option value="" selected disabled>Choose...</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Closed">Closed</option>
                                        </select>
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-md-12 col-xl-6">
                                        <label for="remarks" class="form-label">Remarks <span class="req">*</span></label>
                                        <textarea class="form-control" id="remarks" name="remarks" rows="2" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Action Button -->
                            <div class="col-12 mt-4 mb-5 text-end">
                                <button type="submit" name="submitCall" class="btn btn-primary px-5 btn-lg shadow-sm">Submit Form</button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </body>
</html>
