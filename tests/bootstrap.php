<?php
// Load the test environment
// https://github.com/nb/wordpress-tests

// $path = '/home/ollie/src/wordpress-tests/bootstrap.php';
$path = 'C:\Users\Ricardo\Dropbox\xampp\htdocs\wp-tests\includes\bootstrap.php';

if (file_exists($path)) {
        $GLOBALS['wp_tests_options'] = array(
                'active_plugins' => array('simpletables/simpletables.php')
        );
        require_once $path;
} else {
        exit("Couldn't find wordpress-tests/bootstrap.phpn");
}