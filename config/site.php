<?php
/**
 * MIT License
 *
 * Copyright (c) 2022 FoxxoSnoot, Aeo
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

return [
    'name' => env('APP_NAME', 'BrickPlanet'),
    'logo' => '/img/bp-logo.png',
    'icon' => '/img/bp-icon.png',
     // payment
	 
    'paypal_email' => 'aeodevelopments@gmail.com',
    'paypal_sandbox' => false,

    'route_domains' => [
        'admin_site' => 'ap.avatoria.com',
        'main_site' => 'www.avatoria.com',
        'jobs_site' => 'jobs.avatoria.com'
    ],

    'storage_url' => 'https://cdn.avatoria.com',
    'referral_url' => 'https://refer.avatoria.com',

    'official_thumbnail' => '/img/BCIcon.png', // Headshot for the system account (ID 1)

    'updates_forum_topic_id' => 1,

    'username_change_price' => 250,
    'group_creation_price' => 50,

    'flood_time' => 15,
    'dash_color' => '#0A69BB',
    'secondary_dash_color' => '#fff',
  
    'daily_currency' => 15,
    'daily_currency_membership' => 30,
    'group_limit' => 10,
    'group_limit_membership' => 25,

    'donator_item_id' => 0,
    'membership_item_id' => 0,
    'email_verification_item_id' => 0,
    'fake_admin_item_id' => 0, // Granted to those who visit "/admin", leave as 0 if none

    'membership_name' => 'Gold',
    'membership_color' => '#000',
    'membership_bg_color' => '#ffc113',

    'renderer' => [
        'url' => 'https://python.avatoria.com',
        'key' => 'key',
        'default_filename' => 'default', // Default thumbnail filename
        'previews_enabled' => false
    ],

    'socials' => [
        'discord' => '',
        'twitter' => ''
    ],

    'admin_panel_code' => '', // A second layer of protection to the administration panel required to login, leave empty if you do not want one
    'maintenance_passwords' => [
        'nv343v8043vbu0'
    ],

    'catalog_recent_item_types' => ['head','hat', 'face', 'gadget'],
    'catalog_item_types' => ['hat', 'face', 'gadget', 'shirt', 'pants'],
    'catalog_3d_view_types' => ['hat', 'gadget'],
    'inventory_item_types' => ['hat', 'face', 'gadget', 'shirt', 'pants'],
    'character_editor_item_types' => ['hat', 'face', 'gadget', 'shirt', 'pants'],
    'item_thumbnails_with_padding' => ['hat', 'face', 'gadget', 'shirt', 'pants']
];
