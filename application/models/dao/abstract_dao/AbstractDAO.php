<?php

require_once 'interface/InterfaceContagemDAO.php';
require_once 'interface/InterfaceCreateDAO.php';
require_once 'interface/InterfaceDeleteDAO.php';
require_once 'interface/InterfaceOptionsDAO.php';
require_once 'interface/InterfaceRetriveDAO.php';
require_once 'interface/InterfaceUpdateDAO.php';

abstract class AbstractDAO
	extends CI_Model
	implements
	InterfaceContagemDAO,
	InterfaceCreateDAO,
	InterfaceDeleteDAO,
	InterfaceOptionsDAO,
	InterfaceRetriveDAO,
	InterfaceUpdateDAO
{
	public function __construct()
	{
		parent::__construct();
	}
}
