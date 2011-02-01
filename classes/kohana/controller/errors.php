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

	public function before()
	{
		parent::before();
		
		if ( ! method_exists($this, 'action_'.$this->request->action()))
		{
			$this->request->action('invalid');
		}
	}

	public function action_invalid()
	{
		Kohana_Exception::handler($this->request->post('exception'));
		exit(1);
	}
}