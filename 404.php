<!DOCTYPE html> <!-- Error 404 Not Found Page -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" href="css/404.css" type="text/css">
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/Number-Rolling-Animation-jQuery-numberAnimate/numberAnimate.js"></script>
    <title>Where? Boötes Void</title>
</head>
<body>
    <video autoplay loop muted plays-inline class="background-vid">
        <source src="images/404vid.mp4" type="video/mp4">
    </video>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="error404">
                    <h1 class="number"></div>
                    <div class="text">Page not found</div>
                </div>
                <script>
                    $(function (){
                        var $404counter = $('h1');
                        $404counter.numberAnimate({animationTimes: [500, 1500, 2000]});
                        $404counter.numberAnimate('set', '404');
                    });
                </script>
            </div>
        </div>
        <div class="bottom-text">
            <div class="text">
                <a href="./"><img src="images/LogoTransparent.png" width="96px"></a>
                <p>Looks like you are lost on a lone planet within the galaxy!
                <br>You could continue stargazing or <a href='./'>return home</a>.
                </p>
            </div>
        </div>
    </div>
</body>
</html>

