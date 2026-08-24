$(document).ready(function() {

    function calculateMachineTotals() {
        let totalQty = 0;
        let totalAmount = 0.0;

        $('#machinePricingCard .product-entry').each(function() {
            let qty = parseFloat($(this).find('input[name="quantity[]"]').val()) || 0;
            let amount = parseFloat($(this).find('input[name="productAmount[]"]').val()) || 0.0;
            
            totalQty += qty;
            totalAmount += (qty * amount);
        });

        $('#machineTotalQty').text(totalQty);
        $('#machineTotalAmount').text(totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

        // Handle Discount
        let isDiscountEnabled = $('#machineDiscountToggle').is(':checked');
        if (isDiscountEnabled) {
            $('#machineDiscountTypeGroup').show();
            $('#machineDiscountValue').show();
            $('#machineGrandTotalContainer').show();

            let discountType = $('input[name="machineDiscountType"]:checked').val();
            let discountValue = parseFloat($('#machineDiscountValue').val()) || 0.0;
            let grandTotal = totalAmount;

            if (discountType === 'percentage') {
                grandTotal = totalAmount - (totalAmount * (discountValue / 100));
            } else if (discountType === 'amount') {
                grandTotal = totalAmount - discountValue;
            }

            if (grandTotal < 0) grandTotal = 0;
            $('#machineGrandTotal').text(grandTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        } else {
            $('#machineDiscountTypeGroup').hide();
            $('#machineDiscountValue').hide();
            $('#machineGrandTotalContainer').hide();
        }
    }

    function calculateConsumableTotals() {
        let totalQty = 0;
        let totalAmount = 0.0;

        $('#consumablesPricingCard .product-entry').each(function() {
            let qty = parseFloat($(this).find('input[name="consumableQuantity[]"]').val()) || 0;
            let amount = parseFloat($(this).find('input[name="consumableAmount[]"]').val()) || 0.0;
            
            totalQty += qty;
            totalAmount += (qty * amount);
        });

        $('#consumableTotalQty').text(totalQty);
        $('#consumableTotalAmount').text(totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

        // Handle Discount
        let isDiscountEnabled = $('#consumableDiscountToggle').is(':checked');
        if (isDiscountEnabled) {
            $('#consumableDiscountTypeGroup').show();
            $('#consumableDiscountValue').show();
            $('#consumableGrandTotalContainer').show();

            let discountType = $('input[name="consumableDiscountType"]:checked').val();
            let discountValue = parseFloat($('#consumableDiscountValue').val()) || 0.0;
            let grandTotal = totalAmount;

            if (discountType === 'percentage') {
                grandTotal = totalAmount - (totalAmount * (discountValue / 100));
            } else if (discountType === 'amount') {
                grandTotal = totalAmount - discountValue;
            }

            if (grandTotal < 0) grandTotal = 0;
            $('#consumableGrandTotal').text(grandTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        } else {
            $('#consumableDiscountTypeGroup').hide();
            $('#consumableDiscountValue').hide();
            $('#consumableGrandTotalContainer').hide();
        }
    }

    // Event listeners for Machine inputs
    $(document).on('input', '#machinePricingCard input[name="quantity[]"], #machinePricingCard input[name="productAmount[]"], #machineDiscountValue', function() {
        calculateMachineTotals();
    });

    // Event listeners for Consumable inputs
    $(document).on('input', '#consumablesPricingCard input[name="consumableQuantity[]"], #consumablesPricingCard input[name="consumableAmount[]"], #consumableDiscountValue', function() {
        calculateConsumableTotals();
    });

    // Event listeners for discount toggles and radio buttons
    $(document).on('change', '#machineDiscountToggle, input[name="machineDiscountType"]', function() {
        calculateMachineTotals();
    });

    $(document).on('change', '#consumableDiscountToggle, input[name="consumableDiscountType"]', function() {
        calculateConsumableTotals();
    });

    // Also recalculate when a row is removed
    $(document).on('click', '.remove-entry', function() {
        // Use setTimeout to calculate after the row is actually removed from the DOM
        setTimeout(function() {
            calculateMachineTotals();
            calculateConsumableTotals();
        }, 10);
    });

    // Calculate initial totals on page load
    calculateMachineTotals();
    calculateConsumableTotals();
});
