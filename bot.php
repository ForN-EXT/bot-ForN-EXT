<?php
// https://github.com/ayhan-dev/bot_telegram_php


error_reporting(0);
include "telegram.php";
$api = new Telegram("6179391015");
$sql = new Database('ayhan48_ayhan', 'go[j45@6ou}-lud@1u5o{', 'ayhan48_ayhan');

if (!is_file('URL.log')) {
    $api -> setHook('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    file_put_contents('URL.log', "OK");
}

$sql -> exe_query('CREATE TABLE IF NOT EXISTS `user`(
        from_id VARCHAR(255) NOT NULL,
    key_net VARCHAR(255) NOT NULL,
    key_git VARCHAR(255) NOT NULL,
    key_you VARCHAR(255) NOT NULL,
    coin_you VARCHAR(255) NOT NULL,
    coin_git VARCHAR(255) NOT NULL,
    step VARCHAR(255) NOT NULL,
    chat VARCHAR(255) NOT NULL
)');
$sql -> exe_query('CREATE TABLE IF NOT EXISTS data(
        id VARCHAR(255) NOT NULL,
    IP VARCHAR(255) NOT NULL,
    hash VARCHAR(255) NOT NULL,
    data TEXT,
    tad VARCHAR(255) NOT NULL,
    coin VARCHAR(255) NOT NULL,
    sys VARCHAR(255) NOT NULL,
    id_tg VARCHAR(255) NOT NULL
)');
$sql -> exe_query('CREATE TABLE IF NOT EXISTS list(
        IP VARCHAR(255) NOT NULL,
    data TEXT
)');


function KEY_HASH($code) {
    $characters = 'QWERTYUIOPASDFGHJKLMNBVCXZ1234567890';
    $key = '';
    for ($i = 0; $i < $code; $i++) {
        $key.= $characters[rand(0, strlen($characters) - 1)];
    }
    return "session:".$key;
}


function data_pro($chat_id) {
    $userProfile = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY. "/getuserprofilephotos?user_id=".$chat_id), true);
    $isOk = $userProfile["ok"];
    $photos = $userProfile["result"]["photos"];
    if ($isOk && !empty($photos)) {
        $fileId = $photos[0][0]["file_id"];
        return $fileId;
    } else {
        return "AgACAgQAAxkBAAEQ4J1ljwQLVQ2AzpmTHvtOryu3WeiF3AAC5r0xG7xGeFC16LEihFFsbwEAAwIAA3MAAzQE";
    }
}

function chak_admin($id, $from) {
    $url = "https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$id&user_id=".$from;
    $admin_curl = json_decode(file_get_contents($url), true);
    return $admin_curl['result']['status'];
}

$homes = [
    "keyboard" => [
        [["text" => "Request Chat", "request_chat" => ["request_id" => 69420]]],
        [["text" => "Request user", "request_users" => ["request_id" => 694201]]]],
    "resize_keyboard" => true
];

$home = json_encode(['keyboard'=> [
    [['text'=> "- 𝘼𝙋𝙄 𝙆𝙀𝙔 -"]],
    [['text'=> "- 𝙎𝙀𝙏𝙏𝙄𝙉𝙂 -"]]
], 'resize_keyboard'=> true
]);

$key_api = json_encode([
    'inline_keyboard' => [
        [['text' => "- Change KEY -", 'callback_data' => "change"]],
        [['text' => "- change drive -", 'callback_data' => "key-drive"],
        ['text'  => "- Upload Drive -", 'callback_data' => "Upload"]],
        [['text' => "- SET GP -", 'callback_data' => "set"]]
    ]
]);

# ===========================================================================
if (isset($message)) {
    $message = $api -> message();
    $text = $api -> Text();
    $from_id = $api -> message()['from']['id'];
    $chat_id = $api -> message()['chat']['id'];
    $chat_type = $api -> message()['chat']['type'];
    $message_id = $api -> message()['message_id'];
    $reply = $api -> message()['reply_to_message'];
    $id = $reply['from']['id'];

    $user = $sql -> exe_query("SELECT * FROM `user` WHERE `from_id` = '$from_id' LIMIT 1") -> fetch_assoc();
    $admin_curl = chak_admin($chat_id, $from_id);


    if ($message['chat_shared']) {
        $A_id = $message['chat_shared']['chat_id'];
        $sql -> exe_query("UPDATE `user` SET `chat` = '$A_id' WHERE `from_id` = $from_id LIMIT 1");
        $messageContent = "Group $A_id was set up / [Admin in the bot group](https://t.me/ForNRxt_bot?startchannel=None&admin=ban_users+edit_messages+add_admins+change_info+invite_users+pin_messages+manage_call+manage_chat+manage_video_chats+promote_members+post_messages+delete_messages)";
        $api -> sendMessage(array(
            'chat_id'       => $from_id,
            'text'          => $messageContent,
            'reply_markup'  => $home,
            'disable_web_page_preview' => true,
            'parse_mode'    => 'MarkDown'));
    }



    if ($text == '/start' && $chat_type == "private") {
        $file = data_pro($from_id);
        $cap = 'Hi. Sir :) \n\n - Welcome to Robot Network - ForNRxt. \n 🌟 @ForNRxt - @ForNRxt_bot';
        $api -> sendPhoto(array(
            'chat_id' => $from_id,
            'photo'   => $file,
            'caption' => $cap,
            'reply_markup'  => $home
        ));
        if ($user['from_id'] != true) {
            $sql -> exe_query("INSERT INTO `user`(`from_id`,`key_net`, `key_git`, `key_you`, `coin_you`, `coin_git`, `step`,`chat`) VALUES ('$from_id', 'none', 'none', 'none', '0', '0', 'none', 'none')");
        } else {
            $sql -> exe_query("UPDATE `user` SET `step` = '$A_id' WHERE `from_id` = $from_id LIMIT 1");
        }
        exit();
    }


    if ($text == "- 𝘼𝙋𝙄 𝙆𝙀𝙔 -") {
        if ($user['key_git'] == "none") {
            $git = KEY_HASH("20");
            $you = KEY_HASH("22");
            $net = KEY_HASH("50");

            // addd database key(net , ydl , git)
            // data false
        } else {
            // data true
        }
    }


}





