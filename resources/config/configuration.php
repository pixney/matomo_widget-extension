<?php

return [
    'api_key' => [
        'type'   => 'anomaly.field_type.text',
        'config' => [
            'default_value' => 'anonymous',
        ],
    ],
    'id_site' => [
        'type'   => 'anomaly.field_type.text',
        'config' => [
            'default_value' => '',
        ],
    ],
    'base_url' => [
        'type'   => 'anomaly.field_type.url',
        'config' => [
            'default_value' => '',
        ],
    ],
];
