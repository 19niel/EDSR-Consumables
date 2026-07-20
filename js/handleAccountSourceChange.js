// handleAccountSourceChange.js
// This script handles the change event for the account source dropdown and fetches the corresponding subcategories.
$(document).ready(function () {
  $("#accountSourceCategory").prop("disabled", true);

  $("#accountSource").on("change", function () {
    var accountSourceId = $(this).val();
    var isDisabled = $(this).is(':disabled') || $(this).data('was-disabled-by-bypass') === true;

    if (accountSourceId) {
      $("#accountSourceCategory")
        .prop("disabled", isDisabled)
        .html('<option value="N/A" disabled selected>Loading...</option>');

      $.ajax({
        url: "../php/subcategoryList.php",
        type: "POST",
        data: { account_id: accountSourceId },
        success: function (data) {
          if (data) {
            $("#accountSourceCategory").html(data);
            var savedValue = $("#accountSourceCategory").attr("data-saved-value");
            if (savedValue && savedValue !== "") {
              $("#accountSourceCategory").val(savedValue);
              $("#accountSourceCategory").removeAttr("data-saved-value");
            }
          } else {
            $("#accountSourceCategory")
              .prop("disabled", true)
              .html(
                '<option value="N/A" disabled selected>No subcategories available</option>'
              );
          }
        },
      });
    } else {
      $("#accountSourceCategory")
        .prop("disabled", true)
        .html('<option value="N/A" disabled selected>Choose...</option>');
    }
  });
});
