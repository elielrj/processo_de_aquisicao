<?php

require_once 'interface/InterfaceToObjectController.php';
require_once 'interface/InterfaceCreateController.php';
require_once 'interface/InterfaceUpdateController.php';
require_once 'interface/InterfaceRetriveController.php';
require_once 'interface/InterfaceDeleteController.php';
require_once 'interface/InterfaceOptionsController.php';
require_once 'interface/InterfaceContagemController.php';
require_once 'interface/InterfaceListarController.php';

abstract class AbstractController
	extends CI_Controller
	implements
	InterfaceToObject,
	InterfaceCreateController,
	InterfaceUpdateController,
	InterfaceRetriveController,
	InterfaceDeleteController,
	InterfaceOptionsController,
	InterfaceContagemController,
	InterfaceListarController
{
	public function __construct()
	{
		parent::__construct();
	}
}
