function animateCounter(element, value) {
    $(function(){
        var $counter = $('h2#'+element);
        $counter.numberAnimate({ animationTimes: [500, 1000, 500,] });
        $counter.numberAnimate('set', value);
    });
}