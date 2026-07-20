                        <div class="card p-4 shadow-sm mb-4">
                            <h5 class="text-secondary fw-semibold mb-3">Pipeline Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="sbu" class="form-label">SBU/Segment<span class="req">*</span></label>
                                    <select id="sbu" name="sbu" class="form-select" disabled required>
                                        <option value="N/A" disabled>Choose...</option>
                                        <?php foreach ($sbuResult as $sbuRow) { 
                                            $selected = (isset($row['sbu']) && $row['sbu'] === $sbuRow['category_name']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $sbuRow['category_name']; ?>" <?php echo $selected; ?>><?php echo $sbuRow['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="accountExecutive" class="form-label">Account Executive<span class="req">*</span></label>
                                    <?php
                                    $savedExecutive = $row['accExec'] ?? $row['accountExecutive'] ?? ''; 

                                    if (($category ?? '') === 'User') { ?>
                                        <input type="text" class="form-control" id="accountExecutive" name="accountExecutive" 
                                            value="<?php echo htmlspecialchars(!empty($savedExecutive) ? $savedExecutive : ($name ?? '')); ?>" readonly required />
                                    <?php } else if (($category ?? '') === 'Manager') { ?>
                                        <select id="accountExecutive" name="accountExecutive" class="form-select" disabled required>
                                            <option value="" disabled>Choose Executive...</option>
                                            <?php 
                                            if (!empty($userArrayManager)) {
                                                foreach ($userArrayManager as $managerUser) {
                                                    $selected = ($managerUser['name'] === $savedExecutive) ? 'selected' : '';
                                                    echo '<option value="' . htmlspecialchars($managerUser['name']) . '" ' . $selected . '>' . htmlspecialchars($managerUser['name']) . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    <?php } else { ?>
                                        <select id="accountExecutive" name="accountExecutive" class="form-select" disabled required>
                                            <option value="" disabled>Choose Executive...</option>
                                            <?php 
                                            if (!empty($userArray)) {
                                                foreach ($userArray as $adminUser) {
                                                    $selected = ($adminUser['name'] === $savedExecutive) ? 'selected' : '';
                                                    echo '<option value="' . htmlspecialchars($adminUser['name']) . '" ' . $selected . '>' . htmlspecialchars($adminUser['name']) . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="callDate" class="form-label">Date of Activity<span class="req">*</span></label>
                                    <input type="date" class="form-control" disabled required id="callDate" name="callDate" min="<?php echo $min; ?>" max="<?php echo $max; ?>" value="<?php echo htmlspecialchars($row['callDate'] ?? '');  ?>"/>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="team" class="form-label">Team<span class="req">*</span></label>
                                    <select name="team" class="form-control form-select" id="team" required disabled>
                                        <option value="" disabled <?php echo (!isset($row['team']) || empty($row['team'])) ? 'selected' : ''; ?>>-- Select Team --</option>
                                        <option value="MAKATI" <?php echo (isset($row['team']) && $row['team'] == 'MAKATI') ? 'selected' : ''; ?>>Makati</option>
                                        <option value="QC" <?php echo (isset($row['team']) && $row['team'] == 'QC') ? 'selected' : ''; ?>>QC/Ortigas</option>
                                        <option value="MANILA" <?php echo (isset($row['team']) && $row['team'] == 'MANILA') ? 'selected' : ''; ?>>Manila</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="text-secondary my-4">

                        <div class="card p-4 shadow-sm mb-4">
                            <h5 class="text-secondary fw-semibold mb-3">Client Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="customerId" class="form-label">Customer ID</label>
                                    <input type="text" class="form-control" id="customerId" name="customerId" disabled value="<?php echo htmlspecialchars($row['customerId'] ?? ''); ?>"/>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 position-relative">
                                    <label for="accountName" class="form-label">Account Name<span class="req">*</span></label>
                                    <input type="text" class="form-control" id="accountName" name="accountName" disabled required onchange="searchAccounts(this.value)" value="<?php echo htmlspecialchars($row['accName'] ?? ''); ?>"/>
                                    <ul id="accountList" class="account-list"></ul>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="arsExpiryDate" class="form-label">ARS Expiry Date</label>
                                    <input type="date" class="form-control" id="arsExpiryDate" name="arsExpiryDate" disabled required min="<?php echo $min_expiry; ?>" value="<?php echo htmlspecialchars(($row['arsExpiryDate'] ?? '') !== '0000-00-00' ? $row['arsExpiryDate'] : ''); ?>"/>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="accountCategory" class="form-label">Account Category<span class="req">*</span></label>
                                    <select id="accountCategory" name="accountCategory" class="form-select" disabled required>
                                        <option value="N/A" disabled>Choose...</option>
                                        <?php foreach ($accountCategoryResult as $accountCategoryRow) { 
                                            $selected = (isset($row['accCat']) && $row['accCat'] === $accountCategoryRow['category_name']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $accountCategoryRow['category_name']; ?>" <?php echo $selected; ?>><?php echo $accountCategoryRow['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3" id="existingSystemContainer">
                                    <label for="existingSystem" class="form-label">Existing System</label>
                                    <select id="existingSystem" name="existingSystem" class="form-select" disabled required>
                                        <option value="N/A" <?php echo empty($row['existingSystem']) ? 'selected' : ''; ?>>Choose...</option>
                                        <?php foreach ($existingSystemResult as $existingSystemRow) { 
                                            $selected = (isset($row['existingSystem']) && $row['existingSystem'] === $existingSystemRow['category_name']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $existingSystemRow['category_name']; ?>" <?php echo $selected; ?>><?php echo $existingSystemRow['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3" id="contractEndCompetitorContainer">
                                    <label for="contractEndCompetitor" class="form-label">End of Contract (Competitor)</label>
                                    <input type="date" class="form-control" id="contractEndCompetitor" name="contractEndCompetitor" disabled required min="<?php echo $min_expiry; ?>" value="<?php echo htmlspecialchars(($row['endOfContractCompetitor'] ?? '') !== '0000-00-00' ? $row['endOfContractCompetitor'] : ''); ?>" />
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="endUserType" class="form-label">Type of End-User<span class="req">*</span></label>
                                    <select id="endUserType" name="endUserType" class="form-select" disabled required>
                                        <option value="N/A" disabled>Choose...</option>
                                        <?php foreach ($endUserTypeResult as $endUserTypeRow) { 
                                            $selected = (isset($row['endUser']) && $row['endUser'] === $endUserTypeRow['category_name']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $endUserTypeRow['category_name']; ?>" <?php echo $selected; ?>><?php echo $endUserTypeRow['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="segment" class="form-label">Industry<span class="req">*</span></label>
                                    <select id="segment" name="segment" class="form-select" disabled required>
                                        <option value="N/A" disabled>Choose...</option>
                                        <?php foreach ($segmentResult as $segmentRow) { 
                                            $selected = (isset($row['industry']) && $row['industry'] == $segmentRow['id']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $segmentRow['id']; ?>" <?php echo $selected; ?>><?php echo $segmentRow['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="industrySubcategory" class="form-label">Industry Subcategory</label>
                                    <select id="industrySubcategory" name="industrySubcategory" class="form-select" disabled required data-saved-value="<?php echo htmlspecialchars($row['industrySubcategory'] ?? ''); ?>">
                                        <option value="N/A">Choose...</option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="accountSource" class="form-label">Lead Source<span class="req">*</span></label>
                                    <select id="accountSource" name="accountSource" class="form-select" disabled required>
                                        <option value="N/A" disabled>Choose...</option>
                                        <?php 
                                        if (isset($accountSourceResult)) {
                                            mysqli_data_seek($accountSourceResult, 0);
                                            while ($accountSourceRow = mysqli_fetch_assoc($accountSourceResult)) { 
                                                $selected = (isset($row['accSource']) && $row['accSource'] == $accountSourceRow['id']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $accountSourceRow['id']; ?>" <?php echo $selected; ?>><?php echo $accountSourceRow['category_name']; ?></option>
                                            <?php } 
                                        } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="accountSourceCategory" class="form-label">Lead Subcategory</label>
                                    <select id="accountSourceCategory" name="accountSourceCategory" class="form-select" disabled required data-saved-value="<?php echo htmlspecialchars($row['accSourceSubcategory'] ?? ''); ?>">
                                        <option value="N/A">Choose...</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="text-secondary my-4">

                        <div class="card p-4 shadow-sm mb-4">
                            <h5 class="text-secondary fw-semibold mb-3">Client Location Details</h5>
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label for="branch1" class="form-label">Branch<span class="req">*</span></label>
                                    <select name="branch1" class="form-control form-select" id="branch1" disabled required>
                                        <option value="" disabled>-- Select Branch --</option>
                                        <?php 
                                        $branches = ['MM', 'ANG', 'CAB', 'LAU', 'BAT', 'NAG', 'SUB', 'BAC', 'CEB', 'DUM', 'ILO', 'TAC', 'CDO', 'DAV', 'GEN', 'ZAM'];
                                        foreach($branches as $b) {
                                            $selected = (isset($row['branch1']) && $row['branch1'] === $b) ? 'selected' : '';
                                            echo "<option value=\"$b\" $selected>$b</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="region1" class="form-label">Region<span class="req">*</span></label>
                                    <select name="region1" class="form-control form-select" id="region1" disabled required>
                                        <option value="" disabled>-- Select Region --</option>
                                        <?php 
                                        $regions = ['MM', 'LUZON', 'VISAYAS', 'MINDANAO'];
                                        foreach($regions as $r) {
                                            $selected = (isset($row['region1']) && $row['region1'] === $r) ? 'selected' : '';
                                            echo "<option value=\"$r\" $selected>$r</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="address" class="form-label">Address<span class="req">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($row['address'] ?? ''); ?>" disabled required/>
                                </div>
                            </div>
                        </div>
