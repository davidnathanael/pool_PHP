<?php

class NightsWatch
{
	private $_recruits = [];

	public function fight()
	{
		foreach ($this->_recruits as $recruit)
			$recruit->fight();
	}

	public function recruit($pers)
	{
		if ($pers instanceof IFighter)
			$this->_recruits[] = $pers;
	}
}

?>