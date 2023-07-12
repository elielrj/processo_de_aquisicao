<?php
function replace_od($value)
{
	return ucfirst(str_replace('_od', ' OD', $value));
}
