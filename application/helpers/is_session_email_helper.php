<?php

function is_session_email_helper()
{
	return isset($_SESSION[SESSION_EMAIL]);
}
