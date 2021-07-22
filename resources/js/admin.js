const delForm = document.querySelectorAll(".delete-apartment-form");

delForm.forEach(form => {
    form.addEventListener("submit", function(e) {
        const resp = confirm("Are you sure you want to delete it?");
        if (!resp) {
            e.preventDefault();
        }
    });
});
