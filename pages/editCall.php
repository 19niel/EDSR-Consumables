<?php
    include ('../php/autoRedirect.php');
    include ('../php/dates.php');
    include ('../php/userList.php');
    include ('../php/categoryList.php');
    include ('../php/config.php');

    $callData = null;
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $query = "SELECT * FROM calls WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $callData = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Record not found.'); window.location.href='search_calls.php';</script>";
            exit;
        }
    } else {
        echo "<script>window.location.href='search_calls.php';</script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Edit Call — E-DSR Cons</title>

        <!-- Anti-flash -->
        <script>
        (function(){
            var t = localStorage.getItem('edsr-theme') || 'light';
            document.documentElement.setAttribute('data-theme', t);
            document.documentElement.setAttribute('data-bs-theme', t);
        })();
        </script>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
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
                            <h3 class="m-0 fw-bold" style="color:var(--text-primary);">Edit Call Account 
                                <?php if (!empty($callData['Call_ID'])) { ?>
                                    <span class="text-primary ms-2" style="font-size: 0.9em;">(<?php echo htmlspecialchars($callData['Call_ID']); ?>)</span>
                                <?php } ?>
                            </h3>
                            <p class="text-muted small m-0 mt-1">Update the daily call activity report.</p>
                        </div>
                    </div>
                    
                    <div class="row py-3">
                        <form id="editCallForm" action="../php/editCallAccount.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($callData['id']); ?>" />
                            <input type="hidden" name="is_log_only" id="is_log_only" value="false">
                            
                            <div class="card p-4 shadow-sm mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-secondary fw-semibold mb-0">Activity Information</h5>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="sbu" class="form-label">SBU <span class="req">*</span></label>
                                        <select id="sbu" name="sbu" class="form-select" required>
                                            <option value="" disabled>Choose...</option>
                                            <?php foreach ($sbuResult as $sbuRow) { 
                                                $selected = ($callData['sbu'] == $sbuRow['category_name']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $sbuRow['category_name']; ?>" <?php echo $selected; ?>><?php echo $sbuRow['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="natureOfCall" class="form-label">Nature of Call <span class="req">*</span></label>
                                        <select id="natureOfCall" name="natureOfCall" class="form-select" required>
                                            <option value="" disabled>Choose...</option>
                                            <option value="Courtesy Visit" <?php if($callData['natureOfCall'] == 'Courtesy Visit') echo 'selected'; ?>>Courtesy Visit</option>
                                            <option value="Message/Call" <?php if($callData['natureOfCall'] == 'Message/Call') echo 'selected'; ?>>Message/Call</option>
                                            <option value="Virtual Meeting" <?php if($callData['natureOfCall'] == 'Virtual Meeting') echo 'selected'; ?>>Virtual Meeting</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountExecutive" class="form-label">Account Executive <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="accountExecutive" name="accountExecutive" value="<?php echo htmlspecialchars($callData['accountExecutive']); ?>" readonly />
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="dateOfActivity" class="form-label">Date of Activity <span class="req">*</span></label>
                                        <input type="date" class="form-control" id="dateOfActivity" name="dateOfActivity" value="<?php echo htmlspecialchars($callData['dateOfActivity']); ?>" required />
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="activityBranch" class="form-label">Branch <span class="req">*</span></label>
                                        <select name="activityBranch" class="form-control form-select" id="activityBranch" required>
                                            <?php 
                                            $branches = ['MM','ANG','CAB','LAU','BAT','NAG','SUB','BAC','CEB','DUM','ILO','TAC','CDO','DAV','GEN','ZAM'];
                                            foreach($branches as $b) {
                                                $sel = ($callData['activityBranch'] == $b) ? 'selected' : '';
                                                echo "<option value='$b' $sel>$b</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="text-secondary my-4">

                            <!-- Segment 2: Client Information -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Client Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="customerId" class="form-label">Customer ID</label>
                                        <input type="text" class="form-control" id="customerId" name="customerId" value="<?php echo htmlspecialchars($callData['customerId']); ?>" />
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountName" class="form-label">Account Name <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="accountName" name="accountName" value="<?php echo htmlspecialchars($callData['accountName']); ?>" required />
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="clientBranch" class="form-label">Branch <span class="req">*</span></label>
                                        <select name="clientBranch" class="form-control form-select" id="clientBranch" required>
                                            <?php 
                                            foreach($branches as $b) {
                                                $sel = ($callData['clientBranch'] == $b) ? 'selected' : '';
                                                echo "<option value='$b' $sel>$b</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="region" class="form-label">Region <span class="req">*</span></label>
                                        <select name="region" class="form-control form-select" id="region" required>
                                            <?php 
                                            $regions = ['MM','LUZON','VISAYAS','MINDANAO'];
                                            foreach($regions as $r) {
                                                $sel = ($callData['region'] == $r) ? 'selected' : '';
                                                echo "<option value='$r' $sel>$r</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="address" class="form-label">Address <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($callData['address']); ?>" required />
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-3">
                                        <label for="contactPerson" class="form-label">Contact Person <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="contactPerson" name="contactPerson" value="<?php echo htmlspecialchars($callData['contactPerson']); ?>" required />
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-3">
                                        <label for="designation" class="form-label">Designation <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="designation" name="designation" value="<?php echo htmlspecialchars($callData['designation']); ?>" required />
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-3">
                                        <label for="contactDetails" class="form-label">Contact Details <span class="req">*</span></label>
                                        <input type="text" class="form-control" id="contactDetails" name="contactDetails" value="<?php echo htmlspecialchars($callData['contactDetails']); ?>" required />
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-3">
                                        <label for="emailAddress" class="form-label">Email Address <span class="req">*</span></label>
                                        <input type="email" class="form-control" id="emailAddress" name="emailAddress" value="<?php echo htmlspecialchars($callData['emailAddress']); ?>" required />
                                    </div>
                                </div>
                            </div>

                            <hr class="text-secondary my-4">

                            <!-- Segment 3: Progress Updates -->
                            <div class="card p-4 shadow-sm mb-4">
                                <h5 class="text-secondary fw-semibold mb-3">Progress Updates</h5>
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="dateOfProgress" class="form-label">Date of Progress <span class="req">*</span></label>
                                        <input type="date" class="form-control" id="dateOfProgress" name="dateOfProgress" value="<?php echo htmlspecialchars($callData['dateOfProgress']); ?>" required />
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <label for="accountsStatus" class="form-label">Accounts Status <span class="req">*</span></label>
                                        <select id="accountsStatus" name="accountsStatus" class="form-select" required>
                                            <option value="Pending" <?php if($callData['accountsStatus'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                            <option value="Closed" <?php if($callData['accountsStatus'] == 'Closed') echo 'selected'; ?>>Closed</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 col-xl-6">
                                        <label for="remarks" class="form-label">Remarks <span class="req">*</span></label>
                                        <textarea class="form-control" id="remarks" name="remarks" rows="2" required><?php echo htmlspecialchars($callData['remarks']); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <?php include('partials/edit_call_history_timeline.php'); ?>

                            <div class="col-12 mt-4 mb-5 d-flex justify-content-end gap-2">
                                <a href="search_calls.php" class="btn btn-light border px-4 shadow-sm fw-medium">Cancel</a>
                                <button type="button" onclick="submitLogOnly()" class="btn btn-success px-4 shadow-sm fw-medium">
                                    <i class="fa fa-file-signature me-1"></i> Save Log Entry Only
                                </button>
                                <button type="submit" name="editCall" class="btn btn-primary px-5 shadow-sm fw-medium">
                                    <i class="fa fa-floppy-disk me-1"></i> Save Master Updates
                                </button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            var category = "<?php echo $category; ?>";
        </script>
        <script src="../js/hideElement.js"></script>
        <script>
            function submitLogOnly() {
                document.getElementById('is_log_only').value = "true";
                
                // Remove required attributes from non-progress fields so form can submit
                var requiredElements = document.querySelectorAll('#editCallForm [required]');
                requiredElements.forEach(function(element) {
                    // If the element is not inside the Progress Updates segment, remove required
                    if (!element.closest('.card').innerHTML.includes('Progress Updates')) {
                        element.removeAttribute('required');
                    }
                });
                
                // Submit the form programmatically (this also bypasses the button name='editCall' requirement, 
                // so we must add a hidden input for it, or just let backend check $_POST)
                var form = document.getElementById('editCallForm');
                var hiddenEditCall = document.createElement('input');
                hiddenEditCall.type = 'hidden';
                hiddenEditCall.name = 'editCall';
                hiddenEditCall.value = 'true';
                form.appendChild(hiddenEditCall);
                
                form.submit();
            }
        </script>
    </body>
</html>
