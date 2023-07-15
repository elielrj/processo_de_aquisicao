<?php
function clear_strings($string)
{
	return strtolower(
		preg_replace(
			"/[^a-zA-Z0-9-]/",
			"-",
			strtr(
				utf8_decode(
					trim($string)),
				utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
				"aaaaeeiooouuncAAAAEEIOOOUUNC-"
			)
		)
	);
}
