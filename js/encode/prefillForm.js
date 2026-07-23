document.addEventListener("DOMContentLoaded", function () {
  $.fn.triggerChangeBypass = function() {
    return this.each(function() {
      let $el = $(this);
      let wasDisabled = $el.prop('disabled');
      if (wasDisabled) {
        $el.data('was-disabled-by-bypass', true);
        $el.prop('disabled', false);
      }
      $el.trigger('change');
      if (wasDisabled) {
        $el.prop('disabled', true);
        $el.removeData('was-disabled-by-bypass');
      }
    });
  };

  // Extract the encoded ID from the URL query string
  const urlParams = new URLSearchParams(window.location.search);
  const encodedId = urlParams.get("id"); // The 'id' parameter in the URL

  if (encodedId) {
    // Fetch data based on the encoded ID
    document.getElementById("encodeId").value = encodedId;
    fetchData(encodedId);
  } else {
    console.error("Encoded ID not found in URL");
  }
});

function handleAccountData(accountData) {
  let accountExec = userName;
  let accountName = accountData[0].accName || "";

  console.log("Account Name:", accountName);
  console.log("Account Exec:", accountExec);

  const encodedAccountName = encodeURIComponent(accountName);
  const encodedAccountExec = encodeURIComponent(accountExec);

  const url = `${window.BASE_URL}php/fetchAutofillEncode.php?accountName=${encodedAccountName}&accountExec=${encodedAccountExec}`;

  fetch(url, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      if (data && data.success) {
        prefillForm(data.data); // Prefill the form with the fetched data
      } else {
        console.error("Failed to fetch data", data);
      }
    })
    .catch((error) => console.error("Error fetching data:", error));
}

// Function to fetch data based on encoded ID
function fetchData(encodedId) {
  fetch(`${window.BASE_URL}php/fetchDataEditEncode.php?id=${encodedId}`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      if (data && data.success) {
        prefillForm(data.data); // Prefill the form with the fetched data
      } else {
        console.error("Failed to fetch data");
      }
    })
    .catch((error) => console.error("Error fetching data:", error));
}

