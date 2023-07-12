<?php
function replace_fisc_adm($value)
{
	return ucfirst(str_replace('_fisc_adm', ' Fisc Adm', $value));
}
