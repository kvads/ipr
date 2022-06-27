<?php
require_once '../../vendor/autoload.php';

use ProgrammingWithGio\MagicMethods;
echo '<pre>';
$invoice = new MagicMethods\Invoice();
$invoice->amount = 15;
var_dump(isset($invoice->amount));
unset($invoice->amount);
var_dump(isset($invoice->amount));

$invoice->process(15, 'Some Description');


$invoice();

var_dump(is_callable($invoice));
echo '</pre>';