// Function to prefill the form with the fetched data
function prefillForm(data) {
  console.log("Prefilling data:", data); // Log the data for debugging

  document.getElementById("accountName").value = data.accName || "";
  document.getElementById("arsExpiryDate").value = data.arsExpiryDate || "";
  document.getElementById("address").value = data.address || "";

  // Handle Contact Information Array Inputs safely, supporting multiple entries
  const cpArray = (data.contactPerson || "").split(' / ');
  const desArray = (data.designation || "").split(' / ');
  const numArray = (data.contactNumber || "").split(' / ');
  const emailArray = (data.email || "").split(' / ');

  const contactEntriesContainer = document.getElementById("contactEntries");
  if (contactEntriesContainer) {
    const addButton = document.getElementById("addContactEntry");
    let allEntries = contactEntriesContainer.querySelectorAll(".contact-entry");

    cpArray.forEach((cp, index) => {
      let entry;
      if (index === 0) {
        entry = allEntries[0];
      } else {
        if (index >= allEntries.length && addButton && document.querySelectorAll(".contact-entry").length < 2) {
            addButton.click();
            allEntries = contactEntriesContainer.querySelectorAll(".contact-entry");
        }
        entry = allEntries[index];
      }
      
      if (entry) {
        const cpInput = entry.querySelector('input[name="contactPerson[]"]');
        if (cpInput) cpInput.value = cp;

        const desInput = entry.querySelector('input[name="designation[]"]');
        if (desInput) desInput.value = desArray[index] || "";

        const numInput = entry.querySelector('input[name="contactNumber[]"]');
        if (numInput) numInput.value = numArray[index] || "";

        const emailInput = entry.querySelector('input[name="emailAddress[]"]');
        if (emailInput) emailInput.value = emailArray[index] || "";
      }
    });
  }

  // Decision Maker Fields Lookup
  document.getElementById("dmEmail").value = data.decisionMakerEmail || "";
  document.getElementById("decisionMaker").value = data.decisionMaker || "";
  document.getElementById("dmDesignation").value = data.dmDesignation || "";

  // Project & Pricing Data Fields
  const proposedPriceElem = document.getElementById("proposedPrice");
  if (proposedPriceElem) proposedPriceElem.value = data.proposedPrice || "";
  
  const whatTranspiredElem = document.getElementById("whatTranspired");
  if (whatTranspiredElem) whatTranspiredElem.value = data.whatTranspired || "";
  
  const followUpActionElem = document.getElementById("followUpAction");
  if (followUpActionElem) followUpActionElem.value = data.actionFollow || "";

  const sbuElem = $("#sbu");
  if (sbuElem.length) sbuElem.val(data.sbu || "").triggerChangeBypass();
  
  const endUserTypeElem = $("#endUserType");
  if (endUserTypeElem.length) endUserTypeElem.val(data.endUser || "");
  
  const paymentTermsElem = $("#paymentTerms");
  if (paymentTermsElem.length) paymentTermsElem.val(data.paymentTerms || "");
  
  const contractTypeElem = $("#contractType");
  if (contractTypeElem.length) contractTypeElem.val(data.contactType || "");
  
  const callNatureElem = $("#callNature");
  if (callNatureElem.length) callNatureElem.val(data.callNature || "");
  
  const reminderDateElem = $("#reminderDate");
  if (reminderDateElem.length) reminderDateElem.val(data.reminderDate || "");
  $("#deliveryDate").val(data.deliveryDate || "");
  $("#contractEnd").val(data.contractEnd || "");
  $("#estimatedDelivery").val(data.estimatedDelivery || "");

  // Populate Region and trigger Province, City, and Barangay loading
  $("#region").val(data.region || "").triggerChangeBypass();

  setTimeout(() => {
    $("#province").val(data.province || "").triggerChangeBypass();
    setTimeout(() => {
      $("#city").val(data.city || "").triggerChangeBypass();
      setTimeout(() => {
        $("#barangay").val(data.barangay || "");
      }, 100);
    }, 100);
  }, 100);

  // Populate Segment and trigger Industry Subcategory loading
  $("#segment").val(data.segment || "").triggerChangeBypass();

  setTimeout(() => {
    $("#industrySubcategory").val(data.industrySubcategory || "");
  }, 100);

  // Populate Account Source and trigger Account Source Category loading
  $("#accountSource").val(data.accSource || "").triggerChangeBypass();

  setTimeout(() => {
    $("#accountSourceCategory").val(data.accountSourceCategory || "");
  }, 100);

  // Populate Account Category and trigger visibility check
  $("#accountCategory").val(data.accCat || "").triggerChangeBypass();

  // Handle Existing System & End of Competitor Date visibility
  if (data.accCat === "NEW") {
    document.getElementById("existingSystemContainer").style.display = "block";
    document.getElementById("contractEndCompetitorContainer").style.display = "block";

    document.getElementById("existingSystem").value = data.existingSystem || "";
    document.getElementById("contractEndCompetitor").value = data.endOfContractCompetitor || "";

    document.getElementById("existingSystem").required = true;
    document.getElementById("contractEndCompetitor").required = true;
  } else {
    document.getElementById("existingSystemContainer").style.display = "none";
    document.getElementById("contractEndCompetitorContainer").style.display = "none";

    document.getElementById("existingSystem").required = false;
    document.getElementById("contractEndCompetitor").required = false;
  }

  // Populate Account Status and trigger Reason Subcategory loading
  $("#reasonSubcategory").attr("data-saved-value", data.reasonSubcategory || "");
  $("#accountStatus").val(data.accStatus || "").triggerChangeBypass();

  if (data.accStatus === "230") {
    document.getElementById("deliveryDateContainer").style.display = "block";
    document.getElementById("contractEndContainer").style.display = "block";

    document.getElementById("deliveryDate").value = data.deliveryDate || "";
    document.getElementById("contractEnd").value = data.endOfContract || "";

    document.getElementById("deliveryDate").required = true;
    document.getElementById("contractEnd").required = true;
  } else {
    document.getElementById("deliveryDateContainer").style.display = "none";
    document.getElementById("contractEndContainer").style.display = "none";

    document.getElementById("deliveryDate").required = false;
    document.getElementById("contractEnd").required = false;
  }

  // Prefill product entries
  if (data.products && Array.isArray(data.products)) {
    const productEntriesContainer = document.getElementById("productEntries");
    const addButton = document.getElementById("addProductEntry");

    let firstEntry = productEntriesContainer.querySelector(".product-entry");

    data.products.forEach((product, index) => {
      let entry;

      if (index === 0) {
        entry = firstEntry;
      } else {
        addButton.click();
        const allEntries = productEntriesContainer.querySelectorAll(".product-entry");
        entry = allEntries[allEntries.length - 1];
      }

      // Fill in initial product fields
      const productTypeSelect = entry.querySelector('select[name="productType[]"]');
      const deviceConditionSelect = entry.querySelector('select[name="deviceCondition[]"]');
      const quantityInput = entry.querySelector('input[name="quantity[]"]');
      const subcatSelect = entry.querySelector('select[name="productTypeSubcategory[]"]');

      productTypeSelect.value = product.productTypeID || "";
      deviceConditionSelect.value = product.deviceConditionID || "";
      quantityInput.value = product.quantity || "";

      // Trigger change to populate subcategories
      $(productTypeSelect).triggerChangeBypass();

      const targetSubcat = product.productSubcategoryID || "";

      // Retry logic until subcategory is present
      let attempts = 0;
      const maxAttempts = 30;
      const retryInterval = setInterval(() => {
        const subcatOptions = Array.from(subcatSelect.options).map((opt) => opt.value);
        if (subcatOptions.includes(targetSubcat)) {
          subcatSelect.value = targetSubcat;
          $(subcatSelect).triggerChangeBypass();
          clearInterval(retryInterval);
        } else if (++attempts >= maxAttempts) {
          clearInterval(retryInterval);
          console.warn(`Subcategory ID ${targetSubcat} not found for productTypeID ${product.productTypeID}`);
        }
      }, 100);
    });
  }

  // FIXED: MASTER LOCK OVERRIDE BYPASS
  // If the admin master control button was unlocked BEFORE the data finishes pre-filling, 
  // ensure the fields are completely unlocked.
  setTimeout(() => {
    const adminState = document.getElementById('isAdminEdit') ? document.getElementById('isAdminEdit').value : "false";
    if (adminState === "true") {
      var allControls = document.querySelectorAll('#editEncodeForm input, #editEncodeForm select, #editEncodeForm textarea');
      allControls.forEach(function (el) {
        el.disabled = false;
        el.removeAttribute('disabled');
        el.classList.remove('disabled');
      });
      var actionBtns = document.querySelectorAll('#editEncodeForm button, .add-product-btn, .remove-product-btn');
      actionBtns.forEach(function (btn) {
        btn.disabled = false;
        btn.removeAttribute('disabled');
      });
    }
  }, 500);
}
