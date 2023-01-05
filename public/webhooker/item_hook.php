<?php
header('Content-Type: application/json');


//=======================================================================================================
// Create new webhook in your Discord channel settings and copy&paste URL
//=======================================================================================================
error_reporting(E_ALL);
ini_set("display_errors", 1);

$webhookurl = "https://webhook.site/3d03e859-b564-4f42-baaa-f1527fa3e6f4";

$iname = $_GET["name"];

$idesc = $_GET["desc"]; 

$iprice = $_GET["price"];

$ilink = $_GET["link"];

//=======================================================================================================
// Compose message. You can use Markdown
// Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
//========================================================================================================

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([
    // Message
    "content" => "Theres a new item!",
    
    // Username
    "username" => "{{ config('site.name') }} Item Notifier",

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" => $iname,

            // Embed Type
            "type" => "rich",

            // Embed Description
            "description" => "$idesc '-' $iprice Bits",

            // URL of title link
            "url" => $ilink,

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec( "3366ff" ),

            // Footer
            "footer" => [
                "text" => "&copy; sitename",
                "icon_url" => "icon"
            ],

            // Image to send
            "image" => [
                "url" => "img"
            ],

            // Thumbnail
            //"thumbnail" => [
            //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
            //],

            // Author
            "author" => [
                "name" => "sitename item Notifier",
                "url" => "sitename.com"
            ],

            // Additional Fields array
            "fields" => [
                // Field 1
                [
                    "name" => "Field #1 Name",
                    "value" => "Field #1 Value",
                    "inline" => false
                ],
                // Field 2
                [
                    "name" => "Field #2 Name",
                    "value" => "Field #2 Value",
                    "inline" => true
                ]
                // Etc..
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
# echo $response;
curl_close( $ch );

?>

<h5>
  Webhook Created
</h5>

<h3>
  Webhook Dump:
</h3>
<p>
  <?php
 echo json_encode([
    // Message
    "content" => "Theres a new item!",
    
    // Username
    "username" => "{{ config('site.name') }} Item Notifier",

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" => $iname,

            // Embed Type
            "type" => "rich",

            // Embed Description
            "description" => "$idesc '-' $iprice Bits",

            // URL of title link
            "url" => $ilink,

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec( "3366ff" ),

            // Footer
            "footer" => [
                "text" => "&copy; sitename",
                "icon_url" => "icon"
            ],

            // Image to send
            "image" => [
                "url" => "img"
            ],

            // Thumbnail
            //"thumbnail" => [
            //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
            //],

            // Author
            "author" => [
                "name" => "sitename item Notifier",
                "url" => "sitename.com"
            ],

            // Additional Fields array
            "fields" => [
                // Field 1
                [
                    "name" => "Field #1 Name",
                    "value" => "Field #1 Value",
                    "inline" => false
                ],
                // Field 2
                [
                    "name" => "Field #2 Name",
                    "value" => "Field #2 Value",
                    "inline" => true
                ]
                // Etc..
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
  ?>
</p>