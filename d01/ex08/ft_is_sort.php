#!/usr/bin/php

<?php

function ft_is_sort($sort)
{
	$default = $sort;
	sort($sort);

	$flag = true;
	foreach($sort as $key=>$value)
	{
	    if($value!=$default[$key])
	        $flag = false;  
	}
	if($flag)
		return TRUE;
	else
		return FALSE;
}

?>