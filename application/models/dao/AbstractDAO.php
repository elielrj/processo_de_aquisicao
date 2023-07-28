<?php

require_once 'InterfaceContagem.php';
require_once 'InterfaceCreate.php';
require_once 'InterfaceDelete.php';
require_once 'InterfaceOptions.php';
require_once 'InterfaceRetrive.php';
require_once 'InterfaceUpdate.php';

abstract class AbstractDAO extends CI_Model implements
	InterfaceContagem,
	InterfaceCreate,
	InterfaceDelete,
	InterfaceOptions,
	InterfaceRetrive,
	InterfaceUpdate
{
	public function __construct()
	{
		parent::__construct();
	}
}