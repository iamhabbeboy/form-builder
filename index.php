<?php

/**
 * Form Generator - A Tiny PHP Library For Form Generator
 *
 * @package  FormCore
 * @author   Azeez Abiodun <azeez@megafusetech.com>
 */

require_once 'src/form-core.php';
use FormGen\FormCore;

//Initialize Form Control
$generator = new FormCore();
// Create Forms component
$generator -> create($argv);
//Export Forms generated
$generator->export();
