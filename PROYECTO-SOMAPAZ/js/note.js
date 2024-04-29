document.addEventListener("DOMContentLoaded", function () {
  const selectElement = document.getElementById("notesSelect");
  const otherTextareaElement = document.getElementById("otherTextarea");

  selectElement.addEventListener("change", function () {
    if (selectElement.value === "other") {
      otherTextareaElement.classList.remove("d-none");
    } else {
      otherTextareaElement.classList.add("d-none");
    }
  });

  otherTextareaElement.addEventListener("input", function () {
    selectElement.value = otherTextareaElement.value;
  });
});
