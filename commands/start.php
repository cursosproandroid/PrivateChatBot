# Cursos Pro Android by Skueletor ©️ 2022
<?php

$Bot->command("/\/start/", function ($Update, $Match) use ($Bot, $LANG) {
    $Bot->sendMessage(["chat_id" => $Update["message"]["chat"]["id"], "parse_mode" => "markdown", "text" => $LANG["START"]]);
});
