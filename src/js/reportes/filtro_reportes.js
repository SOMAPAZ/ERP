(() => {
    const dropdownCategoryButton = document.querySelector("#dropdownCategoryButton");
    const dropdownIncidenceButton = document.querySelector("#dropdownIncidenceButton");

    if(dropdownCategoryButton && dropdownIncidenceButton) {
        const dropdownCategory = document.querySelector("#dropdownCategory");
        const btnDropdownCategoryClose = document.querySelector("#btnDropdownCategoryClose");
        dropdownCategoryButton.addEventListener("click", () => dropdownCategory.classList.toggle("hidden"));
        btnDropdownCategoryClose.addEventListener("click", () => dropdownCategory.classList.add("hidden"));

        const dropdownIncidence = document.querySelector("#dropdownIncidence");
        const btnDropdownIncidenceClose = document.querySelector("#btnDropdownIncidenceClose");
        dropdownIncidenceButton.addEventListener("click", () => dropdownIncidence.classList.toggle("hidden"));
        btnDropdownIncidenceClose.addEventListener("click", () => dropdownIncidence.classList.add("hidden"));
    }
})();
