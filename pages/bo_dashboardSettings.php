<?php
include('../php/autoRedirect.php');
include('../php/accountList.php');
include('../php/db_conn.php');

$statusMessageHtml = "";

// 🎯 Handle Form Submissions securely using prepared statements
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Processing Panel Action 1: KPI Sales Target Limit Meter
    if (isset($_POST['target_km_machine']) && isset($_POST['target_riso_machine']) && isset($_POST['target_km_cons']) && isset($_POST['target_riso_cons'])) {
        $targets = [
            'kpi_target_km_machine' => floatval($_POST['target_km_machine']),
            'kpi_target_riso_machine' => floatval($_POST['target_riso_machine']),
            'kpi_target_km_cons' => floatval($_POST['target_km_cons']),
            'kpi_target_riso_cons' => floatval($_POST['target_riso_cons'])
        ];
        
        $allSuccess = true;
        foreach ($targets as $key => $val) {
            if ($val > 0) {
                $updateQuery = "INSERT INTO dashboard_settings (setting_key, setting_value) 
                                VALUES (?, ?)
                                ON DUPLICATE KEY UPDATE setting_value = ?";
                $stmt = mysqli_prepare($conn, $updateQuery);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $key, $val, $val);
                    if (!mysqli_stmt_execute($stmt)) {
                        $allSuccess = false;
                    }
                    mysqli_stmt_close($stmt);
                }
            } else {
                $allSuccess = false;
            }
        }
        
        if ($allSuccess) {
            $statusMessageHtml = '
                <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>Sales target configuration metrics saved successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } else {
            $statusMessageHtml = '<div class="alert alert-danger">Error writing target values or values must be greater than zero.</div>';
        }
    }
    
    // Processing Panel Action 2: Critical Aging Stagnation Target Threshold Limit
    if (isset($_POST['aging_days_threshold'])) {
        $agingDays = intval($_POST['aging_days_threshold']);
        if ($agingDays >= 1) {
            $updateQuery = "INSERT INTO dashboard_settings (setting_key, setting_value) 
                            VALUES ('aging_days_threshold', ?)
                            ON DUPLICATE KEY UPDATE setting_value = ?";
            
            $stmt = mysqli_prepare($conn, $updateQuery);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $agingDays, $agingDays);
                if (mysqli_stmt_execute($stmt)) {
                    $statusMessageHtml = '
                        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>Stagnation day aging rules saved successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } else {
                    $statusMessageHtml = '<div class="alert alert-danger">Error writing aging values: ' . mysqli_error($conn) . '</div>';
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            $statusMessageHtml = '<div class="alert alert-warning">Stagnation limit rules require at least 1 day.</div>';
        }
    }
}

// 🎯 Fetch current live configurations safely from the database to pre-populate input cells
$targetKmMachine = 5000000.00; // System baseline fallback limit
$targetRisoMachine = 5000000.00;
$targetKmCons = 5000000.00;
$targetRisoCons = 5000000.00;
$agingDaysThreshold = 60;         // Stagnation baseline fallback rule index

$settingsQuery = "SELECT setting_key, setting_value FROM dashboard_settings WHERE setting_key IN ('kpi_target_km_machine', 'kpi_target_riso_machine', 'kpi_target_km_cons', 'kpi_target_riso_cons', 'aging_days_threshold')";
$settingsResult = mysqli_query($conn, $settingsQuery);

