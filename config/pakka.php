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
        '1' => 'app.generated',
        '2' => 'app.sent',
        '3' => 'app.payment_received',
        '4' => 'app.canceled',
        '5' => 'app.overdue',
    ],
    
    'document_type' => [
        '1' => 'app.invoice',
        '2' => 'app.credit_invoice',
        '3' => 'app.proforma',
        '4' => 'app.quotation',
        '5' => 'app.order_form',
    ],
    
    'type' => [
        'text' => 'text',
        'textarea' => 'textarea',
        'images' => 'images',
        'files' => 'files',
        'select' => 'select',
        'checkbox' => 'checkbox',
    ],
	
	'coupon_type' => [
		"1" => 'app.voucher',
		"2" => 'app.action'
	],
	
	'shipment_delivery' => [
        '0' => 'app.pick_up',
        '1' => 'app.delivery'
    ],
    
    'shipment_carrier' => [
	    '1' => 'app.own_business',
	    '2' => 'app.bpost',
        '3' => 'app.dhl',
        '4' => 'app.dpd',
        '5' => 'app.gls',
        '6' => 'app.postnl',
        '7' => 'app.ups'
    ],
    
    'shipment_condition_operator' => [
        '1' => 'app.upward_of',
        '2' => 'app.up_to_and_including'
    ],
	
	'shipment_condition_type' => [
		'1' => 'app.eur',
		'2' => 'app.grams'
/*
        '1' => 'app.valuta',
        '2' => 'app.weight'
*/
    ],
	
	'regions' => [
        'BE' => 'app.belgium',
        'NL' => 'app.netherlands',
        'LU' => 'app.luxembourg',
        'FR' => 'app.france',
        'DE' => 'app.germany'
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
