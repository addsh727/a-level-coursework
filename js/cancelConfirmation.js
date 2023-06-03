// Cancel order function and confirmation popup
function submitForm(form) {
    Swal.fire({
        title:          "Are you sure?",
        text:           "This order will be permanently cancelled.",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3eb768',
        confirmButtonText: 'Cancel Order'
    }).then((result) => {
        if (result.isConfirmed) { form.submit(); }
    }); return false;
}