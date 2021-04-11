<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings inputs
    |--------------------------------------------------------------------------
    |
    | type = textnolang, textnolangarea, select
    | level = global, personal
    | options = the options given if type is select
    | default = default value if no value is set in settings.
    |
    */
/*
    "groups" =>[
	    "app.settings_assets.general_settings",
    ],
*/
    [
	    "category" => "app.settings_assets.general_settings",
		"inputs" =>[
		    [
			    'name' => "site_title",
				'label' => "app.settings_assets.title",
				'type' => "text",
				'level' => "global",
		    ],
		    [
			    'name' => "site_description",
				'label' => "app.settings_assets.description",
				'type' => "text",
				'level' => "global",
		    ],
		    [
			    'name' => "site_keywords",
				'label' => "app.settings_assets.keywords",
				'type' => "textarea",
				'level' => "global",
		    ],
		]
	],
	[
	    "category" => "app.settings_assets.app_images",
		"inputs" =>[
		    [
			    'name' => "app_logo",
				'label' => "app.settings_assets.app_logo",
				'type' => "file",
				'level' => "global",
		    ],
		    [
			    'name' => "app_cover",
				'label' => "app.settings_assets.app_cover",
				'type' => "file",
				'level' => "global",
		    ],
		    [
			    'name' => "app_dashboard_cover",
				'label' => "app.settings_assets.app_dashboard_cover",
				'type' => "file",
				'level' => "global",
		    ],
		]
	],
	[
	    "category" => "app.settings_assets.style_settings",
		"inputs" =>[
			[
			    'name' => "primary_color",
				'label' => "app.settings_assets.primary_color",
				'type' => "color",
				'level' => "global"
		    ],
		    [
			    'name' => "secondary_color",
				'label' => "app.settings_assets.secondary_color",
				'type' => "color",
				'level' => "global"
		    ],
			[
			    'name' => "highlight_color",
				'label' => "app.settings_assets.highlight_color",
				'type' => "color",
				'level' => "global"
		    ],
			[
			    'name' => "grey_color",
				'label' => "app.settings_assets.grey_color",
				'type' => "color",
				'level' => "global"
		    ],
			[
			    'name' => "dark_color",
				'label' => "app.settings_assets.dark_color",
				'type' => "color",
				'level' => "global"
		    ],
		    [
			    'name' => "body_font",
				'label' => "app.settings_assets.body_font",
				'type' => "select",
				'level' => "global",
				'options' => config('_fonts')
		    ],
		    [
			    'name' => "heading_font",
				'label' => "app.settings_assets.heading_font",
				'type' => "select",
				'level' => "global",
				'options' => config('_fonts')
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.script_settings",
		"inputs" =>[
		    [
			    'name' => "script_css",
				'label' => "app.settings_assets.script_css",
				'type' => "textareanolang",
				'level' => "global",
			],
			[
			    'name' => "script_js",
				'label' => "app.settings_assets.script_js",
				'type' => "textareanolang",
				'level' => "global",
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.company_settings",
		"inputs" =>[
		    [
			    'name' => "company_name",
				'label' => "app.settings_assets.company_name",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_address",
				'label' => "app.settings_assets.address",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_city",
				'label' => "app.settings_assets.city",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_zip",
				'label' => "app.settings_assets.zip",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_country",
				'label' => "app.settings_assets.country",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_email",
				'label' => "app.settings_assets.email",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_phone",
				'label' => "app.settings_assets.phone",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_website",
				'label' => "app.settings_assets.website",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_vat",
				'label' => "app.settings_assets.vat",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_bc",
				'label' => "app.settings_assets.bc",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_iban",
				'label' => "app.settings_assets.iban",
				'type' => "textnolang",
				'level' => "global",
		    ],
		]
	],
	[
	    "category" => "app.settings_assets.opening_hours",
		"inputs" =>[
		    [
			    'name' => "company_monday",
				'label' => "app.settings_assets.monday",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_tuesday",
				'label' => "app.settings_assets.tuesday",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_wednesday",
				'label' => "app.settings_assets.wednesday",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_thursday",
				'label' => "app.settings_assets.thursday",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_friday",
				'label' => "app.settings_assets.friday",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_saturday",
				'label' => "app.settings_assets.saturday",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "company_sunday",
				'label' => "app.settings_assets.sunday",
				'type' => "textnolang",
				'level' => "global",
		    ],
		]
	],
	[
	    "category" => "app.settings_assets.shop_settings",
		"inputs" =>[
		    [
			    'name' => "shop_status",
				'label' => "app.settings_assets.shop_status",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "shop_general_vat",
				'label' => "app.settings_assets.general_vat",
				'type' => "number",
				'level' => "global",
				'default' => "21",
		    ],
		    [
			    'name' => "shop_package_weight",
				'label' => "app.settings_assets.shop_package_weight",
				'type' => "number",
				'level' => "global",
				'default' => "21",
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.order_settings",
		"inputs" =>[
		    [
			    'name' => "order_name_prefix",
				'label' => "app.settings_assets.order_name_prefix",
				'type' => "textnolang",
				'level' => "global",
				'default' => "{Y}",
		    ],
		    [
			    'name' => "order_name_number_count",
				'label' => "app.settings_assets.order_name_number_count",
				'type' => "number",
				'level' => "global",
				'default' => "4",
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.item_settings",
		"inputs" =>[
		    [
			    'name' => "item_layout",
				'label' => "app.settings_assets.layout",
				'type' => "select",
				'level' => "personal",
				'options' => [
					[
						"option_id" => 1,
						"value" => "list",
					],
					[
						"option_id" => 2,
						"value" => "searchable list",
					],
					[
						"option_id" => 3,
						"value" => "grid",
					]
				]
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.social_settings",
		"inputs" =>[
		    [
			    'name' => "social_facebook",
				'label' => "app.settings_assets.facebook",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "social_instagram",
				'label' => "app.settings_assets.instagram",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "social_twitter",
				'label' => "app.settings_assets.twitter",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "social_youtube",
				'label' => "app.settings_assets.youtube",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "social_linkedin",
				'label' => "app.settings_assets.linkedin",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "social_behance",
				'label' => "app.settings_assets.behance",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "social_pinterest",
				'label' => "app.settings_assets.pinterest",
				'type' => "textnolang",
				'level' => "global",
		    ],
		    [
			    'name' => "social_tumblr",
				'label' => "app.settings_assets.tumblr",
				'type' => "textnolang",
				'level' => "global",
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.invoice_settings",
		"inputs" =>[
			[
			    'name' => "invoice_multiple_numbers",
				'label' => "app.settings_assets.invoice_multiple_numbers",
				'type' => "switch",
				'level' => "global",
		    ],
			[
			    'name' => "invoice_valuta",
				'label' => "app.settings_assets.invoice_valuta",
				'type' => "textnolang",
				'level' => "global",
				'default' => "€",
		    ],
		    [
			    'name' => "invoice_default_vat",
				'label' => "app.settings_assets.invoice_default_vat",
				'type' => "textnolang",
				'level' => "global",
				'default' => "21",
		    ],
		    [
			    'name' => "invoice_prefix",
				'label' => "app.settings_assets.invoice_prefix",
				'type' => "textnolang",
				'level' => "global",
				'default' => "{Y}",
		    ],
		    [
			    'name' => "invoice_number_count",
				'label' => "app.settings_assets.invoice_number_count",
				'type' => "number",
				'level' => "global",
				'default' => "4",
		    ],
		    [
			    'name' => "invoice_quotation_format",
				'label' => "app.settings_assets.invoice_quotation_format",
				'type' => "textnolang",
				'level' => "global",
				'default' => "{y}{m}{d}/{g}{i}",
		    ],
		    [
			    'name' => "invoice_due_period",
				'label' => "app.settings_assets.invoice_due_period",
				'type' => "select",
				'level' => "global",
				'options' => [
					[
						"option_id" => "+ 30 day",
						"value" => "30 dagen",
					],
					[
						"option_id" => "+ 14 day",
						"value" => "14 dagen",
					],
					[
						"option_id" => "+ 7 day",
						"value" => "7 dagen",
					]
				]
		    ],
		    [
			    'name' => "invoice_general_description",
				'label' => "app.settings_assets.invoice_general_description",
				'type' => "textarea",
				'level' => "global",
		    ],
		]
	],
	[
	    "category" => "app.settings_assets.booking_settings",
		"inputs" =>[
		    [
			    'name' => "booking_type",
				'label' => "app.settings_assets.booking_type",
				'type' => "select",
				'level' => "global",
				'options' => [
					[
						"option_id" => 1,
						"value" => "Appointments",
					],
					[
						"option_id" => 2,
						"value" => "Reservations",
					]
				]
		    ],
		    [
			    'name' => "booking_timeslot_increment",
				'label' => "app.settings_assets.booking_timeslot_increment",
				'type' => "select",
				'level' => "global",
				'options' => [
					[
						"option_id" => "30",
						"value" => "0u30",
					],
					[
						"option_id" => "30",
						"value" => "1u00",
					],
					[
						"option_id" => "90",
						"value" => "1u30",
					],
					[
						"option_id" => "120",
						"value" => "2u00",
					],
					[
						"option_id" => "150",
						"value" => "2u30",
					],
					[
						"option_id" => "180",
						"value" => "3u00",
					]
				]
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.editor_settings",
		"inputs" =>[
		    [
			    'name' => "editor_autosave",
				'label' => "app.settings_assets.editor_autosave",
				'type' => "switch",
				'level' => "global",
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.image_settings",
		"inputs" =>[
		    [
			    'name' => "image_optimization",
				'label' => "app.settings_assets.permission_image_optimization",
				'type' => "switch",
				'level' => "global",
			],
			[
			    'name' => "image_webp_convert",
				'label' => "app.settings_assets.image_webp_convert",
				'type' => "switch",
				'level' => "global",
		    ],
			[
			    'name' => "image_compression",
				'label' => "app.settings_assets.image_compression",
				'type' => "number",
				'level' => "global",
				'default' => 90
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.tracking_settings",
		"inputs" =>[
		    [
			    'name' => "track_gtm_head",
				'label' => "app.settings_assets.gtm_head",
				'type' => "textareanolang",
				'level' => "global",
		    ],
		    [
			    'name' => "track_gtm_body",
				'label' => "app.settings_assets.gtm_body",
				'type' => "textareanolang",
				'level' => "global",
		    ],
		    [
			    'name' => "track_fbpxl",
				'label' => "app.settings_assets.fbpxl",
				'type' => "textareanolang",
				'level' => "global",
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.page_role_settings",
		"inputs" =>[
		    [
			    'name' => "role_general_terms",
				'label' => "app.settings_assets.role_general_terms",
				'type' => "pageselect",
				'level' => "global",
		    ],
		    [
			    'name' => "role_product_list",
				'label' => "app.settings_assets.role_product_list",
				'type' => "pageselect",
				'level' => "global",
		    ],
		    [
			    'name' => "role_product_detail",
				'label' => "app.settings_assets.role_product_detail",
				'type' => "pageselect",
				'level' => "global",
		    ],
		    [
			    'name' => "role_cart",
				'label' => "app.settings_assets.role_cart",
				'type' => "pageselect",
				'level' => "global",
		    ],
		    [
			    'name' => "role_checkout",
				'label' => "app.settings_assets.role_checkout",
				'type' => "pageselect",
				'level' => "global",
		    ],
		    [
			    'name' => "role_order_confirmation",
				'label' => "app.settings_assets.role_order_confirmation",
				'type' => "pageselect",
				'level' => "global",
		    ],
		    [
			    'name' => "role_delivery_info",
				'label' => "app.settings_assets.role_delivery_info",
				'type' => "pageselect",
				'level' => "global",
		    ]
		]
	],
	[
	    "category" => "app.settings_assets.permission_settings",
		"inputs" =>[
		    [
			    'name' => "permission_perm_edit",
				'label' => "app.settings_assets.permission_edit",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_input_edit",
				'label' => "app.settings_assets.input_edit",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_content_edit",
				'label' => "app.settings_assets.content_edit",
				'type' => "switch",
				'level' => "global",
		    ],
			[
			    'name' => "permission_template_managment",
				'label' => "app.settings_assets.permission_template_managment",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_user_admin_edit",
				'label' => "app.settings_assets.user_admin_edit",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_content_edit_advanced",
				'label' => "app.settings_assets.content_edit_advanced",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_layout_edit",
				'label' => "app.settings_assets.layout_edit",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_layout_edit_items",
				'label' => "app.settings_assets.layout_edit_items",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_section_edit",
				'label' => "app.settings_assets.section_edit",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_edit_app_menu",
				'label' => "app.settings_assets.permission_edit_app_menu",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_add_menus",
				'label' => "app.settings_assets.permission_add_menus",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_edit_page_roles",
				'label' => "app.settings_assets.permission_edit_page_roles",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_edit_admin_images",
				'label' => "app.settings_assets.permission_edit_admin_images",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_show_invoice_settings",
				'label' => "app.settings_assets.permission_show_invoice_settings",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_show_image_optimization",
				'label' => "app.settings_assets.permission_show_image_optimization",
				'type' => "switch",
				'level' => "global",
		    ],
		    [
			    'name' => "permission_show_style_options",
				'label' => "app.settings_assets.permission_show_style_options",
				'type' => "switch",
				'level' => "global",
		    ]
		]
	],
];
