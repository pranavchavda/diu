<?php
use phpformbuilder\Form;
use phpformbuilder\Validator\Validator;

/* =============================================
    start session and include form class
============================================= */

session_start();
include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpformbuilder/Form.php';
chmod("/phpformbuilder", 0755);
/* =============================================
    validation if posted
============================================= */

if ($_SERVER["REQUEST_METHOD"] == "POST" && Form::testToken('room-booking-form') === true) {
    // create validator & auto-validate required fields
    $validator = Form::validate('room-booking-form');

    // additional validation
    $validator->email()->validate('user-email');

    // check for errors
    if ($validator->hasErrors()) {
        $_SESSION['errors']['room-booking-form'] = $validator->getAllErrors();
    } else {
        $email_config = array(
            'sender_email'    => 'info@stayindiu.com',
            'sender_name'     => 'Stay in Diu',
            'recipient_email' => 'info@11destinations.com',
            'subject'         => 'Stay in Diu - Room Booking Form',
            'filter_values'   => 'room-booking-form'
        );
        $sent_message = Form::sendMail($email_config);
        Form::clear('room-booking-form');
    }
}

/* ==================================================
    The Form
================================================== */

$form = new Form('room-booking-form', 'horizontal', 'novalidate');
// $form->setMode('development');

$form->startFieldset('Book a Room');
$form->setCols(3, 4);
$form->groupInputs('first-name', 'last-name');
$form->addHelper('First name', 'first-name');
$form->addInput('text', 'first-name', '', 'Full Name : ', 'required');
$form->setCols(0, 5);
$form->addHelper('Last name', 'last-name');
$form->addInput('text', 'last-name', '', '', 'required');
$form->setCols(3, 9);
$form->addInput('email', 'user-email', '', 'E-Mail : ', 'placeholder=email@example.com, required');
$form->addInput('text', 'phone-number', '', 'Phone Number : ', 'required');
$form->addPlugin('pickadate', '#arrival-date');
$form->addInput('text', 'arrival-date', '', 'Arrival Date', 'required');
$form->groupInputs('number-of-nights', 'number-of-guests');
for ($i=1; $i <= 30; $i++) {
    $form->addOption('number-of-nights', $i, $i);
}
$form->addOption('number-of-nights', 'more than 30', '30 +');
$form->setCols(3, 3);
$form->addIcon('number-of-nights', '<i class="fa fa-bed"></i>', 'before');
$form->addSelect('number-of-nights', 'Number of Nights', 'class=select2, required');
for ($i=1; $i <= 10; $i++) {
    $form->addOption('number-of-guests', $i, $i);
}
$form->addOption('number-of-guests', 'more than 10', '10 +');
$form->addIcon('number-of-guests', '<i class="fa fa-user-plus"></i>', 'before');
$form->addSelect('number-of-guests', 'Number of Guests', 'class=select2, required');
for ($i=1; $i <= 10; $i++) {
    $form->addOption('number-of-children', $i, $i);
}
$form->addOption('number-of-children', 'more than 10', '10 +');
$form->addIcon('number-of-children', '<i class="fa fa-user-plus"></i>', 'before');
$form->addSelect('number-of-children', 'Number of Children Below 10 years', 'class=select2, required');

$form->addPlugin('tinymce', '#additional-information', 'contact-config');
$form->setCols(3, 9);
$form->addTextarea('additional-information', '', 'Additional Information');
$form->addBtn('submit', 'submit-btn', 1, 'Submit', 'class=btn btn-success ladda-button, data-style=zoom-in');
$form->endFieldset();

// jQuery validation
$form->addPlugin('formvalidation', '#room-booking-form');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Form</title>
    <meta name="description" content="Bootstrap 4 Form Generator - how to create a Room Booking Form with Php Form Builder Class">
    <link rel="canonical" href="https://www.phpformbuilder.pro/templates/bootstrap-4-forms/room-booking-form.php" />

    <!-- Bootstrap 4 CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font awesome icons -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11 col-lg-10">
            <?php
            if (isset($sent_message)) {
                echo $sent_message;
            }
            $form->render();
            ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <!-- Bootstrap 4 JavaScript -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php
        $form->printIncludes('js');
        $form->printJsCode();
    ?>
</body>
</html>