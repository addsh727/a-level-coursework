// Use ipAPI to fetch session data of user's connection
$.getJSON('https://ipapi.co/json', function(ip){
    var data = { // Initialise data array
        ip: ip.ip,
        org: ip.org,
        city: ip.city,
        region: ip.region,
        country: ip.country_name,
        continent: ip.continent_code
    };

    // Send AJAX request with the above data array
    $.ajax({
        url: '',
        type: 'post',
        data: data
    });
});
