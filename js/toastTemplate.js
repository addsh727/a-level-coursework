function toastAlert(position, type, message){ // SweetAlert toast template
    const Toast = Swal.mixin({
        toast: true,
        position:       position,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon:           type,
        title:          message
    })
}