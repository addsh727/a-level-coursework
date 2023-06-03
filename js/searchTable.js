$(document).ready(function(){ // Search Customer table
    $('#searchCustomer').keyup(function(){
        searchCustomerTable($(this).val()); // Entered Search Query
    });
    function searchCustomerTable(value){ // Seach function for Customer table
        $('#tableOfCustomers tbody tr').each(function(){ 
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                    found = 'true';
                }
            });
            if(found == 'true'){ // Show table row if contains searched query, else hide
                $(this).show();
            } else{ $(this).hide(); }
        });
    }
});
$(document).ready(function(){ // Search Product table
    $('#searchProduct').keyup(function(){
        searchProductTable($(this).val()); // Entered Search Query
    });
    function searchProductTable(value){ // Seach function for Product table
        $('#tableOfProducts tbody tr').each(function(){ 
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                    found = 'true';
                }
            });
            if(found == 'true'){ // Show table row if contains searched query, else hide
                $(this).show();
            } else{ $(this).hide(); }
        });
    }
});
$(document).ready(function(){ // Search Category table
    $('#searchCategory').keyup(function(){
        searchCategoryTable($(this).val()); // Entered Search Query
    });
    function searchCategoryTable(value){ // Seach function for Category table
        $('#tableOfCategories tbody tr').each(function(){ 
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                    found = 'true';
                }
            });
            if(found == 'true'){ // Show table row if contains searched query, else hide
                $(this).show();
            } else{ $(this).hide(); }
        });
    }
});
$(document).ready(function(){ // Search Order table
    $('#searchOrder').keyup(function(){
        searchOrderTable($(this).val()); // Entered Search Query
    });
    function searchOrderTable(value){ // Seach function for Order table
        $('#tableOfOrders tbody tr').each(function(){ 
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                    found = 'true';
                }
            });
            if(found == 'true'){ // Show table row if contains searched query, else hide
                $(this).show();
            } else{ $(this).hide(); }
        });
    }
});
$(document).ready(function(){ // Search Invoice table
    $('#searchInvoice').keyup(function(){
        searchInvoiceTable($(this).val()); // Entered Search Query
    });
    function searchInvoiceTable(value){ // Seach function for Invoice table
        $('#tableOfInvoices tbody tr').each(function(){ 
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                    found = 'true';
                }
            });
            if(found == 'true'){ // Show table row if contains searched query, else hide
                $(this).show();
            } else{ $(this).hide(); }
        });
    }
});
$(document).ready(function(){ // Search Staff table
    $('#searchStaff').keyup(function(){
        searchStaffTable($(this).val()); // Entered Search Query
    });
    function searchStaffTable(value){ // Seach function for Staff table
        $('#tableOfStaff tbody tr').each(function(){ 
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                    found = 'true';
                }
            });
            if(found == 'true'){ // Show table row if contains searched query, else hide
                $(this).show();
            } else{ $(this).hide(); }
        });
    }
});