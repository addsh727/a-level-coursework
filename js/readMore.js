// Read More button functionality - expand description
$(".readMoreButton").on('click', function(){
    $(this).parent().toggleClass("showContent");
    var replaceText = $(this).parent().hasClass("showContent") ? "Collapse" : "Read More";
    $(this).text(replaceText);
});