<?php
error_reporting(0);
class Logout
{
	public function logoutsistem()
	{
		include_once('class/class.akses.php');
		$logout = new Akses();
		$logout->logoutsistem();
	}
}
