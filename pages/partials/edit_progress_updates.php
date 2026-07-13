                        <hr class="text-secondary my-4">

                        <div class="card p-4 shadow-sm mb-4">
                            <h5 class="text-secondary fw-semibold mb-3">Progress Updates</h5>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="progressDate" class="form-label">Date of Progress</label>
                                    <input type="date" class="form-control" id="progressDate" name="progressDate" min="<?php echo $min_expiry; ?>" value="<?php echo htmlspecialchars($row['progressDate'] ?? ''); ?>"/>
                                </div>
                              
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="accountStatus" class="form-label">Account Status<span class="req">*</span></label>
                                    <select id="accountStatus" name="accountStatus" class="form-select" required>
                                        <option value="N/A" disabled>Choose...</option>
                                        <?php foreach ($accountstatusResult as $accountstatusRow) { 
                                            $selected = (isset($row['accStatus']) && $row['accStatus'] == $accountstatusRow['id']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $accountstatusRow['id']; ?>" <?php echo $selected; ?>><?php echo $accountstatusRow['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="reasonSubcategory" class="form-label">Reason Subcategory</label>
                                    <select id="reasonSubcategory" name="reasonSubcategory" class="form-select" data-saved-value="<?php echo htmlspecialchars($row['reasonSubcategory'] ?? ''); ?>">
                                        <option value="N/A">Choose...</option>
                                    </select>
                                </div>
                               
                                <div class="col-md-12 col-xl-6">
                                    <label for="remarks" class="form-label">Remarks<span class="req">*</span></label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="2" required><?php echo htmlspecialchars($row['remarks'] ?? ''); ?></textarea>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="estimatedDelivery" class="form-label">Estimated Delivery</label>
                                    <select id="estimatedDelivery" name="estimatedDelivery" class="form-select">
                                        <option value="N/A" disabled <?php echo empty($row['estimatedDelivery']) ? 'selected' : ''; ?>>Choose Month...</option>
                                        <?php 
                                        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                        foreach ($months as $m) {
                                            // This logic mirrors your accountStatus approach
                                            $selected = (isset($row['estimatedDelivery']) && $row['estimatedDelivery'] == $m) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $m; ?>" <?php echo $selected; ?>><?php echo $m; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 col-lg-4 col-xl-3" id="deliveryDateContainer" style="display: none;">
                                    <label for="deliveryDate" class="form-label">Delivery Date</label>
                                    <input type="date" class="form-control" id="deliveryDate" name="deliveryDate" min="<?php echo $min_expiry; ?>" value="<?php echo htmlspecialchars($row['deliveryDate'] ?? ''); ?>" />
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3" id="contractEndContainer" style="display: none;">
                                    <label for="contractEnd" class="form-label">Contract End</label>
                                    <input type="date" class="form-control" id="contractEnd" name="contractEnd" min="<?php echo $min_expiry; ?>" value="<?php echo htmlspecialchars($row['contractEnd'] ?? ''); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end mt-4 mb-4 d-flex justify-content-end gap-2">
                            <a href="<?php echo BASE_URL; ?>pages/search.php" class="btn btn-light border px-4 shadow-sm fw-medium">Cancel</a>
                            <button type="button" onclick="submitLogOnly()" class="btn btn-success px-4 shadow-sm fw-medium">
                                <i class="fa fa-file-signature me-1"></i> Save Log Entry Only
                            </button>
                        </div>

