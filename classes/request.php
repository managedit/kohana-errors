<?php

class Request extends Kohana_Request {
	/**
	 * @var  Request  The most recent failed request.
	 */
	public static $failed;

	/**
	 * Return the most recently failed request.
	 *
	 *     $request = Request::failed();
	 *
	 * @return  Request
	 * @since   3.1.0
	 */
	public static function failed()
	{
		return Request::$failed;
	}

	public function execute()
	{
		try
		{
			return parent::execute();
		}
		catch (Exception $e)
		{
			Request::$failed = $this;

			throw $e;
		}
	}
}