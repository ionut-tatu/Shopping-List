<?php

/**
 *	Config File. Add stylesheets or javascripts here.
 *	See app/system/helper/Asset.php for more details
 */

function getAssets() 
{
	return [
		'stylesheets' => [
			'public/css/bootstrap/css/bootstrap.min.css',
			'public/css/font-awesome/css/font-awesome.min.css',
			'public/css/main.css'
		],
		'javascripts' => [

		]
	];
}