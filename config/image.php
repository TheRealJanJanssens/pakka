<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */
	
    'driver' => 'gd',
    'storage' => '/storage/app/public/uploads/',
    'public' => '/public/storage/uploads/',
    'folder' => 'uploads',
    'formats' => [
		2500,
		1500,
		1000,
		750,
		500,
		300,
		100
    ],
    
	'avatar' => [
        'public' => '/public/storage/avatar/',
        'folder' => 'avatar',
        
        'width'  => 400,
        'height' => 400,
    ],
    
    'app' => [
        'public' => '/public/storage/app/',
        'folder' => 'app'
    ],
];
