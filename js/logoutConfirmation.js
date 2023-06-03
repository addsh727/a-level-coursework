// Logout function and confirmation popup
function logoutAdmin(form) {
    Swal.fire({
        title:          "Are you sure?",
        text:           "You will be logged out from this admin panel.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3eb768',
        cancelButtonColor: '#d33',
        confirmButtonText: "Log Out"
    }).then((result) => {
        if (result.isConfirmed) { form.submit(); }
    }); return false;
}