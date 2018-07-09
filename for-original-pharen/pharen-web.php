<?php

// This file is for web only (not for CLI)
// For the CLI use  pharen_dir/bin/pharen

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

// FIXME: Should be outside of DOCUMENT_ROOT
define('PHAREN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/pharen_dir');
define('PROJECT_PHAREN_FILES_ROOT', sys_get_temp_dir());

require_once PHAREN_DIR . '/pharen.php';

/** 
 * @param string $name
 * @param string $code
 * @return void
 */
function save_and_compile($name, $code) {
    $filename = PROJECT_PHAREN_FILES_ROOT . '/' . $name . '.phn';
    
    if (file_put_contents($filename, $code)) {
        $php_code = compile_file($filename);

        $outfile = str_replace('.phn', '.php', $filename);
        if (file_put_contents($outfile, $php_code)) {
            return $outfile;
        } else {
            throw new Exception("$outfile could not be written");
        }
    } else {
        throw new Exception("$filename could not be written");
    }
}

/** 
 * @param string $name
 * @param mixed $value
 * @return void
 */
function set_global($name, $value) {
    $GLOBALS[$name] = $value;
}

$outfile = save_and_compile(uniqid(), $_POST['code']);
require_once $outfile;

