<?php
if($_POST)
{
    $user_name      = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $user_email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone_number   = filter_var($_POST["phone"], FILTER_SANITIZE_NUMBER_INT);
    $source = $_POST["id_template"];
    $id_templ = filter_var(substr(trim($source, ".html"), (strrpos(trim($source, ".html"), "=")+1)), FILTER_SANITIZE_NUMBER_INT);
	
	function strafter($string, $substring) {
  $pos = strpos($string, $substring);
  if ($pos === false)
   return $string;
  else  
   return(substr($string, $pos+strlen($substring)));
}

function strbefore($string, $substring) {
  $pos = strpos($string, $substring);
  if ($pos === false)
   return $string;
  else  
   return(substr($string, 0, $pos));
} 

$myvar = $source;
$myvar = strbefore($myvar,'&pr_code'); 
$myvar = strafter($myvar,'i='); 
	
    $subject = "Ordine del modello #" . $myvar;
    $webstudio_email= $_POST["we"];
    $message_body = "Hai un nuovo ordine del modello ù#" . $myvar . "<br>" . "Nome: " . $user_name . "<br>" . "Email: " . $user_email . "<br>" . "Telefono: ". $phone_number . "<br>" . "Fonte: " . str_replace('//', '//', $source) . "<br>" . 'Per favore, assicurati di utilizzare il link qui sopra per ottenere la tua commissione di affiliazione!';
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $user_name = str_replace(' ', '_', $user_name);
    $headers .= 'From: ' . $user_name . '' . "\r\n" .
                'Reply-To: '.$user_email.'' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
				
    $send_mail = mail($webstudio_email, $subject, $message_body, $headers);
    if(!$send_mail)
    {
        $output = json_encode(array('status' => 'error'));
        die($output);
    } else {
        $output = json_encode(array('status' => 'success'));
        die($output);
    }
}
die();
?>