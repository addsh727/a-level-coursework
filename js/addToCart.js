$(document).ready(function () { // Add To Cart Button functionality for Product Page
    // When this button below is clicked
    //      vvvv
    $(".addToCartButton").click(function (e) { 
        e.preventDefault();

        // Retrieve & initialise product ID and desired quantity
        var productID           = $(this).val();
        var productQuantity     = $(this).closest(".productDetails").find(".inputQuantity").val();

        // Send AJAX request to process the customer's action for their cart with the above data
        $.ajax({
            method: "POST",
            url: "./php/shopping-cart-process.php",
            data: {
                "productID": productID,
                "productQuantity": productQuantity,
                "scope": "add"
            },

            // Response Events
            success: function (response) {
                if(response == 201){
                    toastAlert("top", "success", "Added to cart!");
                }
                else if(response == 204){
                    toastAlert("top", "success", "Product quantity updated!");
                }
                else if(response == 401){
                    toastAlert("top", "error", "Please login to continue!");
                }
                else if(response == 406){
                    toastAlert("top", "error", "Insufficient quantity in stock!");
                }
                else if(response == 500){
                    toastAlert("top", "error", "Something went wrong...");
                }
            }
        });
    });
});