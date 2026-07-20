<?php
    include ('../php/uploadFile.php');
    include ('../php/autoRedirect.php');
    include ('../php/dates.php');
    include ('../php/userList.php');
    include ('../php/categoryList.php');
    include ('../php/subcategoryList.php');
    
    // Capture the database file output cleanly to prevent raw JSON text from spilling onto the screen
    ob_start();
    include ('../php/fetchDataEditEncode.php');
    $captured_output = ob_get_clean();

    // Parse the captured JSON string data cleanly into our $row variable array
    if (!isset($row) || empty($row)) {
        $decoded_json = json_decode($captured_output, true);
        if (isset($decoded_json['success']) && $decoded_json['success'] && isset($decoded_json['data'])) {
            $row = $decoded_json['data'];
        }
    }

    // Capture the current target ID for matching history records
    $encodedMasterId = $row['id'] ?? $_GET['id'] ?? NULL;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="E-DSR Edit Encode Account — Admin layout to alter account records, timeline progress logs, and track history.">
    <title>Edit Encode Account — E-DSR</title>

    <script>
    (function(){
        var t = localStorage.getItem('edsr-theme') || 'light';
        document.documentElement.setAttribute('data-theme', t);
        document.documentElement.setAttribute('data-bs-theme', t);
        window.EDSR_THEME = t;
    })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/theme.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/sidebar.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/encode.css" />

    <style>
        .req {
            color: #dc3545;
            margin-left: 3px;
            font-weight: bold;
        }
        .account-list {
            position: absolute;
            z-index: 1000;
            background: var(--surface);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            padding-left: 0;
            list-style: none;
            margin-top: 2px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        /* ── Disabled field visual state ─────────────────────────────────────── */
        .form-control:disabled,
        .form-select:disabled,
        textarea.form-control:disabled,
        input[type="date"]:disabled,
        input[type="number"]:disabled,
        input[type="text"]:disabled {
            background-color: #e9ecef !important;
            color: #6c757d !important;
            border-color: #dee2e6 !important;
            opacity: 1 !important;
            cursor: not-allowed !important;
        }

        /* Dark-theme override */
        [data-theme="dark"] .form-control:disabled,
        [data-theme="dark"] .form-select:disabled,
        [data-theme="dark"] textarea.form-control:disabled,
        [data-theme="dark"] input[type="date"]:disabled,
        [data-theme="dark"] input[type="number"]:disabled,
        [data-theme="dark"] input[type="text"]:disabled {
            background-color: #2a2d31 !important;
            color: #6c757d !important;
            border-color: #495057 !important;
        }

        /* Input-group addon aligned with a disabled input */
        .input-group .form-control:disabled ~ .input-group-text,
        .input-group-text:has(~ .form-control:disabled) {
            background-color: #e9ecef !important;
            border-color: #dee2e6 !important;
            color: #6c757d !important;
        }
    </style>

    <script src="../js/hideElement.js" defer></script>
</head>
<body>
    <?php include ('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col-12 col-md-10 mx-auto px-4">
                
                <div class="d-flex justify-content-between align-items-center py-3 border-bottom mb-4 flex-wrap gap-3">
                    <div>
                        <h3 class="m-0 fw-bold" style="color:var(--text-primary);">LID: 
                            <span class="text-primary"><?php echo htmlspecialchars($row['LID'] ?? 'N/A'); ?></span>
                        </h3>
                        <p class="text-muted small m-0 mt-1">Review operational logs, alter core parameters, and handle master database metrics.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="bo_search.php" class="btn btn-light border border-secondary-subtle px-3 fw-medium d-flex align-items-center gap-2 shadow-sm rounded-3">
                            <i class="fa-solid fa-arrow-left text-secondary"></i> Back to Search
                        </a>
                        <?php if (isset($row['sbu']) && ($row['sbu'] === 'OP - Consumables' || $row['sbu'] == 343)): ?>
                        <a href="../php/generateQuotation.php?id=<?php echo urlencode($encodedMasterId); ?>" target="_blank" class="btn btn-primary px-3 fw-medium d-flex align-items-center gap-2 shadow-sm rounded-3">
                            <i class="fa-solid fa-print"></i> Print Quotation
                        </a>
                        <?php endif; ?>
                        <button type="button" onclick="verifyAdminPassword()" class="btn btn-danger px-3 fw-medium d-flex align-items-center gap-2 shadow-sm rounded-3">
                            <i class="fa-solid fa-lock"></i> Admin: Save Full Account
                        </button>
                    </div>
                </div>
                
                <div class="row py-3">
                    <form id="editEncodeForm" action="../php/editEncodeAccount.php" method="POST">
                        <input type="hidden" name="editEncode" value="true">
                        <input type="hidden" name="encodeId" id="encodeId" value="<?php echo htmlspecialchars($row['id'] ?? ''); ?>">
                        <input type="hidden" name="is_admin_edit" id="isAdminEdit" value="false">

                        <script>
                            var id = new URLSearchParams(window.location.search).get('id');
                            var LID = new URLSearchParams(window.location.search).get('LID');
                            console.log("Edit Target Details:", id, LID);
                        </script>
                        
                        <?php include('partials/edit_pipeline_info.php'); ?>

                        <?php include('partials/edit_contact_details.php'); ?>

                        <?php include('partials/edit_project_details.php'); ?>

                        <?php include('partials/edit_machine_pricing.php'); ?>

                        <?php include('partials/edit_consumable_pricing.php'); ?>

                        <?php include('partials/edit_progress_updates.php'); ?>

                        <?php include('partials/edit_history_timeline.php'); ?>
                    </form> 
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/toggleDateFields.js"></script>
    <script src="../js/handleIndustryChange.js"></script>
    <script src="../js/handleAccountSourceChange.js"></script>
    <script src="../js/handleRegionChange.js"></script>
    <script src="../js/addProducts.js"></script>
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
    <script src="../js/calculateTotals.js"></script>

    <?php include('partials/edit_inline_scripts.php'); ?>
</body>
</html>