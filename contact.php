<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$success = false;

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $sentFrom = $_POST['email'];
    $body = $_POST['message'];
    $sentTo = 'notioncontacts@gmail.com';
    $pass = 'nw4roleplay';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = $sentTo;                     //SMTP username
        $mail->Password = $pass;                             //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($sentFrom, $name);
        $mail->addAddress($sentTo, 'Notion');     //Add a recipient
        $mail->addReplyTo($sentFrom, $name);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
         $mail->isHTML(true);                                  //Set email format to HTML
//        $mail->Subject = 'Test';
        $mail->Body = '<b>Name: </b>'.$name.'<br><b>Email: </b>'.$sentFrom.'<br><b>Message: </b>'.$body;
//        $mail->AltBody = $body;

        $mail->send();
        $success = true;
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $success = "error";
    }

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" />
    <title>Notion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <nav>
        <h1>Notion</h1>
        <div class="right">
            <a href="index.html"><p>Acceuil</p></a>
            <p>Forum</p>
            <a href="contact.php"><p>Contact</p></a>
            <a href="https://fivem.net" target="_blank"><button>Rejoindre</button></a>
        </div>
    </nav>

    <section class="presentation first">
        <div class="contact">

            <form action="" class="contact-form " method="post">
                <div class="">
                    <h1 class="contact-heading">
                        CONTACT :
                    </h1>

                    <?php
                    if($success) {
                        echo '<p>Merci de nous avoir contacté!</p>';
                    } else if ($success == "error") {
                        echo '<p>Erreur lors de la distribution du message!</p>';
                    }
                    ?>
                </div>
                <div class="contact-form-inner">
                    <div class="contact-info">
                        <div class="contact-div">
                            <input type="text" name="name" id="name" placeholder="Nom" class="input">
                        </div>
                        <div class="contact-div">
                            <input type="text" name="email" id="email" placeholder="Email" class="input">
                        </div>
                    </div>
                    <div class="contact-msg">
                        <textarea class="input" name="message" id="message" cols="30" rows="8" placeholder="Message"></textarea>
                        <button type="submit" name="submit" class="send-btn">ENVOYER</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</header>

<footer class="custom-footer footer">
    <div class="column">
        <h3>Fondateur</h3>
        <p>Galileo</p>
        <br>
        <p>Jaguar</p>
    </div>
    <div class="column">
        <h3>Gestion</h3>
        <p>Caleb</p>
        <p>Raph</p>
        <p>Boisjoli</p>
    </div>
    <div class="column">
        <h3>Accès Rapide</h3>
        <a href="index.html"><p>Acceuil</p></a>
        <p>Forum</p>
        <a href="contact.php"><p>Contact</p></a>
    </div>
</footer>

<!--<script>-->
<!--    let footer = document.querySelector('footer');-->
<!--    let header = document.querySelector('nav');-->
<!--    let main = document.querySelector('.presentation');-->
<!---->
<!--    main.style.minHeight = (window.innerHeight-(header.scrollHeight + footer.scrollHeight)) + 'px';-->
<!--</script>-->
</body>
</html>