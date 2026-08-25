<?php
include('../php/autoRedirect.php');
include('../php/callList.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-DSR Call Records — Filter and extract daily call activity data.">
    <!-- Anti-flash -->
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
    <link rel="stylesheet" href="/e-dsr-cons/css/theme.css" />
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/search.css">
    
    <title>E-DSR - Call Records</title>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Main Content -->
            <main class="col-12 col-xl-11 mx-auto">
                
                <!-- Section 1: Dashboard Header & Action Controls -->
                <div class="d-flex justify-content-between align-items-center pb-4 mb-4 border-bottom flex-wrap gap-3">
                    <div>
                        <h3 class="m-0 fw-bold tracking-tight text-dark">Call Records</h3>
                        <p class="text-muted small m-0 mt-1">Manage, filter, and extract digital call activity history.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-white border border-secondary-subtle btn-light px-3 fw-medium d-flex align-items-center gap-2 shadow-sm rounded-3 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                <i class="fa fa-columns text-secondary"></i> Toggle Columns
                            </button>
                            <ul class="dropdown-menu shadow-sm" id="columnToggleMenu" style="max-height: 400px; overflow-y: auto;">
                                <!-- populated by JS -->
                            </ul>
                        </div>
                        <button type="button" class="btn btn-primary px-3 fw-medium d-flex align-items-center gap-2 shadow-sm rounded-3" data-bs-toggle="modal" data-bs-target="#searchAccount">
                            <i class="fa fa-sliders-h"></i> Advanced Filters
                        </button>
                    </div>
                </div>

                <!-- Section 2: Inline Extended Search Bar Framework -->
                <div class="mb-4">
                    <form action="" method="GET" class="d-flex gap-2 w-100" style="max-width: 600px;">
                        <?php
                        $modal_filters = ['accountExecutiveSearch', 'accountName', 'callDate', 'callDateStart', 'callDateEnd'];
                        foreach ($modal_filters as $mf) {
                            if (!empty($_GET[$mf])) {
                                echo '<input type="hidden" name="' . htmlspecialchars($mf) . '" value="' . htmlspecialchars($_GET[$mf]) . '">';
                            }
                        }
                        ?>
                        <div class="input-group shadow-sm rounded-3">
                            <span class="input-group-text bg-white text-muted border-end-0 ps-3">
                                <i class="fa fa-search text-secondary opacity-75"></i>
                            </span>
                            <input type="text" name="globalSearch" class="form-control border-start-0 modern-search-input py-2.5" placeholder="Search Call ID, Client Name, Contact Person..." value="<?php echo htmlspecialchars($_GET['globalSearch'] ?? ''); ?>">
                            <?php if (!empty($_GET['globalSearch'])): ?>
                                <a href="search_calls.php" class="btn btn-white border border-start-0 border-end-0 d-flex align-items-center justify-content-center text-muted px-2" title="Clear Search">
                                    <i class="fa fa-times-circle"></i>
                                </a>
                            <?php endif; ?>
                            <button class="btn btn-primary px-4 fw-medium search-group-btn" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <!-- Modal for Searching Accounts -->
                <?php include('./modals/searchFilter.php') ?>

                <!-- Section 3: Records Presentation Canvas Box -->
                <style>
                    /* Custom Scrollbar for the table */
                    .table-responsive::-webkit-scrollbar {
                        height: 12px;
                    }
                    .table-responsive::-webkit-scrollbar-track {
                        background: #f8f9fa;
                        border-top: 1px solid #e9ecef;
                    }
                    .table-responsive::-webkit-scrollbar-thumb {
                        background-color: #c1c1c1;
                        border-radius: 6px;
                        border: 3px solid #f8f9fa;
                    }
                    .table-responsive::-webkit-scrollbar-thumb:hover {
                        background-color: #a8a8a8;
                    }
                </style>
                <div class="main-content-card shadow-sm overflow-hidden mb-4">
                    <div class="table-responsive">
                        <table id="callsTable" class="table table-hover align-middle m-0 modern-table" style="min-width: 1000px;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 110px;">Actions</th>
                                    <th>Call ID</th>
                                    <th>SBU</th>
                                    <th>Nature of Call</th>
                                    <th>Account Executive</th>
                                    <th>Date of Activity</th>
                                    <th>Branch</th>
                                    <th>Customer ID</th>
                                    <th>Account Name</th>
                                    <th>Client Branch</th>
                                    <th>Region</th>
                                    <th>Address</th>
                                    <th>Contact Person</th>
                                    <th>Designation</th>
                                    <th>Contact Details</th>
                                    <th>Email Address</th>
                                    <th>Date of Progress</th>
                                    <th>Accounts Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($accountResult && mysqli_num_rows($accountResult) > 0) {
                                    foreach ($accountResult as $row) { 
                                        
                                        $raw_status = strtolower($row['accountsStatus'] ?? '');
                                        $badge_context = 'bg-secondary text-white';
                                        
                                        if (str_contains($raw_status, 'won') || str_contains($raw_status, 'approved') || str_contains($raw_status, 'closed')) {
                                            $badge_context = 'bg-success-subtle text-success border border-success-subtle';
                                        } elseif (str_contains($raw_status, 'pending') || str_contains($raw_status, 'progress')) {
                                            $badge_context = 'bg-warning-subtle text-warning-emphasis border border-warning-subtle';
                                        } elseif (str_contains($raw_status, 'lost') || str_contains($raw_status, 'drop')) {
                                            $badge_context = 'bg-danger-subtle text-danger border border-danger-subtle';
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <div class="d-inline-flex gap-1.5">
                                                    <button class="btn btn-light border action-btn btn-sm text-success" title="Edit Record" onclick="window.location.href='editCall.php?id=<?php echo $row['id']; ?>'">
                                                        <i class="fa fa-pencil-alt fs-7"></i>
                                                    </button>
                                                    <button class="btn btn-light border action-btn btn-sm text-danger" title="Remove Record" onclick="return confirm('Are you sure you want to delete this record?') ? window.location.href='../php/deleteCall.php?id=<?php echo $row['id']; ?>' : null;">
                                                        <i class="fa fa-trash-alt fs-7"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td><span class="text-dark fw-semibold tracking-wider"><?php echo htmlspecialchars($row['Call_ID'] ?? 'N/A'); ?></span></td>
                                            <td><div class="text-secondary fw-medium" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo htmlspecialchars($row['sbu'] ?? 'N/A'); ?></div></td>
                                            <td><span class="text-dark fw-medium"><?php echo htmlspecialchars($row['natureOfCall'] ?? 'N/A'); ?></span></td>
                                            <td><div class="text-dark fw-medium" style="max-width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo htmlspecialchars($row['accountExecutive'] ?? 'N/A'); ?></div></td>
                                            <td><span class="text-muted font-monospace"><?php echo htmlspecialchars($row['dateOfActivity'] ?? 'N/A'); ?></span></td>
                                            <td><span class="text-secondary"><?php echo htmlspecialchars($row['activityBranch'] ?? 'N/A'); ?></span></td>
                                            <td><span class="text-secondary"><?php echo htmlspecialchars($row['customerId'] ?? 'N/A'); ?></span></td>
                                            <td><div class="text-secondary fw-medium" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo htmlspecialchars(ucwords(strtolower($row['accountName'] ?? ''))); ?></div></td>
                                            <td><span class="text-secondary"><?php echo htmlspecialchars($row['clientBranch'] ?? 'N/A'); ?></span></td>
                                            <td><span class="text-secondary"><?php echo htmlspecialchars($row['region'] ?? 'N/A'); ?></span></td>
                                            <td><div class="text-secondary" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo htmlspecialchars($row['address'] ?? 'N/A'); ?></div></td>
                                            <td><span class="text-secondary"><?php echo htmlspecialchars($row['contactPerson'] ?? 'N/A'); ?></span></td>
                                            <td><span class="text-secondary"><?php echo htmlspecialchars($row['designation'] ?? 'N/A'); ?></span></td>
                                            <td><span class="text-secondary"><?php echo htmlspecialchars($row['contactDetails'] ?? 'N/A'); ?></span></td>
                                            <td><span class="text-secondary"><?php echo htmlspecialchars($row['emailAddress'] ?? 'N/A'); ?></span></td>
                                            <td><span class="text-muted"><?php echo htmlspecialchars($row['dateOfProgress'] ?? 'N/A'); ?></span></td>
                                            <td>
                                                <span class="badge status-badge text-uppercase <?php echo $badge_context; ?>">
                                                    <?php echo htmlspecialchars($row['accountsStatus'] ?? 'N/A'); ?>
                                                </span>
                                            </td>
                                            <td><div class="text-muted small" style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo htmlspecialchars($row['remarks'] ?? ''); ?>"><?php echo htmlspecialchars($row['remarks'] ?? 'N/A'); ?></div></td>
                                        </tr>
                                    <?php } 
                                } else { ?>
                                    <tr>
                                        <td colspan="19" class="text-center text-muted py-5">
                                            <div class="py-4">
                                                <i class="fa fa-inbox d-block mb-3 text-secondary opacity-50" style="font-size: 3.5rem;"></i>
                                                <h5 class="fw-semibold text-dark m-0">No Matching Records Found</h5>
                                                <p class="text-muted small mt-1 mb-0">Try clarifying your terms or resetting active filter properties.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section 4: Modernized Pagination Architecture Wrapper -->
                <?php
                    $max_pages_to_show = 8;
                    $start_page = max(1, $current_page - floor($max_pages_to_show / 2));
                    $end_page = min($total_pages, $start_page + $max_pages_to_show - 1);

                    if (($end_page - $start_page + 1) < $max_pages_to_show) {
                        $start_page = max(1, $end_page - $max_pages_to_show + 1);
                    }
                ?>

                <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4 mb-5">
                    <ul class="pagination shadow-sm rounded-3 overflow-hidden">
                        <?php
                        $filter_query_string = '';
                        $filters = ['accountExecutiveSearch', 'accountName', 'callDate', 'callDateStart', 'callDateEnd', 'globalSearch'];

                        foreach ($filters as $f) {
                            if (!empty($_GET[$f])) {
                                $filter_query_string .= '&' . $f . '=' . urlencode($_GET[$f]);
                            }
                        }

                        if ($current_page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . $filter_query_string . '"><i class="fa fa-chevron-left fs-7"></i></a></li>';
                        } else {
                            echo '<li class="page-item disabled"><span class="page-link"><i class="fa fa-chevron-left fs-7"></i></span></li>';
                        }

                        for ($page = $start_page; $page <= $end_page; $page++) {
                            $active_class = ($current_page == $page) ? 'active' : '';
                            echo '<li class="page-item ' . $active_class . '"><a class="page-link" href="?page=' . $page . $filter_query_string . '">' . $page . '</a></li>';
                        }

                        if ($current_page < $total_pages) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . $filter_query_string . '"><i class="fa fa-chevron-right fs-7"></i></a></li>';
                        } else {
                            echo '<li class="page-item disabled"><span class="page-link"><i class="fa fa-chevron-right fs-7"></i></span></li>';
                        }
                        ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script>
        var category = "<?php echo $_SESSION['category'] ?? $category ?? ''; ?>";
    </script>
    <script src="../js/hideElement.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = document.getElementById("callsTable");
            const headers = table.querySelectorAll("thead th");
            const toggleMenu = document.getElementById("columnToggleMenu");
            
            // Define default visible columns (0-indexed)
            // 0: Actions, 1: Call ID, 2: SBU, 3: Nature of Call, 4: Account Executive, 
            // 5: Date of Activity, 16: Date of Progress, 17: Accounts Status, 18: Remarks
            const defaultVisible = [0, 1, 2, 3, 4, 5, 16, 17, 18];

            headers.forEach((th, index) => {
                // Skip Actions column from being toggleable
                if (index === 0) return;

                const colName = th.innerText.trim();
                const isChecked = defaultVisible.includes(index);

                // Add to dropdown
                const li = document.createElement("li");
                li.innerHTML = `
                    <label class="dropdown-item d-flex align-items-center gap-2" style="cursor:pointer;">
                        <input class="form-check-input col-toggle-cb m-0" type="checkbox" data-col="${index}" ${isChecked ? "checked" : ""}> 
                        ${colName}
                    </label>
                `;
                toggleMenu.appendChild(li);

                // Apply initial visibility
                toggleColumnVisibility(index, isChecked);
            });

            // Handle toggle
            document.querySelectorAll(".col-toggle-cb").forEach(cb => {
                cb.addEventListener("change", function() {
                    toggleColumnVisibility(this.dataset.col, this.checked);
                });
            });

            function toggleColumnVisibility(colIndex, isVisible) {
                // Toggle header
                const th = table.querySelector(`thead th:nth-child(${parseInt(colIndex) + 1})`);
                if (th) th.style.display = isVisible ? "" : "none";

                // Toggle rows
                const rows = table.querySelectorAll("tbody tr");
                rows.forEach(row => {
                    const firstTd = row.querySelector("td");
                    if (firstTd && firstTd.hasAttribute("colspan")) {
                        let visibleCount = Array.from(table.querySelectorAll("thead th")).filter(h => h.style.display !== "none").length;
                        firstTd.setAttribute("colspan", visibleCount);
                    } else {
                        const td = row.querySelector(`td:nth-child(${parseInt(colIndex) + 1})`);
                        if (td) td.style.display = isVisible ? "" : "none";
                    }
                });
            }
        });
    </script>
</body>
</html>
