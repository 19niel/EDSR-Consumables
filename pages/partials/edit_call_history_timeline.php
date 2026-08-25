                        <hr class="text-secondary my-4">

                        <div class="card p-4 shadow-sm mb-5 border-top border-primary border-3">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-subtle text-primary p-2 rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fa-solid fa-clock-history fs-5"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-dark fw-bold m-0" style="letter-spacing: -0.02em;">Call Progress History</h5>
                                        <p class="text-muted small m-0 mt-0.5">Chronological record of status changes and administrative logs</p>
                                    </div>
                                </div>
                                <span class="badge bg-light text-secondary border border-secondary-subtle px-2 py-1" style="font-size: 0.72rem; font-weight: 600;">
                                    <i class="fa-solid fa-list-ol me-1"></i> Audit Trail
                                </span>
                            </div>

                            <div class="progress-timeline-wrapper px-2" style="max-height: 480px; overflow-y: auto; position: relative;">
                                <?php 
                                if (!empty($callData['id'])) {
                                    $masterId = $callData['id'];
                                    include('../php/db_conn.php');
                                    
                                    $historySql = "SELECT * FROM call_logs WHERE callID = ? ORDER BY id DESC";
                                    
                                    if ($stmt = mysqli_prepare($conn, $historySql)) {
                                        mysqli_stmt_bind_param($stmt, "i", $masterId);
                                        mysqli_stmt_execute($stmt);
                                        $historyResult = mysqli_stmt_get_result($stmt);
                                        
                                        if ($historyResult && mysqli_num_rows($historyResult) > 0) {
                                            while ($log = mysqli_fetch_assoc($historyResult)) {
                                                $logDate = !empty($log['dateOfProgress']) ? date('M d, Y', strtotime($log['dateOfProgress'])) : 'N/A';
                                                
                                                // Assuming we don't have a created_at column by default, we just use the progress date or leave it out.
                                                // Wait, let's see if call_logs has a timestamp or if we just use dateOfProgress.
                                                // Let's just use dateOfProgress for both if created_at is missing.
                                                $createdAt = isset($log['timestamp']) ? date('m/d/Y h:i A', strtotime($log['timestamp'])) : $logDate; 

                                                $statusText = !empty($log['accountsStatus']) ? htmlspecialchars($log['accountsStatus']) : "Unknown Status";

                                                $remarks = !empty(trim($log['remarks'])) ? htmlspecialchars($log['remarks']) : '<em>No explicit remarks recorded.</em>';
                                                
                                                $statusBadgeClass = 'bg-secondary text-white';
                                                $timelineNodeColor = '#6c757d';
                                                
                                                if (strpos(strtolower($statusText), 'won') !== false || strpos(strtolower($statusText), 'closed') !== false) {
                                                    $statusBadgeClass = 'bg-success text-white';
                                                    $timelineNodeColor = '#198754';
                                                } elseif (strpos(strtolower($statusText), 'lost') !== false || strpos(strtolower($statusText), 'drop') !== false) {
                                                    $statusBadgeClass = 'bg-danger text-white';
                                                    $timelineNodeColor = '#dc3545';
                                                } elseif (strpos(strtolower($statusText), 'pending') !== false) {
                                                    $statusBadgeClass = 'bg-warning text-dark';
                                                    $timelineNodeColor = '#ffc107';
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
                                                        </div>

                                                        <div class="text-dark bg-white border rounded p-2 mb-2 small shadow-sm" style="font-size: 0.75rem; border-color: var(--border-color) !important; border-left: 3px solid #dee2e6 !important;">
                                                            <?php echo $remarks; ?>
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
                                }
                                ?>
                            </div>
                        </div>
