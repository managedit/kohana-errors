<?php defined('SYSPATH') or die('No direct script access.');
/**
 * HTTP Errors Controller
 *
 * @package    Kohana/Errors
 * @author     Kiall Mac Innes
 * @author     Kohana Team
 * @copyright  (c) 2007-2010 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Kohana_Controller_Errors extends Controller {
	protected $failed_request;
	protected $exception;

	public function before()
	{
		parent::before();

		$this->failed_request = $this->request->post('request');
		$this->exception = $this->request->post('exception');
		
		if (Kohana::$environment === Kohana::DEVELOPMENT AND Request::initial()->query('show_error') == 'true')
		{
			Kohana_Exception::handler($this->exception);
			exit(1);
		}

		if ( ! method_exists($this, 'action_'.$this->request->action()))
		{
			$this->request->action('invalid');
		}
	}

	public function action_invalid()
	{
		$this->response->status(500);
		$this->response->body(View::factory('errors/invalid', array('code' => $this->exception->getCode())));
	}
}