$(document).ready(function () { // Shopping cart functionality
    // When the customer updates desired quantity counter in shopping cart
    $(document).on('click', '.updateQuantity', function (e) {
        e.preventDefault();

        // Retrieve product ID and desired quantity
        var productID = $(this).closest(".productDetails").find(".productID").val();
        var productQuantity = $(this).closest(".productDetails").find(".inputQuantity").val();

        // Fire AJAX request to process the customer's action for their cart with the above data
        $.ajax({
            method: "POST",
            url: "./php/shopping-cart-process.php",
            data: {
                "productID":            productID,
                "productQuantity":      productQuantity,
                "scope":                "update"
            },

            // Response Events
            success: function (response) {
                if(response == 204){
                    toastAlert("top", "success", "Quantity updated!");
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                } else if(response == 406){
                    toastAlert("top", "error", "Insufficient quantity in stock!");
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                } else if(response == 500){
                    toastAlert("top", "error", "Something went wrong...");
                }
            }
        });
    });

    // When the customer clicks trash can to remove product
    $(document).on('click', '.deleteCartItem', function (e) {
        e.preventDefault();

        // Retrieve the cart ID of the specific cart entry
        var cartID = $(this).val();

        // Send AJAX request to process the customer's action for their cart
        $.ajax({
            method: "POST",
            url: "./php/shopping-cart-process.php",
            data: {
                "cartID":               cartID,
                "scope":                "delete"
            },

            // Response Events
            success: function (response) {
                if(response == 200){
                    location.reload();
                }
                else if(response == 500){
                    toastAlert("top", "error", "Something went wrong...");
                }
            }
        });
    });
});