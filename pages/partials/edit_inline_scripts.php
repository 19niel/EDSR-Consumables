    <script>
        var userCategory = '<?php echo $category; ?>';
        var userName = '<?php echo $name; ?>';
        var userArrayManager = <?php echo $userArrayManagerJson; ?>;
        var userArrayAdmin = <?php echo $userArrayAdminJson; ?>;
        var category = "<?php echo $category; ?>";

        function verifyAdminPassword() {
            if (document.getElementById('isAdminEdit').value === "true") {
                if (typeof isvalid === "function" && !isvalid()) {
                    return false;
                }
                document.getElementById('editEncodeForm').submit();
                return;
            }

            var verifyCheck = prompt("Enter administrative authorization password to unlock master fields:");
            if (verifyCheck === "admin123") {
                document.getElementById('isAdminEdit').value = "true";
                var allFormControls = document.querySelectorAll('#editEncodeForm input, #editEncodeForm select, #editEncodeForm textarea');
                allFormControls.forEach(function(element) {
                    element.disabled = false;
                    element.removeAttribute('disabled');
                });
                
                // Keep structural fields matching standard layout dependencies active
                document.getElementById('addProductEntry').disabled = false;
                document.getElementById('addProductEntry').removeAttribute('disabled');
                var addConsumable = document.getElementById('addConsumableEntry');
                if (addConsumable) {
                    addConsumable.disabled = false;
                    addConsumable.removeAttribute('disabled');
                }
                document.getElementById('addContactEntry').disabled = false;
                document.getElementById('addContactEntry').removeAttribute('disabled');
                
                var adminBtn = document.querySelector("button[onclick='verifyAdminPassword()']");
                adminBtn.className = "btn btn-primary px-3 fw-medium d-flex align-items-center gap-2 shadow-sm rounded-3";
                adminBtn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Save Master Updates';
                
                if (window.jQuery) {
                    $('#sbu').trigger('change');
                }
                
                alert("Authorization Successful: All master fields, product lists, and contact arrays are now unlocked for editing. Click this button again to commit updates.");
            } else if (verifyCheck !== null) {
                alert("Unauthorized: Incorrect administrative verification password.");
            }
        }

        function submitLogOnly() {
            document.getElementById('isAdminEdit').value = "false";
            var requiredElements = document.querySelectorAll('#editEncodeForm [required]');
            requiredElements.forEach(function(element) {
                if (!element.closest('.card').innerHTML.includes('Progress Updates')) {
                    element.removeAttribute('required');
                    element.removeAttribute('disabled'); 
                }
            });
            document.getElementById('editEncodeForm').submit();
        }
    </script>

    <script>
        $(document).ready(function () {
            // ── SBU card visibility ──────────────────────────────────────────────
            function toggleInputs(containerId, enable) {
                $(containerId).find('input, select, textarea').each(function () {
                    if (enable) {
                        $(this).prop('disabled', false);
                        if ($(this).hasClass('productTypeSubcategory') || $(this).hasClass('itemCode')) {
                            var parent = $(this).closest('.product-entry');
                            var typeVal = parent.find('.productType').val() || parent.find('.deviceCondition').val();
                            if (!typeVal || typeVal === 'N/A') {
                                $(this).prop('disabled', true);
                            }
                        }
                    } else {
                        $(this).prop('disabled', true);
                    }
                });
            }

            function checkSBU() {
                var sbuVal = $('#sbu').val();
                var sbuId = $('#sbu').find('option:selected').attr('data-id');
                
                if (!sbuVal || sbuVal === 'N/A') {
                    $('#machinePricingCard').hide();
                    $('#consumablesPricingCard').hide();
                    return;
                }
                var trimmed = sbuVal.trim();
                var isAdminEdit = document.getElementById('isAdminEdit') &&
                                  document.getElementById('isAdminEdit').value === 'true';
                                  
                if (sbuId == '339' || sbuId == '340' || sbuId == '341' || trimmed === 'OP MFP' || trimmed === 'OP - PP' || trimmed === 'OP - Riso') {
                    $('#machinePricingCard').show();
                    $('#consumablesPricingCard').hide();
                    if (isAdminEdit) toggleInputs('#machinePricingCard', true);
                    toggleInputs('#consumablesPricingCard', false);
                } else if (sbuId == '342' || sbuId == '343' || trimmed === 'OP - Consumables' || trimmed === 'KM Kitbuyer' || trimmed === 'RISO Kitbuyer') {
                    $('#machinePricingCard').hide();
                    $('#consumablesPricingCard').show();
                    toggleInputs('#machinePricingCard', false);
                    if (isAdminEdit) toggleInputs('#consumablesPricingCard', true);
                } else {
                    $('#machinePricingCard').hide();
                    $('#consumablesPricingCard').hide();
                    toggleInputs('#machinePricingCard', false);
                    toggleInputs('#consumablesPricingCard', false);
                }
            }

            // Run on page load to reveal the correct card for the saved SBU
            checkSBU();

            // Re-evaluate if user changes SBU (only possible after admin unlock)
            $('#sbu').on('change', function () {
                checkSBU();
            });

            // Dynamically enable/disable Item Code based on Consumables selection
            $(document).on('change', '.deviceCondition', function () {
                var container = $(this).closest('.product-entry');
                var itemCodeSelect = container.find('.itemCode');
                var val = $(this).val();
                if (val && val !== 'N/A') {
                    itemCodeSelect.prop('disabled', false);
                } else {
                    itemCodeSelect.prop('disabled', true).val('N/A');
                }
            });

            // ── Machine product entry add / remove ───────────────────────────────
            $('#addProductEntry').on('click', function () {
                var newEntry = $('#productEntries .product-entry').first().clone();
                newEntry.find('input, select').each(function () {
                    if ($(this).is('select')) {
                        $(this).prop('selectedIndex', 0);
                        if ($(this).hasClass('productTypeSubcategory')) {
                            $(this).prop('disabled', true).html('<option value="N/A" selected disabled>Choose...</option>');
                        }
                    } else {
                        $(this).val('');
                    }
                });
                $('#productEntries').append(newEntry);
            });

            $('#productEntries').on('click', '.remove-entry', function () {
                if ($('#productEntries .product-entry').length > 1) {
                    $(this).closest('.product-entry').remove();
                } else {
                    alert('At least one product entry is required.');
                }
            });

            // ── Consumable entry add / remove ────────────────────────────────────
            $('#addConsumableEntry').on('click', function () {
                var newEntry = $('#consumableEntries .product-entry').first().clone();
                newEntry.find('input, select').each(function () {
                    if ($(this).is('select')) {
                        $(this).prop('selectedIndex', 0);
                        if ($(this).hasClass('productTypeSubcategory') || $(this).hasClass('itemCode')) {
                            $(this).prop('disabled', true).html('<option value="N/A" selected disabled>Choose...</option>');
                        }
                    } else {
                        $(this).val('');
                    }
                });
                $('#consumableEntries').append(newEntry);
            });

            $('#consumableEntries').on('click', '.remove-entry', function () {
                if ($('#consumableEntries .product-entry').length > 1) {
                    $(this).closest('.product-entry').remove();
                } else {
                    alert('At least one consumable entry is required.');
                }
            });
        });
    </script>
