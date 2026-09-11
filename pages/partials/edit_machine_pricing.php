                        <hr class="text-secondary my-4">

                        <?php
                        // Sort saved products into machine vs consumable buckets
                        $machineSavedProducts    = [];
                        $consumableSavedProducts = [];
                        if (!empty($row['products']) && is_array($row['products'])) {
                            foreach ($row['products'] as $p) {
                                if (!empty($p['deviceConditionID'])) {
                                    $consumableSavedProducts[] = $p;
                                } else {
                                    $machineSavedProducts[] = $p;
                                }
                            }
                        }
                        ?>

                        <!-- Machine Product and Pricing Information -->
                        <div class="card p-4 shadow-sm mb-4" id="machinePricingCard" style="display: none;">
                            <h5 class="text-secondary fw-semibold mb-3">Machine Product and Pricing Information</h5>
                            <div id="productEntries">
                                <?php if (!empty($machineSavedProducts)): ?>
                                    <?php foreach ($machineSavedProducts as $item): ?>
                                        <div class="row product-entry g-3 mb-3 align-items-end">
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <label class="form-label">Product Type <span class="req">*</span></label>
                                                <select name="productType[]" class="form-select productType" disabled>
                                                    <option value="N/A" disabled>Choose...</option>
                                                    <?php
                                                    mysqli_data_seek($machineProductTypeResult, 0);
                                                    while ($productTypeRow = mysqli_fetch_assoc($machineProductTypeResult)) {
                                                        $sel = ($item['productTypeID'] == $productTypeRow['id']) ? 'selected' : '';
                                                        echo '<option value="' . $productTypeRow['id'] . '" ' . $sel . '>' . htmlspecialchars($productTypeRow['category_name']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <label class="form-label">Model</label>
                                                <select name="productTypeSubcategory[]" class="form-select productTypeSubcategory" disabled data-saved-value="<?php echo htmlspecialchars($item['productSubcategoryID'] ?? ''); ?>" >
                                                    <option value="N/A">Choose...</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <label class="form-label">Quantity <span class="req">*</span></label>
                                                <input type="number" class="form-control" name="quantity[]" min="1" disabled value="<?php echo htmlspecialchars($item['quantity'] ?? ''); ?>" />
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-6">
                                                <label class="form-label">Unit Price <span class="req">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="number" class="form-control" name="productAmount[]" step="0.01" disabled value="<?php echo htmlspecialchars($item['productAmount'] ?? ''); ?>" />
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-3 col-12">
                                                <button type="button" class="btn btn-outline-danger remove-entry w-100" title="Remove Product Row">
                                                    <i class="fa fa-trash-alt d-lg-none me-1"></i><span class="d-none d-lg-inline">Remove</span>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="row product-entry g-3 mb-3 align-items-end">
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <label class="form-label">Product Type <span class="req">*</span></label>
                                            <select name="productType[]" class="form-select productType" disabled>
                                                <option value="N/A" selected disabled>Choose...</option>
                                                <?php
                                                mysqli_data_seek($machineProductTypeResult, 0);
                                                while ($productTypeRow = mysqli_fetch_assoc($machineProductTypeResult)) {
                                                    echo '<option value="' . $productTypeRow['id'] . '">' . htmlspecialchars($productTypeRow['category_name']) . '</option>';
                                                }
                                                ?>
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
                                            <input type="number" class="form-control" name="quantity[]" min="1" disabled />
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-6">
                                            <label class="form-label">Unit Price <span class="req">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" class="form-control" name="productAmount[]" step="0.01" disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-3 col-12">
                                            <button type="button" class="btn btn-outline-danger remove-entry w-100" title="Remove Product Row">
                                                <i class="fa fa-trash-alt d-lg-none me-1"></i><span class="d-none d-lg-inline">Remove</span>
                                            </button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                <button type="button" class="btn btn-outline-primary btn-sm" id="addProductEntry" disabled>
                                    <i class="fa fa-plus me-1"></i> Add Another Product
                                </button>
                                <div class="text-end" style="min-width: 320px;">
                                    <div>
                                        <strong>Total Qty:</strong> <span id="machineTotalQty">0</span> &nbsp;&nbsp;&nbsp;
                                        <strong>Total Amount:</strong> ₱<span id="machineTotalAmount">0.00</span>
                                    </div>
                                    <?php
                                    $savedDiscountEnabled = isset($row['discountEnabled']) ? $row['discountEnabled'] : 0;
                                    $savedDiscountType = isset($row['discountType']) ? $row['discountType'] : 'percentage';
                                    $savedDiscountValue = isset($row['discountValue']) ? $row['discountValue'] : 0;
                                    ?>
                                    <div class="admin-discount-wrapper" style="display:none;">
                                        <div class="mt-2 d-flex justify-content-end align-items-center gap-2">
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input discount-toggle" type="checkbox" id="machineDiscountToggle" name="machineDiscountEnabled" value="1" disabled <?php echo ($savedDiscountEnabled == 1 ? 'checked' : ''); ?>>
                                                <label class="form-check-label text-muted small" for="machineDiscountToggle">Add Discount</label>
                                            </div>
                                            <div class="btn-group btn-group-sm discount-type-group" role="group" id="machineDiscountTypeGroup" style="display:none;">
                                                <input type="radio" class="btn-check discount-type" name="machineDiscountType" id="machineDiscountPercent" value="percentage" disabled <?php echo ($savedDiscountType === 'percentage' ? 'checked' : ''); ?>>
                                                <label class="btn btn-outline-secondary" for="machineDiscountPercent">%</label>
                                                <input type="radio" class="btn-check discount-type" name="machineDiscountType" id="machineDiscountAmount" value="amount" disabled <?php echo ($savedDiscountType === 'amount' ? 'checked' : ''); ?>>
                                                <label class="btn btn-outline-secondary" for="machineDiscountAmount">₱</label>
                                            </div>
                                            <input type="number" class="form-control form-control-sm discount-value" id="machineDiscountValue" name="machineDiscountValue" style="width:80px; display:none;" step="0.01" min="0" placeholder="0" disabled value="<?php echo htmlspecialchars($savedDiscountValue); ?>">
                                        </div>
                                        <div class="mt-1" style="display:none;" id="machineGrandTotalContainer">
                                            <h6 class="mb-0 text-success fw-bold">Grand Total: ₱<span id="machineGrandTotal">0.00</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
