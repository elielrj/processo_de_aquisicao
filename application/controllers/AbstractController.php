<?php

require_once 'InterfaceToObject.php';

abstract class AbstractController extends CI_Controller implements InterfaceToObject
{
	public function __construct()
	{
		parent::__construct();
	}
}
