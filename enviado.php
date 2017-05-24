<?php
if(isset($_POST['email'])) {
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "jmgajardo@uc.cl";
    $email_subject = "Your email subject line";
    function died($error) {
        // your error code can go here
        echo "Estás espameando y no te voy a dejar. ";
        echo "Arregla esto.<br /><br />";
        echo $error."<br /><br />";
        echo "En serio. Arréglalo.<br /><br />";
        die();
    }
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('Lo escribiste mal.');
    }
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Escribiste el mail mal.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Escribiste tu nombre mal.<br />';
  }
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'Escribiste tu apellido mal.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'Escribiste muchas leseras.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
    $email_message .= "Nombre: ".clean_string($first_name)."\n";
    $email_message .= "Apellido: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Teléfono: ".clean_string($telephone)."\n";
    $email_message .= "Comentario: ".clean_string($comments)."\n";
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>

<!-- include your own success html here -->

<?php include('header.php')?>
<div class="col-sm-12">
<p>Gracias por tu comentario, ojalá sea bacán, o sino, lo ignoraré :).</p>
</div>
<?php include('footer.php')?>
<?php } ?>
