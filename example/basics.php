<?php
/**
 * This file demonstrates the bare minimum use of Formward. It will show you how
 * to create a form, add a single field to it, output the form, and check the
 * submission and validation status of the form with handle()
 */
include '../vendor/autoload.php';
@session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="basic-styles.css">
    </head>
    <body>
<?php

// create a new form
$form = new Formward\Form('Demo form');

// add a simple input field and mark it as required
$form['demo'] = new Formward\Fields\Input('Demo field');
$form['demo']->required(true);

// add a simple input field and mark it as required
$form['disabled'] = new Formward\Fields\Input('Disabled field');
$form['disabled']->disabled(true);

// output the form to the page
echo $form;

// calling $form->handle() returns one of true, false, or null, which mean:
// true:  form submitted and validated
// false: form submitted but has validation errors
// null:  form not submitted
$result = $form->handle();

echo "<h2>Form state</h2>";
if ($result === true) {
    echo "<p>Submitted and valid</p>";
} elseif ($result === false) {
    echo "<p>Submitted and invalid</p>";
} elseif ($result === null) {
    echo "<p>Not submitted</p>";
}

// an array of all current form values can be gotten from $form->value()
echo "<h2>Form::value()</h2>";
echo "<pre>";
print_r($form->value());
echo "</pre>";

?>
    </body>
</html>
