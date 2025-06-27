<?php
// module_descriptor.php

// Protection Dolibarr
$res = @include("../../main.inc.php");
if (!$res) die("Include of main fails");

// Inclut la classe principale du module
require_once DOL_DOCUMENT_ROOT.'/core/modules/DolibarrModules.class.php';
require_once dirname(__FILE__).'/core/modules/modEcheancier.class.php';