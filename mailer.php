<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["contact-name"]));
    $name = str_replace(array("\r", "\n"), array(" ", " "), $name);
    $email = filter_var(trim($_POST["contact-email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["contact-message"]);

    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      http_response_code(400);
      echo "Oops! There was a problem with your submission. Please complete the form and try again.";
      exit;
    }

    $from_email = "sy@sytantris.com";
    $recipient = "sytantris.dyat@gmail.com";
    $subject = "New contact from $name";

    $email_content = "Contact message from: $name <$email>\n\n";
    $email_content .= "$message\n";

    $email_headers = "From: sy@sytantris.com <$from_email>\n" .
                     "Reply-To: $name <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
      http_response_code(200);
      echo "Thank you! Your message has been sent.";
    } else {
      http_response_code(500);
      echo "Oops! Something went wrong and we couldn't send your message.";
    }

  } else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
  }

?>