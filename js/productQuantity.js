// Add functionality to desired quantity counter(s)
$(document).ready(function () {
    $(".incrementQ").click(function (e) { // When incremented
        e.preventDefault();

        // Retrieve desired quantity
        var quantity        = $(this).closest(".productDetails").find(".inputQuantity").val();
        var value           = parseInt(quantity, 10);   // Sanitise into integer value
        value               = isNaN(value) ? 0: value;  // Check if value is empty/missing

        if(value < 10){     // Check if value less than 10 then update
            value++;
            $(this).closest(".productDetails").find(".inputQuantity").val(value);
        }
    });
    $(".decreaseQ").click(function (e) { // When decreased
        e.preventDefault();

        // Retrieve desired quantity
        var quantity        = $(this).closest(".productDetails").find(".inputQuantity").val();
        var value           = parseInt(quantity, 10);   // Sanitise into integer value
        value               = isNaN(value) ? 0: value;  // Check if value is empty/missing

        if(value > 1){      // Check if value greater than 1 then update
            value--;
            $(this).closest(".productDetails").find(".inputQuantity").val(value);
        }
    });
});