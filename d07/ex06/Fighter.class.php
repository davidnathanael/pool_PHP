<?php

abstract class Fighter
{
	private $_role;

	abstract public function fight($target);

	public function __construct($role)
	{
		$this->_role = $role;
	}

	public function getRole()
	{
		return $this->_role;
	}

}

?>