                        <hr class="text-secondary my-4">

                        <div class="card p-4 shadow-sm mb-5 border-top border-primary border-3">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-subtle text-primary p-2 rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fa-solid fa-clock-history fs-5"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-dark fw-bold m-0" style="letter-spacing: -0.02em;">Account Progress History</h5>
                                        <p class="text-muted small m-0 mt-0.5">Chronological record of status changes and administrative logs</p>
                                    </div>
                                </div>
                                <span class="badge bg-light text-secondary border border-secondary-subtle px-2 py-1" style="font-size: 0.72rem; font-weight: 600;">
                                    <i class="fa-solid fa-list-ol me-1"></i> Audit Trail
                                </span>
                            </div>

                            <div class="progress-timeline-wrapper px-2" style="max-height: 480px; overflow-y: auto; position: relative;">
                                <?php 
                                if (!empty($encodedMasterId)) {
                                    include('../php/db_conn.php');
                                    
                                    $historySql = "SELECT el.*, ac.category_name as status_name 
                                                   FROM encoded_logs el 
                                                   LEFT JOIN categories ac ON el.accountStatusID = ac.id 
                                                   WHERE el.encodedID = ? 
                                                   ORDER BY el.created_at DESC";
                                    
                                    if ($stmt = mysqli_prepare($conn, $historySql)) {
                                        mysqli_stmt_bind_param($stmt, "i", $encodedMasterId);
                                        mysqli_stmt_execute($stmt);
                                        $historyResult = mysqli_stmt_get_result($stmt);
                                        
                                        if ($historyResult && mysqli_num_rows($historyResult) > 0) {
                                            while ($log = mysqli_fetch_assoc($historyResult)) {
                                                $logDate = !empty($log['progressDate']) ? date('M d, Y', strtotime($log['progressDate'])) : 'N/A';
                                                $createdAt = !empty($log['created_at']) ? date('m/d/Y h:i A', strtotime($log['created_at'])) : 'N/A';
                                                
                                                if (!empty($log['status_name'])) {
                                                    $statusText = htmlspecialchars($log['status_name']);
                                                } elseif (!empty($log['accountStatusID'])) {
                                                    $statusText = "Status ID: " . htmlspecialchars($log['accountStatusID']);
                                                } else {
                                                    $statusText = "Unknown Status";
                                                }

                                                $remarks = !empty(trim($log['remarks'])) ? htmlspecialchars($log['remarks']) : '<em>No explicit remarks recorded.</em>';
                                                $subcategory = !empty($log['reasonSubcategory']) ? trim($log['reasonSubcategory']) : '';
                                                
                                                $statusBadgeClass = 'bg-secondary text-white';
                                                $timelineNodeColor = '#6c757d';
                                                
                                                if (strpos(strtolower($statusText), 'won') !== false || $log['accountStatusID'] == '347') {
                                                    $statusBadgeClass = 'bg-success text-white';
                                                    $timelineNodeColor = '#198754';
                                                } elseif (strpos(strtolower($statusText), 'lost') !== false || $log['accountStatusID'] == '348' || strpos(strtolower($statusText), 'drop') !== false || $log['accountStatusID'] == '349') {
                                                    $statusBadgeClass = 'bg-danger text-white';
                                                    $timelineNodeColor = '#dc3545';
                                                } elseif (strpos(strtolower($statusText), 'nego') !== false || $log['accountStatusID'] == '346') {
                                                    $statusBadgeClass = 'bg-info text-dark';
                                                    $timelineNodeColor = '#0dcaf0';
                                                } elseif (strpos(strtolower($statusText), 'quali') !== false || $log['accountStatusID'] == '345') {
                                                    $statusBadgeClass = 'bg-primary text-white';
                                                    $timelineNodeColor = '#0d6efd';
                                                }
                                    ?>
                                                <div class="timeline-item d-flex mb-4" style="position: relative;">
                                                    <div class="timeline-line" style="position: absolute; left: 15px; top: 30px; bottom: -30px; width: 2px; background-color: var(--border-color); z-index: 1;"></div>
                                                    
                                                    <div class="timeline-node rounded-circle shadow-sm d-flex align-items-center justify-content-center text-white" 
                                                        style="width: 32px; height: 32px; background-color: <?php echo $timelineNodeColor; ?>; z-index: 2; flex-shrink: 0;">
                                                        <i class="fa-solid fa-circle-dot" style="font-size: 0.65rem;"></i>
                                                    </div>
                                                    
                                                    <div class="timeline-content-card border rounded-3 p-3 ms-3 flex-grow-1 bg-light shadow-sm" style="border-color: var(--border-color) !important;">
                                                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <span class="badge rounded-pill fw-bold tracking-wide text-uppercase <?php echo $statusBadgeClass; ?>" style="font-size: 0.68rem; padding: 0.35em 0.8em;">
                                                                    <?php echo $statusText; ?>
                                                                </span>
                                                                <span class="text-secondary small fw-medium">
                                                                    <i class="fa-regular fa-calendar me-1"></i><?php echo $logDate; ?>
                                                                </span>
                                                            </div>
                                                            <small class="text-muted fw-normal" style="font-size: 0.68rem;">
                                                                <i class="fa-solid fa-fingerprint me-1"></i>Logged: <?php echo $createdAt; ?>
                                                            </small>
                                                        </div>

                                                        <div class="text-dark bg-white border rounded p-2 mb-2 small shadow-sm" style="font-size: 0.75rem; border-color: var(--border-color) !important; border-left: 3px solid #dee2e6 !important;">
                                                            <?php echo $remarks; ?>
                                                        </div>

                                                        <div class="row g-2 pt-1">
                                                            <?php if (!empty($subcategory) && strtolower($subcategory) !== 'n/a'): ?>
                                                            <div class="col-6 col-md-4 col-xl-3">
                                                                <div class="text-muted text-uppercase" style="font-size: 0.60rem; font-weight: 700; letter-spacing: 0.03em;">Reason Subcategory</div>
                                                                <div class="text-dark fw-semibold" style="font-size: 0.72rem;"><?php echo htmlspecialchars($subcategory); ?></div>
                                                            </div>
                                                            <?php endif; ?>

                                                            <?php if (!empty(trim($log['estimatedDelivery'])) && $log['estimatedDelivery'] !== '0000-00-00' && strtolower(trim($log['estimatedDelivery'])) !== 'null'): ?>
                                                            <div class="col-6 col-md-4 col-xl-3">
                                                                <div class="text-muted text-uppercase" style="font-size: 0.60rem; font-weight: 700; letter-spacing: 0.03em;">Est. Delivery</div>
                                                                <div class="text-success fw-semibold" style="font-size: 0.72rem;">
                                                                    <i class="fa-solid fa-truck-loading me-1"></i><?php echo htmlspecialchars($log['estimatedDelivery']); ?>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>

                                                            <?php if (!empty($log['deliveryDate']) && $log['deliveryDate'] !== '0000-00-00' && strtolower(trim($log['deliveryDate'])) !== 'null'): ?>
                                                            <div class="col-6 col-md-4 col-xl-3">
                                                                <div class="text-muted text-uppercase" style="font-size: 0.60rem; font-weight: 700; letter-spacing: 0.03em;">Actual Delivery</div>
                                                                <div class="text-primary fw-semibold" style="font-size: 0.72rem;">
                                                                    <i class="fa-solid fa-box-open me-1"></i><?php echo date('m/d/Y', strtotime($log['deliveryDate'])); ?>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>

                                                            <?php if (!empty($log['contractEndDate']) && $log['contractEndDate'] !== '0000-00-00' && strtolower(trim($log['contractEndDate'])) !== 'null'): ?>
                                                            <div class="col-6 col-md-4 col-xl-3">
                                                                <div class="text-muted text-uppercase" style="font-size: 0.60rem; font-weight: 700; letter-spacing: 0.03em;">Contract End</div>
                                                                <div class="text-danger fw-semibold" style="font-size: 0.72rem;">
                                                                    <i class="fa-solid fa-file-contract me-1"></i><?php echo date('m/d/Y', strtotime($log['contractEndDate'])); ?>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                            }
                                            echo '<style>.timeline-item:last-child .timeline-line { display: none !important; }</style>';
                                        } else {
                                            echo '<div class="text-center py-4 text-muted small"><i class="fa-solid fa-folder-open fs-4 d-block mb-2 text-black-50"></i>No historical progress log entries found.</div>';
                                        }
                                        mysqli_stmt_close($stmt);
                                    }
                                    mysqli_close($conn);
                                }
                                ?>
                            </div>
                        </div>
