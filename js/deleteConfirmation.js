// Delete a record/entry function and confirmation popup
function submitForm(form) {
    Swal.fire({
        title:          "Are you sure?",
        text:           "This entry will be permanently deleted.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3eb768',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.isConfirmed) { form.submit(); }
    }); return false;
}