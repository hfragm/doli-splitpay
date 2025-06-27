<?php
$res = @include("../../main.inc.php");
if (!$res) die("Include of main fails");

require_once dirname(__FILE__) . '/core/modules/modDolisplitpay.class.php';
