<?php
  
if($_POST) {
    $contactName = "";
    $contactEmail = "";
    $contactSubject = "";
    $contactMessage = "";
    $email_body = "<div>";
      
    if(isset($_POST['contactName'])) {
        $contactName = filter_var($_POST['contactName'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitor Name:</b></label>&nbsp;<span>".$contactName."</span>
                        </div>";
    }
 
    if(isset($_POST['contactEmail'])) {
        $contactEmail = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['contactEmail']);
        $contactEmail = filter_var($contactEmail, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitor Email:</b></label>&nbsp;<span>".$contactEmail."</span>
                        </div>";
    }
      
    if(isset($_POST['contactSubject'])) {
        $contactSubject = filter_var($_POST['contactSubject'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>".$contactSubject."</span>
                        </div>";
    }
      
    if(isset($_POST['contactMessage'])) {
        $contactMessage = htmlspecialchars($_POST['contactMessage']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>".$contactMessage."</div>
                        </div>";
    }
      
    $recipient = "omarzahir12@gmail.com";
      
    $email_body .= "</div>";
 
    $headers  = 'From: ' . $contactEmail . "\r\n";
      
    if(mail($recipient, $contactSubject, $email_body, $headers)) {
        echo "<p>Thank you for contacting us, $contactName. You will get a reply within 24 hours.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }
      
} else {
    echo '<p>Something went wrong</p>';
}
?>