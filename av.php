<?php
$json = json_decode( wp_remote_retrieve_body( wp_remote_get( "https://api.kaaass.net/biliapi/video/info?id=$av" ) ), true);
if ($json["status"] != "OK") {
    echo json_encode( array(
        "code" => -1,
        "msg" => "获取失败"
    ) );
    die;
}
echo json_encode( array(
    "code" => 200,
    "type" => $json["data"]["typename"],
    "name" => $json["data"]["title"],
    "description" => $json["data"]["description"],
    "uploader" => $json["data"]["author"],
    "thumbnail" => $json["data"]["pic"]
) );