// Error template for SweetAlert popups
function errorAlert(title, message){
    $(function(){
        Swal.fire({
            'title':        title,
            'text':         message,
            'type': 'error',
            'icon': 'error',
            'showConfirmButton': 'true',
            'confirmButtonColor': '#777'
        })
    });
}