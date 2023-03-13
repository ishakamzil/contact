<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assign Variables
    $user = $filter_var($_POST['name'], FILTER_SANITIZE_STRING);  // the string filter 
    $suruser = $filter_var($_POST['surname'], FILTER_SANITIZE_STRING);  // the string filter 
    $email = $filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); //the email filter
    $subjectForm = $filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = $filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // FILTER_SANITIZE_NUMBER_INT  the phone filter


    // Creating Array of Errors
    $formErrors = array();
    if (strlen($user) <= 3) {
        $formErrors[] = 'Username must be larger than 3 characters'
    }


    // if no error send the email [ mail(To, Subject, Message, Headers, Parameters) ]

    $headers = 'From: ' . $email . '\r\n'
    $myEmail = 'amzilishak@gmail.com'
    $subject = 'contact Form'

    if(empty($formErrors)) {
        mail($myEmail, $subject, $message, $headers, $suruser, $subjectForm)

        $user = '';
        $email = '';
        $suruser = '';
        $subject = '';
        $message = '';
      
        $success = 'div class="alert alert-success"> We have recieved your message </div>'

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Contact</title>
</head>
<body>
    <form id="contact-form" action="index.php" method="POST">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-heading">
              <h2><em>Contact Us</em> &amp; Get In <span>Touch</span></h2>
            </div>
            <div class="errors">

                <?php 
                if (! empty($formErrors)) {
                    foreach($formErrors as $error){
                        echo $error . '<br/>';
                    }
                }
                ?>
                <?php if (isset($success)) {
                    echo $success;
                } ?>
            </div>
          </div>
          <div class="col-lg-6">
            <fieldset>
              <input type="name" name="name" id="name" placeholder="Your Name..." autocomplete="on" required>
            </fieldset>
          </div>
          <div class="col-lg-6">
            <fieldset>
              <input type="surname" name="surname" id="surname" placeholder="Your Surname..." autocomplete="on" required>
            </fieldset>
          </div>
          <div class="col-lg-6">
            <fieldset>
              <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your E-mail..." required="">
            </fieldset>
          </div>
          <div class="col-lg-6">
            <fieldset>
              <input type="subject" name="subject" id="subject" placeholder="Subject..." autocomplete="on" >
            </fieldset>
          </div>
          <div class="col-lg-12">
            <fieldset>
              <textarea name="message" id="message" placeholder="Your Message"></textarea>
            </fieldset>
          </div>
          <div class="col-lg-12">
            <fieldset>
              <button type="submit" id="form-submit" class="orange-button">Send Message Now</button>
            </fieldset>
          </div>
        </div>
      </form>

      
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>