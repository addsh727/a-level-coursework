// Success template for SweetAlert popups
function successAlert(title, message){
    $(function(){
        Swal.fire({
            'title': title,
            'text': message,
            'type': 'success',
            'icon': 'success',
            'showConfirmButton': 'true',
            'confirmButtonColor': '#777'
        })
    });
}