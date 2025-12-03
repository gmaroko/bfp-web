<?php

// Receiving email
$receiving_email_address = 'info@barefootpower.com';

$php_email_form = '../assets/vendor/php-email-form/php-email-form.php';
if (file_exists($php_email_form)) {
  include($php_email_form);
} else {
  die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = isset($_POST['name']) ? $_POST['name'] : 'Website Visitor';
$contact->from_email = isset($_POST['email']) ? $_POST['email'] : 'no-reply@barefootpower.com';

// Use inquiry type as subject
$contact->subject = isset($_POST['priority']) 
  ? 'New Inquiry: ' . ucfirst($_POST['priority'])
  : 'Website Contact Form';


$contact->smtp = array(
  'host' => 'mail.barefootpower.com',
  'username' => 'info@barefootpower.com',
  'port' => '587'
);

// Email content
$contact->add_message($_POST['name'], 'Name');
$contact->add_message($_POST['email'], 'Email');

if (!empty($_POST['priority'])) {
  $contact->add_message($_POST['priority'], 'Inquiry Type');
}

$contact->add_message($_POST['message'], 'Message', 10);

// Send email
echo $contact->send();
?>
