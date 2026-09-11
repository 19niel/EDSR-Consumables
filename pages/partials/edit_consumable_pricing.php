                        <!-- Consumables Product and Pricing Information -->
                        <div class="card p-4 shadow-sm mb-4" id="consumablesPricingCard" style="display: none;">
                            <h5 class="text-secondary fw-semibold mb-3">Consumables Product and Pricing Information</h5>
                            <div id="consumableEntries">
                                <?php if (!empty($consumableSavedProducts)): ?>
                                    <?php foreach ($consumableSavedProducts as $item): ?>
                                        <div class="row product-entry g-3 mb-3 align-items-end">
                                            <div class="col-lg-1 col-md-3 col-12">
                                                <label class="form-label">Product Type <span class="req">*</span></label>
                                                <select name="consumableType[]" class="form-select productType" disabled>
                                                    <option value="N/A" disabled>Choose...</option>
                                                    <?php
                                                    mysqli_data_seek($consumablesProductTypeResult, 0);
                                                    while ($productTypeRow = mysqli_fetch_assoc($consumablesProductTypeResult)) {
                                                        $sel = ($item['productTypeID'] == $productTypeRow['id']) ? 'selected' : '';
                                                        echo '<option value="' . $productTypeRow['id'] . '" ' . $sel . '>' . htmlspecialchars($productTypeRow['category_name']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-1 col-md-3 col-12">
                                                <label class="form-label">Product Type Subcategory</label>
                                                <select name="consumableModel[]" class="form-select productTypeSubcategory" disabled data-saved-value="<?php echo htmlspecialchars($item['productSubcategoryID'] ?? ''); ?>">
                                                    <option value="N/A">Choose...</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-12">
                                                <label class="form-label">Consumable <span class="req">*</span></label>
                                                <?php
                                                    $displayConsumable = 'Choose...';
                                                    if (!empty($item['deviceConditionID']) && is_numeric($item['deviceConditionID'])) {
                                                        $conQuery = "SELECT consumable_name FROM consumables WHERE id = " . intval($item['deviceConditionID']);
                                                        $conResult = mysqli_query($conn, $conQuery);
                                                        if ($conRow = mysqli_fetch_assoc($conResult)) {
                                                            $displayConsumable = htmlspecialchars($conRow['consumable_name']);
                                                        }
                                                    }
                                                ?>
                                                <select name="consumable[]" class="form-select consumableName" disabled data-saved-value="<?php echo htmlspecialchars($item['deviceConditionID'] ?? ''); ?>">
                                                    <?php if (!empty($item['deviceConditionID']) && $item['deviceConditionID'] !== 'N/A'): ?>
                                                        <option value="<?php echo htmlspecialchars($item['deviceConditionID']); ?>" selected><?php echo $displayConsumable; ?></option>
                                                    <?php else: ?>
                                                        <option value="N/A" disabled selected>Choose...</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-12">
                                                <label class="form-label">Item Code <span class="req">*</span></label>
                                                <?php
                                                    $displayItemCode = htmlspecialchars($item['itemCode'] ?? '');
                                                    if (!empty($item['itemCode']) && is_numeric($item['itemCode'])) {
                                                        $icQuery = "SELECT item_name FROM item_codes WHERE id = " . intval($item['itemCode']);
                                                        $icResult = mysqli_query($conn, $icQuery);
                                                        if ($icRow = mysqli_fetch_assoc($icResult)) {
                                                            $displayItemCode = htmlspecialchars($icRow['item_name']);
                                                        }
                                                    }
                                                ?>
                                                <select name="consumableItemCode[]" class="form-select itemCode" disabled data-saved-value="<?php echo htmlspecialchars($item['itemCode'] ?? ''); ?>">
                                                    <?php if (!empty($item['itemCode']) && $item['itemCode'] !== 'N/A'): ?>
                                                        <option value="<?php echo htmlspecialchars($item['itemCode']); ?>" selected><?php echo $displayItemCode; ?></option>
                                                    <?php else: ?>
                                                        <option value="N/A" disabled selected>Choose...</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-1 col-md-3 col-6">
                                                <label class="form-label">Qty <span class="req">*</span></label>
                                                <input type="number" class="form-control" name="consumableQuantity[]" min="1" disabled value="<?php echo htmlspecialchars($item['quantity'] ?? ''); ?>" />
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-6">
                                                <label class="form-label">Unit Price <span class="req">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="number" class="form-control" name="consumableAmount[]" step="0.01" disabled value="<?php echo htmlspecialchars($item['productAmount'] ?? ''); ?>" />
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-3 col-12">
                                                <button type="button" class="btn btn-outline-danger remove-entry w-100" title="Remove Consumable Row">
                                                    <i class="fa fa-trash-alt d-lg-none me-1"></i><span class="d-none d-lg-inline">Remove</span>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="row product-entry g-3 mb-3 align-items-end">
                                        <div class="col-lg-1 col-md-3 col-12">
                                            <label class="form-label">Product Type <span class="req">*</span></label>
                                            <select name="consumableType[]" class="form-select productType" disabled>
                                                <option value="N/A" selected disabled>Choose...</option>
                                                <?php
                                                mysqli_data_seek($consumablesProductTypeResult, 0);
                                                while ($productTypeRow = mysqli_fetch_assoc($consumablesProductTypeResult)) {
                                                    echo '<option value="' . $productTypeRow['id'] . '">' . htmlspecialchars($productTypeRow['category_name']) . '</option>';
                                                }
                                                ?>
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
                                            <select name="consumable[]" class="form-select consumableName" disabled>
                                                <option value="N/A" selected disabled>Choose Model first...</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-12">
                                            <label class="form-label">Item Code <span class="req">*</span></label>
                                            <select name="consumableItemCode[]" class="form-select itemCode" disabled>
                                                <option value="N/A" selected disabled>Choose...</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-1 col-md-3 col-6">
                                            <label class="form-label">Qty <span class="req">*</span></label>
                                            <input type="number" class="form-control" name="consumableQuantity[]" min="1" disabled />
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-6">
                                            <label class="form-label">Unit Price <span class="req">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" class="form-control" name="consumableAmount[]" step="0.01" disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-3 col-12">
                                            <button type="button" class="btn btn-outline-danger remove-entry w-100" title="Remove Consumable Row">
                                                <i class="fa fa-trash-alt d-lg-none me-1"></i><span class="d-none d-lg-inline">Remove</span>
                                            </button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                <button type="button" class="btn btn-outline-primary btn-sm" id="addConsumableEntry" disabled>
                                    <i class="fa fa-plus me-1"></i> Add Another Consumable
                                </button>
                                <div class="text-end" style="min-width: 320px;">
                                    <div>
                                        <strong>Total Qty:</strong> <span id="consumableTotalQty">0</span> &nbsp;&nbsp;&nbsp;
                                        <strong>Total Amount:</strong> ₱<span id="consumableTotalAmount">0.00</span>
                                    </div>
                                    <?php
                                    $savedDiscountEnabled = isset($row['discountEnabled']) ? $row['discountEnabled'] : 0;
                                    $savedDiscountType = isset($row['discountType']) ? $row['discountType'] : 'percentage';
                                    $savedDiscountValue = isset($row['discountValue']) ? $row['discountValue'] : 0;
                                    ?>
                                    <div class="admin-discount-wrapper" style="display:none;">
                                        <div class="mt-2 d-flex justify-content-end align-items-center gap-2">
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input discount-toggle" type="checkbox" id="consumableDiscountToggle" name="consumableDiscountEnabled" value="1" disabled <?php echo ($savedDiscountEnabled == 1 ? 'checked' : ''); ?>>
                                                <label class="form-check-label text-muted small" for="consumableDiscountToggle">Add Discount</label>
                                            </div>
                                            <div class="btn-group btn-group-sm discount-type-group" role="group" id="consumableDiscountTypeGroup" style="display:none;">
                                                <input type="radio" class="btn-check discount-type" name="consumableDiscountType" id="consumableDiscountPercent" value="percentage" disabled <?php echo ($savedDiscountType === 'percentage' ? 'checked' : ''); ?>>
                                                <label class="btn btn-outline-secondary" for="consumableDiscountPercent">%</label>
                                                <input type="radio" class="btn-check discount-type" name="consumableDiscountType" id="consumableDiscountAmount" value="amount" disabled <?php echo ($savedDiscountType === 'amount' ? 'checked' : ''); ?>>
                                                <label class="btn btn-outline-secondary" for="consumableDiscountAmount">₱</label>
                                            </div>
                                            <input type="number" class="form-control form-control-sm discount-value" id="consumableDiscountValue" name="consumableDiscountValue" style="width:80px; display:none;" step="0.01" min="0" placeholder="0" disabled value="<?php echo htmlspecialchars($savedDiscountValue); ?>">
                                        </div>
                                        <div class="mt-1" style="display:none;" id="consumableGrandTotalContainer">
                                            <h6 class="mb-0 text-success fw-bold">Grand Total: ₱<span id="consumableGrandTotal">0.00</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
