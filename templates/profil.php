<?php 

require 'class/Html.php';

$html = new Html();

$html->generate($html->header());
$html->generate($html->beginBody());

include 'navbar.php';

$html->generate($html->endBody());
?>