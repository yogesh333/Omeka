<?php
/**
 * @package Sitebuilder
 * @author Nate Agrin
 **/
require_once 'Zend/Controller/Action.php';
class IndexController extends Zend_Controller_Action
{
	/**
	 * This allows for GET style routing.
	 * DO NOT EDIT THIS UNLESS THERE IS A BUG, OR YOU KNOW WHAT YOU ARE DOING
	 * @author Nate Agrin
	 */
    public function indexAction()
    {
		$config = Zend::registry('config_ini');
		
		$req = $this->getRequest();
		
		$c = $req->getParam($config->uri->controller);
		$a = $req->getParam($config->uri->action);
		$admin = (boolean) $req->getParam($config->uri->admin);

		if (!$c) {
			// Assume that they want to go to the default location
			$this->_forward($config->default->controller, $config->default->action);
		}
		
		if ($admin && $c) {
			$this->_forward('admin', 'index');
			return;
		}
		
		if ($c) {
			if ($a) {
				$this->_forward($c, $a);
				return;
			}
			else {
				$this->_forward($c, $config->default->action);
				return;
			}
		}
    }

	public function testAction()
	{
		print_r($this->getRequest());
	}

    public function noRouteAction()
    {
        $this->_redirect('/');
    }
}
?>