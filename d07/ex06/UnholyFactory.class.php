<?php

class UnholyFactory
{
	private		$_fighters = [];

	public function absorb($fighter)
	{
		if ($fighter instanceof Fighter)
		{
			if (array_key_exists($fighter->getRole(), $this->_fighters))
				printf("(Factory already absorbed a fighter of type %s)" . PHP_EOL, $fighter->getRole());
			else
			{
				$this->_fighters[$fighter->getRole()] = $fighter;
				printf("(Factory absorbed a fighter of type %s)" . PHP_EOL, $fighter->getRole());
			}
		}
		else
			print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
	}

	public function		fabricate($fighter)
	{
		if (array_key_exists($fighter, $this->_fighters))
		{
			printf("(Factory fabricates a fighter of type %s)" . PHP_EOL, $fighter);

			return $this->_fighters[$fighter];
		}

		printf("(Factory hasn't absorbed any fighter of type %s)" . PHP_EOL, $fighter);
		return NULL;
	}
}

?>