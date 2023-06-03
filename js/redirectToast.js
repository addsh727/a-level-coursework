// Redirect Toast
function redirectToast(position) {
    const Toast = Swal.mixin({
        toast: true,
        position:           position,
        showConfirmButton: false,
        timer: 3300,
        timerProgressBar: true,
        didOpen: (toast) => {
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
            b.textContent = Math.round(Swal.getTimerLeft()/1000)
            }, 100)
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'error',
        html: 'Redirecting in <b></b>...'
    })
}