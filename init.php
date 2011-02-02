<?php
Route::set('error', 'error/<action>')
	->defaults(array(
		'controller' => 'errors'
	));

set_exception_handler(array('Error', 'handler'));