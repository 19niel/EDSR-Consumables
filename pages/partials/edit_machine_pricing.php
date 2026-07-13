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
                                                <label class="form-label">Amount <span class="req">*</span></label>
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
                                            <label class="form-label">Amount <span class="req">*</span></label>
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
                                <div class="text-end">
                                    <strong>Total Qty:</strong> <span id="machineTotalQty">0</span> &nbsp;&nbsp;&nbsp;
                                    <strong>Total Amount:</strong> ₱<span id="machineTotalAmount">0.00</span>
                                </div>
                            </div>
                        </div>
