<?php
	// Does Not Function Currently.
	// Gives error, as such can't login.

	$POST =
	[
		'user' => 'STOUserName',
		'pw' => 'STOPassWord',
	]


	$opts =
	[
		'http' =>
		[
			'method' => 'POST',
			'header' => 'Content-type: application/x-www-form-urlencoded',
			'content' => $POST;
		]
	];

	$ctx = stream_context_create($opts);

	echo file_get_contents('https://auth.startrekonline.com', FALSE);

?>
