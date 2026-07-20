/**
 * handleConsumableChange.js
 *
 * Cascade chain for the Consumables section:
 *   Product Type → (existing handleProductTypeChange.js handles) → Model
 *   Model (.productTypeSubcategory inside #consumableEntries) → Consumable (.consumableName)
 *   Consumable (.consumableName) → Item Code (.itemCode)
 */
$(document).ready(function () {

    // ─────────────────────────────────────────────────────────────────
    // 1. Model selected → load Consumables
    // ─────────────────────────────────────────────────────────────────
    $(document).on('change', '#consumableEntries .productTypeSubcategory', function () {
        var modelId   = $(this).val();
        var isDisabled = $(this).is(':disabled') || $(this).data('was-disabled-by-bypass') === true;
        var container = $(this).closest('.product-entry');
        var consumableSelect = container.find('.consumableName');
        var itemCodeSelect   = container.find('.itemCode');

        // Reset downstream dropdowns
        itemCodeSelect
            .prop('disabled', true)
            .html('<option value="N/A" selected disabled>Choose...</option>');

        if (!modelId || modelId === 'N/A') {
            consumableSelect
                .prop('disabled', true)
                .html('<option value="N/A" selected disabled>Choose...</option>');
            return;
        }

        consumableSelect
            .prop('disabled', isDisabled)
            .html('<option value="N/A" disabled selected>Loading...</option>');

        $.ajax({
            url:  '../php/getConsumables.php',
            type: 'POST',
            data: { model_id: modelId },
            success: function (data) {
                if (data.trim()) {
                    consumableSelect.html(
                        '<option value="N/A" disabled selected>Choose Consumable...</option>' + data
                    );
                    // Restore saved value if present (for edit forms)
                    var saved = consumableSelect.attr('data-saved-value');
                    if (saved) {
                        consumableSelect.val(saved).removeAttr('data-saved-value');
                        let wasDisabled = consumableSelect.prop('disabled');
                        if (wasDisabled) {
                            consumableSelect.data('was-disabled-by-bypass', true);
                            consumableSelect.prop('disabled', false);
                        }
                        consumableSelect.trigger('change');
                        if (wasDisabled) {
                            consumableSelect.prop('disabled', true);
                            consumableSelect.removeData('was-disabled-by-bypass');
                        }
                    }
                } else {
                    consumableSelect
                        .prop('disabled', true)
                        .html('<option value="N/A" disabled selected>No consumables found</option>');
                }
            },
            error: function () {
                consumableSelect
                    .prop('disabled', true)
                    .html('<option value="N/A" disabled selected>Error loading consumables</option>');
            }
        });
    });

    // ─────────────────────────────────────────────────────────────────
    // 2. Consumable selected → load Item Codes
    // ─────────────────────────────────────────────────────────────────
    $(document).on('change', '.consumableName', function () {
        var consumableId = $(this).val();
        var isDisabled = $(this).is(':disabled') || $(this).data('was-disabled-by-bypass') === true;
        var container    = $(this).closest('.product-entry');
        var itemCodeSelect = container.find('.itemCode');

        if (!consumableId || consumableId === 'N/A') {
            itemCodeSelect
                .prop('disabled', true)
                .html('<option value="N/A" selected disabled>Choose...</option>');
            return;
        }

        itemCodeSelect
            .prop('disabled', isDisabled)
            .html('<option value="N/A" disabled selected>Loading...</option>');

        $.ajax({
            url:  '../php/getItemCodes.php',
            type: 'POST',
            data: { consumable_id: consumableId },
            success: function (data) {
                if (data.trim()) {
                    itemCodeSelect.html(
                        '<option value="N/A" disabled selected>Choose Item Code...</option>' + data
                    );
                    // Restore saved value if present (for edit forms)
                    var saved = itemCodeSelect.attr('data-saved-value');
                    if (saved) {
                        itemCodeSelect.val(saved).removeAttr('data-saved-value');
                    }
                } else {
                    itemCodeSelect
                        .prop('disabled', true)
                        .html('<option value="N/A" disabled selected>No item codes found</option>');
                }
            },
            error: function () {
                itemCodeSelect
                    .prop('disabled', true)
                    .html('<option value="N/A" disabled selected>Error loading item codes</option>');
            }
        });
    });

    // ─────────────────────────────────────────────────────────────────
    // 3. Clone fix: reset consumable + item code when "Add Another" clones a row
    //    (the existing addConsumableEntry logic in encode.php resets selects,
    //     so we just ensure the new row's consumableName & itemCode are reset too)
    // ─────────────────────────────────────────────────────────────────
    $('#addConsumableEntry').on('click', function () {
        // Give the DOM a tick to append the cloned row, then reset
        setTimeout(function () {
            var lastEntry = $('#consumableEntries .product-entry').last();
            lastEntry.find('.consumableName')
                .prop('disabled', true)
                .html('<option value="N/A" selected disabled>Choose...</option>');
            lastEntry.find('.itemCode')
                .prop('disabled', true)
                .html('<option value="N/A" selected disabled>Choose...</option>');
        }, 10);
    });
});
