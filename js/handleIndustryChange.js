// handleIndustryChange.js
// This script handles the change event for the industry dropdown and fetches the corresponding subcategories.
$(document).ready(function () {
  $("#industrySubcategory").prop("disabled", true);

  $("#segment").on("change", function () {
    var industryId = $(this).val();
    var isDisabled = $(this).is(':disabled') || $(this).data('was-disabled-by-bypass') === true;

    if (industryId) {
      $("#industrySubcategory")
        .prop("disabled", isDisabled)
        .html('<option value="N/A" disabled selected>Loading...</option>');

      $.ajax({
        url: "../php/subcategoryList.php",
        type: "POST",
        data: { industry_id: industryId },
        success: function (data) {
          if (data) {
            $("#industrySubcategory").html(data);
            var savedValue = $("#industrySubcategory").attr("data-saved-value");
            if (savedValue && savedValue !== "") {
              $("#industrySubcategory").val(savedValue);
              $("#industrySubcategory").removeAttr("data-saved-value");
            }
          } else {
            $("#industrySubcategory")
              .prop("disabled", true)
              .html(
                '<option value="N/A" disabled selected>No subcategories available</option>'
              );
          }
        },
      });
    } else {
      $("#industrySubcategory")
        .prop("disabled", true)
        .html('<option value="N/A" disabled selected>Choose...</option>');
    }
  });
});
