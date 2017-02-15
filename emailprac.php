<!DOCTYPE html>

<html>
<body>
<?php
$to      = 'kukuku0517@naver.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: kukuku0517@gmail.com' . "\r\n" .
    'Reply-To: kukuku0517@hanmail.net' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>
</form>
</body>
</html>
