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
class Request extends Kohana_Request {
	public function execute()
	{
		try
		{
			return parent::execute();
		}
		catch (Http_Exception $e)
		{
			return Request::factory('errors/'.$e->getCode())
				->post('exception', $e)
				->post('request', $this)
				->execute();
		}
	}
}