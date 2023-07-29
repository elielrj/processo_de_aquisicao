<?php

require_once 'interface/InterfaceContagem.php';
require_once 'interface/InterfaceCreate.php';
require_once 'interface/InterfaceDelete.php';
require_once 'interface/InterfaceOptions.php';
require_once 'interface/InterfaceRetrive.php';
require_once 'interface/InterfaceUpdate.php';

abstract class AbstractDAO
	extends CI_Model
	implements
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
