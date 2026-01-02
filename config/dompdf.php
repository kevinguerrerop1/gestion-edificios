<?php

return array(

'show_warnings' => false,

    'options' => [

        'isRemoteEnabled' => true,
        'isHtml5ParserEnabled' => true,

        'defaultFont' => 'DejaVu Sans',

        'font_dir' => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),

        'temp_dir' => sys_get_temp_dir(),

        'chroot' => realpath(base_path()),

        'enable_php' => false,
        'enable_javascript' => true,

        'dpi' => 96,
    ],

);
