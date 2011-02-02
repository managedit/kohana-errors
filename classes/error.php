<?php defined('SYSPATH') or die('No direct script access.');
/**
 * HTTP Errors Request Extension
 *
 * @package    Kohana/Errors
 * @author     Kiall Mac Innes
 * @author     Kohana Team
 * @copyright  (c) 2007-2010 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Error {
	public static function handler($e)
	{
		try
		{
			$code = $e->getCode();

			if ( ! $e instanceof Http_Exception)
			{
				$code = 500;
			}

			$request = Request::factory(Route::get('error')->uri(array('action' => $code)))
				->post('exception', $e);
			
			if (Request::failed() !== NULL)
			{
				$request = $request->post('request', Request::failed());
				Request::$failed = NULL;
			}

			echo $request->execute()
				->send_headers()
				->body();

			// Exit cleanly
			exit(1);
		}
		catch (Exception $e)
		{
			// Log an error.
			if (is_object(Kohana::$log))
			{
				// Create a text version of the exception
				$error = Kohana_Exception::text($e);

				// Add this exception to the log
				Kohana::$log->add(Log::ERROR, $error);

				// Make sure the logs are written
				Kohana::$log->write();
			}

			// Output *something*.
			ob_clean();
			header('HTTP/1.1 500 Internal Server Error');
			echo "Unknown Error - Exception thrown in Error::handler()";

			// Exit cleanly
			exit(1);
		}
	}
}