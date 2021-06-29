<?php

return [
    'prefix' => [
        'admin' => 'admin'
    ],

    'boolean' => [
        '0' => 'No',
        '1' => 'Yes',
    ],

    'roles' => [
	    0 => 'Guest',
	    1 => 'Client',
        5 => 'User',
    ],
    
    'adminRoles' => [
		10 => 'Admin',  
    ],
    
    'modules' => [
        'dashboard' => 'Dashboard',
        'menu' => 'Menu',
        'users' => 'Users',
        'items' => 'Items',
        'products' => 'Producten',
        'collections' => 'Collecties',
        'projects' => 'Projects',
        'content' => 'Content',
        'clients' => 'Klanten',
        'invoices' => 'Facturen',
        'invoice_presets' => 'Factuur presets',
        'bookings' => 'Booking',
        'providers' => 'Booking Providers',
        'services' => 'Booking Services',
        'coupons' => 'Coupons',
        'shipments' => 'Levering',
        'orders' => 'Bestellingen',
        'templates' => 'Templates',
        'forms' => 'Forms',
    ],
    
    'icons' => [
	    'ti-home' => 'ti-home',
	    'ti-menu' => 'ti-menu',
	    'ti-user' => 'ti-user',
	    'ti-pencil-alt' => 'ti-pencil-alt',
	    'ti-car' => 'ti-car',
	    'ti-write' => 'ti-write',
	    'ti-layout' => 'ti-layout',
	    'ti-package' => 'ti-package',
	    'ti-hummer' => 'ti-hummer',
	    'ti-pie-chart' => 'ti-pie-chart',
	    'ti-shopping-cart' => 'ti-shopping-cart',
	    'ti-comments' => 'ti-comments',
	    'ti-truck' => 'ti-truck',
	    'ti-receipt' => 'ti-receipt',
	    'ti-dashboard' => 'ti-dashboard',
	    'ti-tag' => 'ti-tag',
	    'ti-bar-chart' => 'ti-bar-chart',
    ],
    
    'status' => [
        '1' => 'Active',
        '0' => 'Inactive',
    ],
    
    'invoice_status' => [
        '1' => 'pakka::app.generated',
        '2' => 'pakka::app.sent',
        '3' => 'pakka::app.payment_received',
        '4' => 'pakka::app.canceled',
        '5' => 'pakka::app.overdue',
    ],
    
    'document_type' => [
        '1' => 'pakka::app.invoice',
        '2' => 'pakka::app.credit_invoice',
        '3' => 'pakka::app.proforma',
        '4' => 'pakka::app.quotation',
        '5' => 'pakka::app.order_form',
    ],
    
    //input types
    'type' => [
        'text' => 'text',
        'textarea' => 'textarea',
        'images' => 'images',
        'files' => 'files',
        'select' => 'select',
        'checkbox' => 'checkbox',
    ],

    //input attribute width
	'input_width' => [
        '25' => '25%',
        '50' => '50%',
        '75' => '75%',
        '100' => '100%'
    ],

	'coupon_type' => [
		"1" => 'pakka::app.voucher',
		"2" => 'pakka::app.action'
	],
	
	'shipment_delivery' => [
        '0' => 'pakka::app.pick_up',
        '1' => 'pakka::app.delivery'
    ],
    
    'shipment_carrier' => [
	    '1' => 'pakka::app.own_business',
	    '2' => 'pakka::app.bpost',
        '3' => 'pakka::app.dhl',
        '4' => 'pakka::app.dpd',
        '5' => 'pakka::app.gls',
        '6' => 'pakka::app.postnl',
        '7' => 'pakka::app.ups'
    ],
    
    'shipment_condition_operator' => [
        '1' => 'pakka::app.upward_of',
        '2' => 'pakka::app.up_to_and_including'
    ],
	
	'shipment_condition_type' => [
		'1' => 'pakka::app.eur',
		'2' => 'pakka::app.grams'
/*
        '1' => 'pakka::app.valuta',
        '2' => 'pakka::app.weight'
*/
    ],
	
	'regions' => [
        'BE' => 'pakka::app.belgium',
        'NL' => 'pakka::app.netherlands',
        'LU' => 'pakka::app.luxembourg',
        'FR' => 'pakka::app.france',
        'DE' => 'pakka::app.germany'
    ],
	
	'cart_service_icons' => [
        'fas fa-gift' => 'Cadeau',
        'fas fa-exchange-alt' => 'Retour',
        'fas fa-shipping-fast' => 'Snelle levering',
        'fas fa-fire-extinguisher' => 'brandblusser',
        'fas fa-tools' => 'Gereedschap',
        'fas fa-file-signature' => 'Contract'
    ],
	
	'base_section_editables' => [
		"divider_shape_top",
		"divider_color_top",
		"divider_flip_top",
		"divider_height_top",
		"divider_width_top",
		"divider_shape_bottom",
		"divider_color_bottom",
		"divider_flip_bottom",
		"divider_height_bottom",
		"divider_width_bottom", 
    ],
	
    /*
    |------------------------------------------------------------------------------------
    | ENV of APP
    |------------------------------------------------------------------------------------
    */
    'APP_ADMIN' => 'admin',
    'APP_TOKEN' => env('APP_TOKEN', 'admin123456'),
];
