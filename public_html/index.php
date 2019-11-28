<?php
require '../bootloader.php';

use App\App;

$navigation = new \App\Views\Navigation();
$footer = new \App\Views\Footer();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="media/css/normalize.css">
        <link rel="stylesheet" href="media/css/style.css">
        <link rel="stylesheet" href="media/css/hero-styles.css">
        <link rel="stylesheet" href="media/css/services-styles.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
        <header>
            <?php print $navigation->render(); ?>
        </header>

        <section class="hero-image">

        </section>

        <section class="services-container">
            <div class="services">
                <div class="service-card">
                    <div class="image">
                        <img src="/../media/img/bank-card.jpg" alt="Avatar" style="">
                    </div>
                    <div class="service-container">
                        <h4>Lengvas atsiskaitymas</h4>
                        <p>Paslaugos apmokamos banko kortele bei grynaisiais</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="image">
                        <img src="/../media/img/app.jpg" alt="Avatar" style="">
                    </div>
                    <div class="service-container">
                        <h4>Pamiršote piniginę?</h4>
                        <p>Nieko tokio mes taip pat turime faketaxi programele, kurioje lengvai galesite atlikti mokėjimą bei sekti iškviesto automobilio lokaciją</p>
                    </div>
                </div>


                <div class="service-card">
                    <div class="image">
                        <img src="/../media/img/fast-car.jpg" alt="Avatar" style="">
                    </div>
                    <div class="service-container">
                        <h4>Greitai ir patikimai</h4>
                        <p>Mūsų patyrę vairuotojai yra tikri profesionalai! Pristatysime jus greitai ir saugiai!</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="loaction">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2304.
                    219602272894!2d25.33570198039679!3d54.72335198038712!2m3!1f0!2f0!3f0!3m2
                    !1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd96e7d814e149%3A0xdd7887e198efd4c7!2s
                    Saul%C4%97tekio%20al.%2015%2C%20Vilnius%2010221!
                    5e0!3m2!1slt!2slt!4v1574843369749!5m2!1slt!2s
                    lt" width="" height="" frameborder="0" style="border:0;" allowfullscreen="">

            </iframe>
        </section>


        <!-- Footer -->        
        <footer>
            <?php print $footer->render(); ?>
        </footer>

        <script defer src="media/js/app.js"></script>

    </body>
</html>
