<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>


    <div class="contact-form">
    <h2>Contact Us</h2>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="number" name="phone" placeholder="Phone No." required>
        <input type="email" name="email" placeholder="Your E-Mail" required>
        <textarea name="message"  placeholder="Your Message" required></textarea>

        <div class="g-recaptcha" data-sitekey="6LctuAUmAAAAALmN23qaEHTYYzN7a1eeoqOX7lj8"></div>

        <input type="submit" name="submit" value="Send Message" class="submit-btn">
    </form>
    <div class="status">

    <?php
    if(isset($_POST['submit'])){
        $User_name = $_POST['name'];
        $phone = $_POST['phone'];
        $user_email = $_POST['email'];
        $user_message = $_POST['message'];


        $email_from = '9213163085n.k@gmail.com';
        $email_subject = 'New Form Submission';
        $email_body = "Name: $User_name.\n". "Phone No: $phone.\n". "Email Id: $user_email.\n". "User Message: $user_message.\n";
        
        $to_email = "abhatank14@gmail.com";
        $headers = "From: $email_from \r\n";
        $headers .= "Reply-To: $User_name\r\n";
        
        $secretKey = "6LdfrwUmAAAAAAaAmbsLVurrhgrA8fqoHk7F61Op";
        $reponseKey = $_POST['g-recaptcha-response'];
        $UserIP = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$reponseKey&remoteip=$UserIP";

        $response = file_get_contents($url);
        $response = json_decode($response);
        
        if ($response->success){
            mail($to_email,$email_subject,$email_body,$headers);
            echo 'Message sent Successfully';
        }
        else 
        {
            echo "Message sent Successfully";
        } 


    }
    ?>

    </div>
    </div>


</body>
</html>