<?php
require '../bootloader.php';

use App\App;

$createForm = new \App\Participants\Views\CreateForm();
$updateForm = new \App\Participants\Views\UpdateForm();
$navigation = new \App\Views\Navigation();
$footer = new \App\Views\Footer();

//if (!App::$session->userLoggedIn()) {
//    header('Location: /login.php');
//}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="media/css/normalize.css">
<!--        <link rel="stylesheet" href="media/css/milligram.min.css">-->
         <link rel="stylesheet" href="media/css/forms.css">
        <link rel="stylesheet" href="media/css/style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
        <header>
            <?php print $navigation->render(); ?>
        </header>

        <main>
            <section class="wrapper">

                <div class="block">
                    <h2>Atsiliepimai:</h2> 
                    <div class="comment-container"></div> 
                </div>

                <div class="block">
                    <?php if (App::$session->userLoggedIn()): ?>
                        <?php print $createForm->render(); ?>
                    <?php else: ?>
                        <div> Norėdami parašyti komentarą privalote užsiregistruoti</div>
                    <?php endif; ?>                 
                </div>

            </section>
            <!-- Update Modal -->
            <div id="update-modal" class="modal">
                <div class="wrapper">
                    <span class="close">&times;</span>
                    <?php print $updateForm->render(); ?>
                </div>
            </div>            
        </main>

        <!-- Footer -->        
        <footer>
            <?php print $footer->render(); ?>
        </footer>
        <script defer src="media/js/app.js"></script>

    </body>
</html>
