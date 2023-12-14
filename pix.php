<?php
require __DIR__ . '/lib/vendor/autoload.php';
require "bot.php";

$token_mp = $config['token']['mercado-pago'];
$browser = new React\Http\Browser();
$data = json_decode(file_get_contents("recargas.json"), true)

echo "Iniciado..." . PHP_EOL . PHP_EOL;

while (true) {
    $file = __DIR__ . "/recargas.json";
    $file = file_get_contents($file);
    $recargas = json_decode($file, 1);

    if ($recargas !== NULL) {
        foreach ($recargas as $recarga => $data) {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://pladixmirror.com/mercadoPago/checkPix.php?accessToken=" . $token_mp . "&payment_id=" . $data["id"],
                CURLOPT_RETURNTRANSFER => true
            ]);
            $exec = curl_exec($curl);
            curl_close($curl);
            $status = $data["status"];

            if ($exec == "Pago" and $status == 'pending' or $status == 'approved') {
                $status = "approved";
            } else if ($exec !== "Pendente" and $exec !== "Pago") {
                $status = "expired";
            } else {
                $status = "pending";
            }

            if ($status != $data["status"]) {
                $recargas[$recarga]["status"] = $status;
                $json = json_encode($recargas, JSON_PRETTY_PRINT);
                $save = file_put_contents(__DIR__  . '/recargas.json', $json);
                $token = $config['token']['bot'];

                if ($save and $status == "approved") { 
                    // Sucesso no pagamento
                    $valor = "R$".number_format($data["amount"], 2, ',', '.');
                    $text = "*💸 Recarga realizada*\n\n*- Valor:* `$valor`\n\n*Te desejamos ótimas compras!*";

                    $api_point = "https://api.telegram.org/bot";
                    $parameter = "/editMessageText?chat_id=";
                    $parameter2 = "&message_id=".$data["message_id"];
                    $parameter3 = "&reply_to_message_id=".$data["user_message_id"];
                    $text = "&text=".urlencode($text);
                    $mode = "&parse_mode=Markdown";

                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => $api_point.$token.$parameter.$data["user"].$parameter2.$parameter3.$text.$mode,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_FOLLOWLOCATION => 1,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0
                    ]);
                    curl_exec($curl);
                    curl_close($curl);

                    $msg = "Pagamento Recebido - R$".number_format($data["amount"], 2, ',', '.')." - ". $id;

                    bot("sendChatAction", array(
                        "chat_id" => $chat_id,
                        "action" => "typing"
                    ));

                    bot("sendMessage", array(
                        "chat_id" => $config['dono'],
                        "reply_to_message_id" => $message_id,
                        "text" => $msg,
                        "parse_mode" => "Markdown"
                    ));

                    // Add saldo 
                    $dir = DIR . '/users/';
                    $file_dir = $data['user'] . '.json';
                    $file = json_decode(file_get_contents($dir.$filedir), true);
                    $user["saldo"] += $data["amount"];
                    $user = json_encode($user, JSON_PRETTY_PRINT);
                    file_put_contents($dir.$file_dir, $user);
                }
            }
        }
    }
    sleep(5);
}