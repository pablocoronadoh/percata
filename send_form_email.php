<?php
 
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "diego@develoft.com";
    $email_subject = "Nuevo contacto - ";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
        echo "Lo sentimos pero hay errores en la forma de contacto. ";

        echo "Esos errores son los siguientes. <br /><br />";
 
        echo $error."<br /><br />";

        echo "Por favor regresa y corrige esos errores.<br /><br />";
 
        die();
 
    }
 
     
    // validation expected data exists
 
    if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['package']) || !isset($_POST['message'])) {
 
        died('Falta algún campo');       
 
    }
 
     
 
    $name = $_POST['name']; // required
  
    $email_from = $_POST['email']; // required

    $package = $_POST['package']; //  required

    $mesagge = $_POST['message']; // required


    $email_subject = $email_subject.$subject;
 
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'El correo que pusiste no parece valido.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
 
    $error_message .= 'El nombre que pusiste no parece valido.<br />';
 
  }
 
 
  // if(strlen($message) < 2) {
 
  //   $error_message .= 'El mensaje que pusiste no parece valido.<br />';
 
  // }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
  $email_message = "Informacion: \n\n";

  function clean_string($string) {

    $bad = array("content-type","bcc:","to:","cc:","href");

    return str_replace($bad,"",$string);

  }

   

  $email_message .= "Nombre: ".clean_string($name)."\n";

  $email_message .= "Correo: ".clean_string($email_from)."\n";

  $email_message .= "Paquete: ".clean_string($package)."\n";

  $email_message .= "Mensaje: ".clean_string($message)."\n";

 
     
 
  // create email headers
   
  $headers = 'From: '.$email_from."\r\n".
   
  'Reply-To: '.$email_from."\r\n" .
   
  'X-Mailer: PHP/' . phpversion();
   
  @mail($email_to, $email_subject, $email_message, $headers);

  // echo "Contacto enviado exitosamente";

  header( 'Location: http://webit.mx/#contact' ) ;

}  
 ?>