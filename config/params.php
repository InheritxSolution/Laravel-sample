<?php
return [
	'user_role' => [
		'admin' => 1,
		'user' => 0,
	],
	'pagination' => [
		'rows' => [10, 25, 50, 100]
	],
	'cms' => [
		'terms_and_conditions',
		'privacy_policy',
		'about_us',
	],
	'tmp' => [
		'upload' => 'storage/app/public/'
	],
	'available_lang' => [
		'en',
		'de',
	],
	'status' => [
		'inactive' => 0,
		'active' => 1,
	],
	'force_update' => [
		'yes' => 0,
		'no' => 1,
	],
	's3_path' => [
		'profile_img' => '/profile_img',
	],
	'image_upload_path' => [
		'sadmin_image' => '/img/'
	]
];
