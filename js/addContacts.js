document.addEventListener("DOMContentLoaded", function () {
  const contactEntries = document.getElementById("contactEntries");
  const addContactEntry = document.getElementById("addContactEntry");

  if (!contactEntries || !addContactEntry) return;

  function updateAddButtonVisibility() {
    const currentCount = document.querySelectorAll(".contact-entry").length;
    if (currentCount >= 2) {
      addContactEntry.style.display = "none";
    } else {
      addContactEntry.style.display = "inline-block";
    }
  }

  // Initial check on load
  updateAddButtonVisibility();

  // Add a new contact entry
  addContactEntry.addEventListener("click", function () {
    if (document.querySelectorAll(".contact-entry").length >= 2) return;

    let newEntry = document.querySelector(".contact-entry").cloneNode(true);

    // Clear input values in the cloned entry
    newEntry.querySelectorAll("input, select").forEach((el) => {
      if (el.tagName === "SELECT") {
        el.selectedIndex = 0;
      } else {
        el.value = "";
      }
    });

    // Make the remove button visible for cloned items
    const removeBtnContainer = newEntry.querySelector(".contact-remove-container");
    if (removeBtnContainer) {
      removeBtnContainer.style.display = "block";
    }

    // Append the cloned entry
    contactEntries.appendChild(newEntry);
    updateAddButtonVisibility();
  });

  // Remove a contact entry
  contactEntries.addEventListener("click", function (e) {
    const removeBtn = e.target.closest(".remove-contact");
    if (removeBtn) {
      if (document.querySelectorAll(".contact-entry").length > 1) {
        removeBtn.closest(".contact-entry").remove();
        updateAddButtonVisibility();
      } else {
        alert("At least one contact entry is required.");
      }
    }
  });
});
