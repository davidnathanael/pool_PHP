#!//usr/bin/php
<?php
	if ($argc != 2)
		ft_print_error();

	$months = ["janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre"];
	$entry = $argv[1];
	$date = explode(" ", $entry);
	if(!ft_check_format($date, $months, $days))
		ft_print_error();

	$day = $date[1];
	$month = ft_get_month($date[2], $months);
	$year = $date[3];
	$time = $date[4];
	date_default_timezone_set('Europe/Paris');
	$since_epoch = strtotime("$day-$month-$year $time");
	echo $since_epoch. "\n";

	function ft_check_format($array_date, $months, $days)
	{
		if (count($array_date) != 5)
			return FALSE;

		if (!preg_match("/^([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)$/", $array_date[0]))
			return FALSE;
		if (!preg_match("/^(0?[1-9]|[12]\d|3[01])$/", $array_date[1]))
			return FALSE;
		if (!preg_match("/^([Jj]anvier|[Ff]evrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]out|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd]ecembre)$/", $array_date[2]))
			return FALSE;
		if (!preg_match("/^\d{4}$/", $array_date[3]))
			return FALSE;
		if (!preg_match("/^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/", $array_date[4]))
			return FALSE;
		return TRUE;
	}

	function ft_get_month($month, $array)
	{
		foreach ($array as $key => $value) {
			if ($value == strtolower($month))
				return $key + 1;
		}

	}

	function ft_print_error()
	{
		echo "Wrong Format\n";
		exit();
	}
?>