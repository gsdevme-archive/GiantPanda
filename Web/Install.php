<?php

	function error($message)
	{
		echo '<span style="font-size:18px;line-height:32px;background:#ff0000;padding:10px;"><strong>Error </strong>'.$message.'</span>';
	}

	if (PHP_VERSION_ID < 50303)
		error('Your trying to run me on a PHP version below PHP 5.3.3... this framework requires PHP 5.3.3+');

	if (get_magic_quotes_gpc())
		error('This server has magic quotes enabeld... hmm thats not good');

	if($_SERVER['REQUEST_URI'] !== '/index.php')
		error('Server doesnt look like its setup right, <a href="https://github.com/gsdevme/GiantPanda/wiki/Server-Setup">Read More</a>');


	echo '<div><p>We have done a few checks and hopefully your system is ok and ready to run GiantPanda<br/> if you have some errors above it might not work corretly, you can still try it though</p></div>';

	echo '<h2>To use GiantPanda, remove Line 4 within Web/index.php, "require \'./install.php\';exit;"</h2>';