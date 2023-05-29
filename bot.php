<?php 

    $bot_url = "https://api.telegram.org/bot" . "6262152324:AAHNisSfg9G9XH_gXwIWgB_m6np9Q-eoQmM";
    $update = file_get_contents("php://input");
    $update_array = json_decode($update, true); 
 
    if( isset($update_array["message"]) ) {
        $text    = $update_array["message"]["text"];
        $chat_id = $update_array["message"]["chat"]["id"];
    }

    $key1 = 'کانال ما';
    $key2 = 'ارتباط با ادمین';

// menu
    $reply_keyboard = [
                        [$key1] ,
                        [$key2]
                      ];
    $reply_kb_options = [
                            'keyboard'          => $reply_keyboard ,
                            'resize_keyboard'   => true ,
                            'one_time_keyboard' => false ,
                        ];

    function show_menu(){
        $json_kb = json_encode($GLOBALS['reply_kb_options']);
        $reply = "گزینه مورد نظر را انتخاب کنید :";
        $url =  $GLOBALS['bot_url'] . "/sendMessage";
        $post_prm = [ 'chat_id' => $GLOBALS['chat_id'] , 'text' => $reply , 'reply_markup' => $json_kb ];
        send_reply($url , $post_prm);
    }
    function chanell(){
        $reply = "@blockchainology | https://blokchainology.com" ;
        $url = $GLOBALS['bot_url'] . "/sendMessage";
        $post_prm = [
                'chat_id' => $GLOBALS['chat_id'] , 
                'text' => $reply 
            ];
        send_reply($url , $post_prm);
    }

    function message(){
        $reply = "پیام خود را بفرستید" ;
        $url = $GLOBALS['bot_url'] . "/sendMessage";
        $post_prm = [
            'chat_id' => $GLOBALS['chat_id'] ,
            'text' => $reply
        ];
        send_reply($url , $post_prm);
    }

    function ok(){
        $reply = "پیام شما به ادمین ارسال شد" ;
        $url = $GLOBALS['bot_url'] . "/sendMessage";
        $post_prm = [
            'chat_id' => $GLOBALS['chat_id'] ,
            'text' => $reply
        ];
        send_reply($url , $post_prm);
    }

    
    switch($text){
        case $key1 : chanell(); break;
        case $key2 : message(); break;
        case $text : ok(); break;
    }

    function send_reply($url, $post_prm) {
        $cu = curl_init();
        curl_setopt($cu, CURLOPT_URL, $url);
        curl_setopt($cu, CURLOPT_POSTFIELDS, $post_prm);
        curl_setopt($cu, CURLOPT_RETURNTRANSFER, true); 
        $result = curl_exec($cu);
        curl_close($cu);
        return $result;
    }
 
?>
