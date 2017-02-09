<?php
	session_start();
	session_destroy();
	header("location:sesexp.html");
	exit();
?>