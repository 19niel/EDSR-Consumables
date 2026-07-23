                        <hr class="text-secondary my-4">

                        <div class="card p-4 shadow-sm mb-4">
                            <h5 class="text-secondary fw-semibold mb-3">Contact Information</h5>
                            <div id="contactEntries" class="mb-3">
                                <?php
                                $contactPersons = explode(' / ', $row['contactPerson'] ?? '');
                                $designations = explode(' / ', $row['designation'] ?? '');
                                $contactNumbers = explode(' / ', $row['contactNumber'] ?? '');
                                $emails = explode(' / ', $row['email'] ?? '');

                                $contactCount = max(count($contactPersons), 1);
                                for ($i = 0; $i < $contactCount; $i++) {
                                    $cp = $contactPersons[$i] ?? '';
                                    $desig = $designations[$i] ?? '';
                                    $cn = $contactNumbers[$i] ?? '';
                                    $em = $emails[$i] ?? '';
                                ?>
                                <div class="row contact-entry g-3 mb-3 align-items-end">
                                    <div class="col-md-6 col-lg-3">
                                        <label class="form-label">Contact Person<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="contactPerson[]" disabled value="<?php echo htmlspecialchars($cp); ?>" required />
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <label class="form-label">Contact Person Designation<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="designation[]" disabled value="<?php echo htmlspecialchars($desig); ?>" required />
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <label class="form-label">Contact Details<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="contactNumber[]" disabled value="<?php echo htmlspecialchars($cn); ?>" required />
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <label class="form-label">Email Address<span class="req">*</span></label>
                                        <input type="email" class="form-control" name="emailAddress[]" disabled value="<?php echo htmlspecialchars($em); ?>" required />
                                    </div>
                                    <div class="col-12 text-end contact-remove-container" style="<?php echo $contactCount > 1 ? 'display: block;' : 'display: none;'; ?>">
                                        <button type="button" class="btn btn-danger btn-sm remove-contact" disabled><i class="fa fa-trash"></i> Remove Contact</button>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="addContactEntry" disabled>Add Another Contact</button>
                                </div>
                            </div>

                            <div class="row g-3 border-top pt-3">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="decisionMaker" class="form-label">Decision Maker</label>
                                    <input type="text" class="form-control" id="decisionMaker" name="decisionMaker" disabled value="<?php echo htmlspecialchars($row['decisionMaker'] ?? ''); ?>" />
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="dmDesignation" class="form-label">Decision Maker Designation</label>
                                    <input type="text" class="form-control" id="dmDesignation" name="dmDesignation" disabled value="<?php echo htmlspecialchars($row['dmDesignation'] ?? ''); ?>" />
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="dmEmail" class="form-label">Decision Maker Email</label>
                                    <input type="email" class="form-control" id="dmEmail" name="dmEmail" disabled value="<?php echo htmlspecialchars($row['decisionMakerEmail'] ?? ''); ?>" />
                                </div>
                            </div>
                        </div>

