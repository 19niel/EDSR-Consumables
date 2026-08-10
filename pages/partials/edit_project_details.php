                        <hr class="text-secondary my-4">

                        <div class="card p-4 shadow-sm mb-4">
                            <h5 class="text-secondary fw-semibold mb-3">Project Details</h5>
                            <div class="row g-3">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="projTitle" class="form-label">Company Name / Project Title<span class="req">*</span></label>
                                    <input type="text" class="form-control" id="projTitle" name="projTitle" disabled value="<?php echo htmlspecialchars($row['projTitle'] ?? ''); ?>" required/>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="proposedPrice" class="form-label">Proposed Price</label>
                                    <input type="text" class="form-control" id="proposedPrice" name="proposedPrice" disabled value="<?php echo htmlspecialchars($row['proposedPrice'] ?? ''); ?>"/>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label class="form-label d-block">VAT <span class="req">*</span></label>
                                    <div class="btn-group w-100" role="group" aria-label="VAT Type">
                                        <input type="radio" class="btn-check" name="vatType" id="vatInclusive" value="Inclusive" disabled <?php echo (isset($row['vatType']) && $row['vatType'] == 'Inclusive') ? 'checked' : ''; ?> required>
                                        <label class="btn btn-outline-secondary text-dark" for="vatInclusive">Inclusive</label>
                                        
                                        <input type="radio" class="btn-check" name="vatType" id="vatExclusive" value="Exclusive" disabled <?php echo (isset($row['vatType']) && $row['vatType'] == 'Exclusive') ? 'checked' : ''; ?> required>
                                        <label class="btn btn-outline-secondary text-dark" for="vatExclusive">Exclusive</label>
                                    </div>
                                    <style>
                                        .btn-check:checked + .btn-outline-secondary {
                                            background-color: #0d6efd !important;
                                            color: white !important;
                                            border-color: #0d6efd !important;
                                        }
                                        .btn-check:disabled + .btn-outline-secondary {
                                            opacity: 0.65;
                                        }
                                    </style>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="paymentTerms" class="form-label">Terms of Payment<span class="req">*</span></label>
                                    <select id="paymentTerms" name="paymentTerms" class="form-select" disabled>
                                        <option value="N/A" disabled>Choose...</option>
                                        <?php foreach ($paymentTermsResult as $paymentTermsRow) { 
                                            $selected = (isset($row['paymentTerms']) && $row['paymentTerms'] === $paymentTermsRow['category_name']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $paymentTermsRow['category_name']; ?>" <?php echo $selected; ?>><?php echo $paymentTermsRow['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="contractType" class="form-label">Contract Type<span class="req">*</span></label>
                                    <select id="contractType" name="contractType" class="form-select" disabled>
                                        <option value="N/A" disabled>Choose...</option>
                                        <?php foreach ($contractTypeResult as $contractTypeRow) { 
                                            $selected = (isset($row['contactType']) && $row['contactType'] === $contractTypeRow['category_name']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $contractTypeRow['category_name']; ?>" <?php echo $selected; ?>><?php echo $contractTypeRow['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                              
                                <div class="col-lg-8 col-xl-6">
                                    <label for="projectAddress" class="form-label">Project Address<span class="req">*</span></label>
                                    <input type="text" class="form-control" id="projectAddress" name="projectAddress" disabled value="<?php echo htmlspecialchars($row['projAddress'] ?? ''); ?>" required/>
                                </div>
                            </div>
                        </div>

