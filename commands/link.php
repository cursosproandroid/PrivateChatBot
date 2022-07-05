# Cursos Pro Android by Skueletor ©️ 2022
<?php

$Bot->command("/\/link/", function ($Update, $Match) use ($Bot, $db, $tur, $LANG) {
    if (empty($Update["message"]["reply_to_message"]["message_id"])) {
        $Bot->sendMessage(["chat_id" => $Update["message"]["chat"]["id"], "parse_mode" => "markdown", "text" => $LANG["ERROR_REPLY"]]);   
    }
    $MId = $Update["message"]["reply_to_message"]["message_id"];
    if ($tur == 0) {
        $fid = $db->select('fid, fmid, fname, fusername')
        ->from('msg.json')
        ->where(['mid' => $MId])
        ->get()[0];
    } else {
        $query = $db->prepare("SELECT fid, fmid, fname, fusername FROM msg WHERE mid = " . $MId);
        $query->execute();
        $fid = $query->fetch();
    }
    if (empty($fid)) {
        $Bot->sendMessage(["chat_id" => $Update["message"]["chat"]["id"], "reply_to_message_id" => $Update["message"]["message_id"], "parse_mode" => "markdown", "text" => $LANG["ERROR_NOTFOUND"]]); 
        return;
    }
    
        
    $Bot->sendMessage(["chat_id" => $Update["message"]["chat"]["id"], "parse_mode" => "markdown", "text" => "*Aquí está el usuario que está buscando:* [" . $fid["fname"] . "](tg://user?id=" . $fid["fid"] . ")\n*Nombre de usuario:* @" . $fid["fusername"]]);
});