if ($settingsResult) {
    while ($row = mysqli_fetch_assoc($settingsResult)) {
        if ($row['setting_key'] === 'kpi_target_km_machine') {
            $targetKmMachine = floatval($row['setting_value']);
        } elseif ($row['setting_key'] === 'kpi_target_riso_machine') {
            $targetRisoMachine = floatval($row['setting_value']);
        } elseif ($row['setting_key'] === 'kpi_target_km_cons') {
            $targetKmCons = floatval($row['setting_value']);
        } elseif ($row['setting_key'] === 'kpi_target_riso_cons') {
            $targetRisoCons = floatval($row['setting_value']);
        } elseif ($row['setting_key'] === 'aging_days_threshold') {
            $agingDaysThreshold = intval($row['setting_value']);
        }
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-DSR Dashboard Settings — Adjust platform configuration, panel parameters, and target goals.">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Theme & App CSS -->
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    
    <title>Dashboard Settings — E-DSR</title>
    
    <style>
        body {
            font-family: 'Inter', sans-serif !important;
        }
        .main-content-card {
            background: var(--surface);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            min-height: 250px; 
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }
        .border-dashed {
            border-style: dashed !important;
            background-color: var(--surface-muted, #f8f9fa) !important;
            justify-content: center !important;
            align-items: center !important;
            color: var(--text-secondary, #6c757d) !important;
        }
        .hr-muted {
            border-color: var(--border-color) !important;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container-fluid py-4">
        <div class="row">
            <main class="col-12 col-xl-11 mx-auto">
                
                <!-- Section 1: Page Header & Action Controls -->
                <div class="d-flex justify-content-between align-items-center pb-4 mb-4 border-bottom flex-wrap gap-3">
                    <div>
                        <h3 class="m-0 fw-bold tracking-tight text-dark">BO Dashboard Configurations</h3>
                        <p class="text-muted small m-0 mt-1">Modify panel operational limits in place. Cards match the main layout placement grid.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="bo_dashboard.php" class="btn btn-light border border-secondary-subtle px-3 fw-medium d-flex align-items-center gap-2 shadow-sm rounded-3">
                            <i class="fa fa-arrow-left text-secondary"></i> Back to Dashboard
                        </a>
                    </div>
                </div>

                <!-- Alert Feedback Target Wrapper -->
                <div id="settingsAlertPlaceholder" class="mb-3">
                    <?php echo $statusMessageHtml; ?>
                </div>

                <!-- Section 2: Settings Controls Grid Layout Matrix -->
                <div class="row g-4">
                    
                    <!-- KPI Sales Target Parameter Configuration -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="main-content-card p-4 shadow-sm text-start">
                            <div class="w-100 mb-3">
                                <h6 class="text-uppercase text-primary tracking-wider fw-bold small m-0">
                                    <i class="fa-solid fa-sliders me-2"></i>Cell 1: KPI Sales Meter
                                </h6>
                                <hr class="my-2 hr-muted">
                            </div>
                            
                            <form id="kpiSalesTargetForm" method="POST" action="" class="w-100 d-flex flex-column h-100 justify-content-between">
                                <div class="mb-3 flex-grow-1 d-flex flex-column gap-2">
                                    <div>
                                        <label for="kmMachineInput" class="form-label small fw-bold text-secondary text-uppercase mb-1" style="font-size:0.68rem;">KM Machine (₱)</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light fw-bold text-secondary">₱</span>
                                            <input type="number" step="0.01" min="1" class="form-control fw-bold target-input" id="kmMachineInput" name="target_km_machine" value="<?php echo $targetKmMachine; ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="risoMachineInput" class="form-label small fw-bold text-secondary text-uppercase mb-1" style="font-size:0.68rem;">Riso Machine (₱)</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light fw-bold text-secondary">₱</span>
                                            <input type="number" step="0.01" min="1" class="form-control fw-bold target-input" id="risoMachineInput" name="target_riso_machine" value="<?php echo $targetRisoMachine; ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="kmConsInput" class="form-label small fw-bold text-secondary text-uppercase mb-1" style="font-size:0.68rem;">KM Cons. (₱)</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light fw-bold text-secondary">₱</span>
                                            <input type="number" step="0.01" min="1" class="form-control fw-bold target-input" id="kmConsInput" name="target_km_cons" value="<?php echo $targetKmCons; ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="risoConsInput" class="form-label small fw-bold text-secondary text-uppercase mb-1" style="font-size:0.68rem;">Riso Cons. (₱)</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light fw-bold text-secondary">₱</span>
                                            <input type="number" step="0.01" min="1" class="form-control fw-bold target-input" id="risoConsInput" name="target_riso_cons" value="<?php echo $targetRisoCons; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 rounded-3 fw-semibold py-2 mt-2 shadow-sm">
                                    <i class="fa fa-save me-2"></i>Save Targets
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Layout Placeholders matching original UI matrix rules -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="main-content-card p-4 shadow-sm text-center border-dashed">
                            <span class="small font-monospace opacity-75">Cell 2 Settings Placeholder</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="main-content-card p-4 shadow-sm text-center border-dashed">
                            <span class="small font-monospace opacity-75">Cell 3 Settings Placeholder</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="main-content-card p-4 shadow-sm text-center border-dashed">
                            <span class="small font-monospace opacity-75">Cell 4 Settings Placeholder</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="main-content-card p-4 shadow-sm text-center border-dashed">
                            <span class="small font-monospace opacity-75">Cell 5 Settings Placeholder</span>
                        </div>
                    </div>

                    <!-- Critical Data Aging Alert Trigger Configuration -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="main-content-card p-4 shadow-sm text-start">
                            <div class="w-100 mb-3">
                                <h6 class="text-uppercase text-danger tracking-wider fw-bold small m-0">
                                    <i class="fa-solid fa-clock-history me-2"></i>Cell 6: Aging Stagnation Alert
                                </h6>
                                <hr class="my-2 hr-muted">
                            </div>
                            
                            <form id="agingStagnationConfigForm" method="POST" action="" class="w-100 d-flex flex-column h-100 justify-content-between">
                                <div class="mb-3 flex-grow-1">
                                    <label for="agingDaysInput" class="form-label small fw-bold text-secondary text-uppercase" style="font-size:0.68rem;">Stagnation Rule Threshold (Days)</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text bg-light text-secondary"><i class="fa-solid fa-calendar-day"></i></span>
                                        <input type="number" min="1" class="form-control fw-bold" id="agingDaysInput" name="aging_days_threshold" value="<?php echo $agingDaysThreshold; ?>" required>
                                    </div>
                                    <div class="form-text text-muted" style="font-size: 0.7rem;">
                                        Records with no changes for this many days will flag on the live summary dashboard tracking index row view.
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-danger w-100 rounded-3 fw-semibold py-2 mt-2 shadow-sm">
                                    <i class="fa fa-save me-2"></i>Save Aging Threshold
                                </button>
                            </form>
                        </div>
                    </div>

                </div> 
            </main>
        </div>
    </div>

    <!-- Script assets declaration structure modules -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        // Formatter function to show dynamic shorthand preview inside field forms
        function formatToShorthand(value) {
            const num = parseFloat(value);
            if (isNaN(num) || num <= 0) return "--";
            if (num >= 1000000) {
                return (num / 1000000).toFixed(num % 1000000 === 0 ? 0 : 1) + 'M';
            }
            if (num >= 1000) {
                return (num / 1000).toFixed(num % 1000 === 0 ? 0 : 1) + 'K';
            }
            return num.toString();
        }

        $(document).ready(function() {
            // No shorthand preview needed for the 4 compact fields, keeping JS clean.
        });
    </script>
</body>
</html>