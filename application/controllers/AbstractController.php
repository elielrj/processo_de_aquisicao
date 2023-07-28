<?php

require_once 'InterfaceToArray.php';
require_once 'InterfaceToObject.php';

abstract class AbstractController extends CI_Controller implements InterfaceToArray, InterfaceToObject
{
	public function __construct()
	{
		parent::__construct();
	}
}
