<?php session_start();


//echo "hello world";

if(isset($_POST['name'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "taysongermano@gmail.com";
    $email_subject = $_POST['subject'];
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) || //name
       // !isset($_POST['your-surname']) ||  //surname
      //  !isset($_POST['tel']) ||  //Contact Number
        !isset($_POST['subject']) ||  //address
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {  //message
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['name']; // required
    //$tel = $_POST['tel']; // required
    $email_from = $_POST['email']; // required
    $subject = $_POST['subject']; //  required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($subject) < 2) {
    $error_message .= 'The Subject you entered does not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n<br /><br />";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Full Name: ".clean_string($first_name)."\n<br />";
   // $email_message .= "Last Name: ".clean_string($last_name)."\n<br />";
    $email_message .= "Email: ".clean_string($email)."\n<br />";
    $email_message .= "subject: ".clean_string($subject)."\n\n<br />";
    $email_message .= "Message : ".clean_string($message)."\n<br />";
 
// create email headers
$headers = 'From: ' .$first_name. '' .$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";


try { 
									mail($email_to, $email_subject, $email_message, $headers);  } 
								catch(PDOException $e) {
									echo $e->getMessage();
									}
?>
 
<!-- success html here -->





 <p style="color:#000;">Thank you <?php echo  $first_name  ?> </br></br>
           We will contact you soon. Thanks for your request.</p>
            

<?php
 
}
?>