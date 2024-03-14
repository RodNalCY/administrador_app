<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Login',
    'title_prefix' => 'DALIFHAR | ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => null,
    'logo_img' => '/img/icons/logo-circular.png',
    'logo_img_class' => 'brand-image img-circle elevation-2',
    'logo_img_xl_class' => null,
    'logo_img_alt' => 'LOGO NAVBAR',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => '/img/icons/logo-circular.png',
            'alt' => 'LOGO LOGIN',
            'width' => 150,
            'height' => 150,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => '/img/icons/logo-circular.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 150,
            'height' => 150,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-info',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    // 'classes_auth_card' => '',
    // 'classes_auth_header' => 'bg-gradient-info',
    // 'classes_auth_body' => '',
    // 'classes_auth_footer' => '',
    // 'classes_auth_icon' => 'fa-lg text-info',
    // 'classes_auth_btn' => 'btn-flat btn-primary',

    // 'classes_auth_card' => 'card-outline card-info',
    // 'classes_auth_header' => '',
    // 'classes_auth_body' => '',
    // 'classes_auth_footer' => 'd-none',
    // 'classes_auth_icon' => '',
    // 'classes_auth_btn' => 'btn-flat btn-info',

    'classes_auth_card' => 'bg-gradient-dark',
    'classes_auth_header' => '',
    'classes_auth_body' => 'bg-gradient-light',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-fw text-dark',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => 'bg-dark',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-info elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar navbar-dark bg-dark',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 250,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => false,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],

        // Aqui añadir tus rutas para tu navbar 
        [
            'icon' => 'far fa-fw fas fa-heartbeat',
            'text' => "🥼 Mi Perfil 🧬",
            'url' => 'dashboard/perfil',
            'label' => 'Dev',
            'label_color' => 'warning',
            'can'  => 'dashboard',
        ],

        [
            'icon' => 'far fa-fw fas fa-chart-pie',
            'text' => 'Dashboard',
            'url' => 'dashboard',
            'label' => 'Nuevo',
            'label_color' => 'primary',
            'can'  => 'dashboard',
        ],

        // ['header' => 'ADMINISTRADOR'],        
        [
            'icon' => '',
            'text' => 'ADMINISTRADOR',
            'url'  => '#',
            'can'  => 'administrador',
        ],
        [
            'icon' => 'fas fa-fw fa-address-card',
            'text' => 'Empleados',
            'url'  => '/administrador/empleados',
            'can'  => 'administrador.empleados',
            'label' => 'OjO',
            'label_color' => 'info',
        ],
        [
            'icon' => 'fas fa-fw fa-user-tie',
            'text' => 'Usuarios',
            'url'  => '/administrador/usuarios',
            'can'  => 'administrador.usuarios',
            'label' => 'OjO',
            'label_color' => 'info',
        ],
        [
            'icon' => 'fas fa-fw fa-user-cog',
            'text' => 'Roles',
            'url'  => '/administrador/roles',
            'can'  => 'administrador.roles',
        ],
        [
            'icon' => 'fas fa-fw fa-user-shield',
            'text' => 'Permisos',
            'url'  => '/administrador/permisos',
            'can'  => 'administrador.permisos',
        ],
        // ['header' => 'MOVIMIENTOS'],
        [
            'icon' => '',
            'text' => 'MOVIMIENTOS',
            'url'  => '#',
            'can'  => 'movimientos',
        ],
        [
            'icon' => 'fas fa-fw fa-cart-plus',
            'text' => 'Compras',
            'url'  => 'movimientos/compras',
            'can' => 'movimientos.compras',
        ],
        [
            'icon' => 'fas fa-fw fa-handshake',
            'text' => 'Ventas',
            'url'  => 'movimientos/ventas',
            'can' => 'movimientos.ventas',
            'label' => 'OjO',
            'label_color' => 'danger',
        ],
        [
            'icon' => 'fas fa-fw fa-cash-register',
            'text' => 'Caja',
            'url'  => 'movimientos/caja',
            'can' => 'movimientos.caja',
        ],
        // ['header' => 'MANTENIMIENTO'],
        [
            'icon' => '',
            'text' => 'MANTENIMIENTO',
            'url'  => '#',
            'can'  => 'mantenimiento',
        ],
        [
            'icon' => 'fas fa-fw fa-box-open',
            'text' => 'Productos',
            'url'  => 'mantenimiento/productos',
            'can'  => 'mantenimiento.productos',
            'label' => 'OjO',
            'label_color' => 'danger',
        ],
        [
            'icon' => 'fas fa-fw fa-users',
            'text' => 'Clientes',
            'url'  => 'mantenimiento/clientes',
            'can'  => 'mantenimiento.clientes',
            'label' => 'OjO',
            'label_color' => 'danger',
        ],
        [
            'icon' => 'fas fa-fw fa-truck',
            'text' => 'Proveedores',
            'url'  => 'mantenimiento/proveedores',
            'can'  => 'mantenimiento.proveedores',
        ],
        [
            'icon' => 'fas fa-fw fa-capsules',
            'text' => 'Presentación',
            'url'  => 'mantenimiento/presentacion',
            'can'  => 'mantenimiento.presentacion',
            'label' => 'OjO',
            'label_color' => 'danger',
        ],
        [
            'icon' => 'fas fa-fw fa-flask',
            'text' => 'Laboratorios',
            'url'  => 'mantenimiento/laboratorios',
            'can'  => 'mantenimiento.laboratorios',

            'label' => 'OjO',
            'label_color' => 'danger',
        ],
        [
            'icon' => 'fas fa-fw fa-file',
            'text' => 'Comprobantes',
            'url'  => 'mantenimiento/comprobantes',
            'can'  => 'mantenimiento.comprobantes',
        ],
        // ['header' => 'GESTIÓN'],
        [
            'icon' => '',
            'text' => 'CONSULTAS',
            'url'  => '#',
            'can'  => 'gestion',
        ],
        [
            'icon_color' => 'cyan',
            'text' => 'Ventas',
            'can'  => 'gestion.ventas',
            'url'  => 'gestion/ventas',
            'label' => 'Nuevo',
            'label_color' => 'primary',
        ],
        [
            'icon_color' => 'cyan',
            'text' => 'Compras',
            'can'  => '',
            'url'  => '#',
            'label' => 'Dev',
            'label_color' => 'warning',
        ],
        [
            'icon_color' => 'cyan',
            'text' => 'Productos',
            'can'  => '',
            'url'  => '#',
            'label' => 'Dev',
            'label_color' => 'warning',
        ],
        // [
        //     'text'    => 'Consultar',
        //     'icon'    => 'fas fa-fw fa-search',
        //     'can'  => 'gestion',
        //     'submenu' => [
        //         [
        //             'text'       => 'Ventas',
        //             'icon_color' => 'cyan',
        //             'url'        => '#',
        //             'can'  => 'gestion.ventas',
        //             'url'  => 'gestion/ventas',
        //             'label' => 'Nuevo',
        //             'label_color' => 'primary',
        //         ],
        //         [
        //             'text'       => 'Compras',
        //             'icon_color' => 'cyan',                    
        //             'can'  => 'gestion.compras',
        //             'url'        => '#',
        //         ],
        //         [
        //             'text'       => 'Productos',
        //             'icon_color' => 'cyan',
        //             'can'  => 'gestion.productos',
        //             'url'        => '#',
        //         ],
        //         // [
        //         //     'text'       => 'Clientes',
        //         //     'icon_color' => 'cyan',
        //         //     'url'        => '#',
        //         //     'can'  => 'gestion',
        //         // ],
        //         // [
        //         //     'text'       => 'Empleados',
        //         //     'icon_color' => 'cyan',
        //         //     'url'        => '#',
        //         //     'can'  => 'gestion',
        //         // ],
        //         // [
        //         //     'text'       => 'Proveedores',
        //         //     'icon_color' => 'cyan',
        //         //     'url'        => '#',
        //         //     'can'  => 'gestion',
        //         // ],
        //     ],
        // ],

        // ['header' => 'DATOS'],
        // [
        //     'icon'=>'',
        //     'text' => 'DATOS',
        //     'url'  => '#',
        //     'can'  => 'datos',
        // ],  
        // [
        //     'text'    => 'Reportes',
        //     'icon'    => 'fas fa-fw fa-print',
        //     'can'  => 'datos',
        //     'submenu' => [
        //         [
        //             'text'       => 'Clientes',
        //             'icon_color' => 'blue',
        //             'url'        => '#',
        //             'can'  => 'datos',
        //         ],
        //         [
        //             'text'       => 'Productos',
        //             'icon_color' => 'blue',
        //             'url'        => '#',
        //             'can'  => 'datos',
        //         ],
        //         [
        //             'text'       => 'Proveedores',
        //             'icon_color' => 'blue',
        //             'url'        => '#',
        //             'can'  => 'datos',
        //         ],
        //         [
        //             'text'       => 'Empleados',
        //             'icon_color' => 'blue',
        //             'url'        => '#',
        //             'can'  => 'datos',
        //         ],
        //     ],
        // ],

        // ['header' => 'account_settings'],
        // [
        //     'text' => 'profile',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-user',
        // ],
        // [
        //     'text' => 'change_password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Bootstrap5' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap5/js/bootstrap.bundle.min.js',
                ],
                // [
                //     'type' => 'css',
                //     'asset' => true,
                //     'location' => 'vendor/bootstrap5/css/bootstrap.min.css',
                // ],                
                // [
                //     'type' => 'js',
                //     'asset' => true,
                //     'location' => 'vendor/bootstrap5/js/bootstrap.min.js',
                // ],
                // [
                //     'type' => 'js',
                //     'asset' => true,
                //     'location' => 'vendor/bootstrap5/js/popper.min.js',
                // ],
            ],
        ],

        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        // 'Sweetalert2' => [
        //     'active' => true,
        //     'files' => [
        //         [
        //             'type' => 'js',
        //             'asset' => false,
        //             'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
        //         ],
        //     ],
        // ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.all.min.js',
                ],
            ],
        ],
        'ParticleJS' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'js/particles.min.js',
                ],
            ],
        ],
        // 'FontAwesome' => [
        //     'active' => true,
        //     'files' => [
        //         [
        //             'type' => 'css',
        //             'asset' => true,
        //             'location' => 'vendor/fontawesome-free/css/fontawesome.min.css',
        //         ],
        //     ],
        // ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
