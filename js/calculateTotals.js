$(document).ready(function() {

    function calculateMachineTotals() {
        let totalQty = 0;
        let totalAmount = 0.0;

        $('#machinePricingCard .product-entry').each(function() {
            let qty = parseFloat($(this).find('input[name="quantity[]"]').val()) || 0;
            let amount = parseFloat($(this).find('input[name="productAmount[]"]').val()) || 0.0;
            
            totalQty += qty;
            totalAmount += amount; // Assuming the amount field is the total amount for that row.
            // If it should be unit price * qty, it would be: totalAmount += (qty * amount);
            // We'll just sum the amounts directly as they are typically inputted as row totals in such forms,
            // or if it's unit price, they can enter the multiplied amount. 
            // Wait, the prompt says "total of Quantity and Amount". So just sum them.
        });

        $('#machineTotalQty').text(totalQty);
        $('#machineTotalAmount').text(totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    }

    function calculateConsumableTotals() {
        let totalQty = 0;
        let totalAmount = 0.0;

        $('#consumablesPricingCard .product-entry').each(function() {
            let qty = parseFloat($(this).find('input[name="consumableQuantity[]"]').val()) || 0;
            let amount = parseFloat($(this).find('input[name="consumableAmount[]"]').val()) || 0.0;
            
            totalQty += qty;
            totalAmount += amount;
        });

        $('#consumableTotalQty').text(totalQty);
        $('#consumableTotalAmount').text(totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    }

    // Event listeners for Machine inputs
    $(document).on('input', '#machinePricingCard input[name="quantity[]"], #machinePricingCard input[name="productAmount[]"]', function() {
        calculateMachineTotals();
    });

    // Event listeners for Consumable inputs
    $(document).on('input', '#consumablesPricingCard input[name="consumableQuantity[]"], #consumablesPricingCard input[name="consumableAmount[]"]', function() {
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
