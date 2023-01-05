<?php

/**
 * is_visible: Show category on the catalog home page
 * official_only: Only show items uploaded to the system account
 * limiteds_only: Only show limited items
 * name_like: Item names need to include a specific string
 * item_ids: Only show these specific items in the category
 */

$recentTypes = ['hat', 'face', 'gadget', 'crate', 'bundle'];

return [
    [
        'is_visible' => true,
        'official_only' => true,
        'limiteds_only' => false,
        'title' => 'Assorted Crate #2',
        'name_like' => null,
        'item_types' => [],
        'item_ids' => [
            437,
            434,
            428,
            431,
            436,
            427,
            435,
            430,
            432,
            429,
            433
        ]
    ],
    [
        'is_visible' => true,
        'official_only' => true,
        'limiteds_only' => false,
        'title' => 'Recently Released',
        'name_like' => null,
        'item_types' => $recentTypes,
        'item_ids' => []
    ],
    [
        'is_visible' => true,
        'official_only' => true,
        'limiteds_only' => false,
        'title' => 'Trendy Hair Styles',
        'name_like' => 'hair',
        'item_types' => ['hat'],
        'item_ids' => []
    ],
    [
        'is_visible' => true,
        'official_only' => false,
        'limiteds_only' => true,
        'title' => 'Collectible Items',
        'name_like' => null,
        'item_types' => $recentTypes,
        'item_ids' => []
    ],
    [
        'is_visible' => true,
        'official_only' => false,
        'limiteds_only' => false,
        'title' => 'Featured User Creations',
        'name_like' => null,
        'item_types' => [],
        'item_ids' => [
            444,
            425,
            100,
            176,
            73,
            290,
            74,
            421,
            358,
            272,
            269,
            257,
            226,
            253,
            12,
            14,
            16,
            11,
            276,
            232,
            455
        ]
    ]
];
