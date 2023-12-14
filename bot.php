<?php
require_once "api.php";

//definições

$usuarios = 'user/' . $id . ".json";

$conteudo = [
"id" => $id,
"chat_id" => $chat_id,
"creditos" => 0,
"saldo" => 0
];

$duser = json_encode($conteudo, JSON_PRETTY_PRINT);

$dusers = json_decode(file_get_contents($usuarios), true);


//FUNÇÕES DO BOT




function voltar($dados) {
    $chat_id = $dados["chat_id"];
    $message_id = $dados["query_message_id"];
    $txt = "Parece que você não tem plano para consultas ativo, que tal fazer um? 😉\n";

    $button[] = ['text' => "🗑️ Apagar", 'callback_data' => "delete_message"];
    $button[] = ['text' => "📄 | Modulos", 'callback_data' => "consultas2"];
    $button[] = ['text' => "👤 Entre em Contato", 'url' => "https://t.me/teddykatchau"];
    $button[] = ['text' => "☄️ Ver Planos", 'callback_data' => "exibir_planos"];
    $menu['inline_keyboard'] = array_chunk($button, 2);

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu
    ));
}

function exibir_planos($dados) {
    $chat_id = $dados["chat_id"];
    $message_id = $dados["query_message_id"];
    
    $txt = "☄️ | *Planos*

O BOT TEM:
✅ CONSULTA DE CPF  | RECEITA 
✅ Consulta De CPF1 | COMPLETA
✅ Consulta De CPF2 | E-SUS
✅ Consulta De TELEFONE1
✅ Consulta De RG 
✅ Consulta De TELEFONE2
✅ Consulta De TELEFONE3
✅ Consulta De NOME
✅ Consulta De SCORE | ATUALIZADO
✅ Consulta De BENEFICIOS
✅ Consulta De CNPJ
✅ Consulta De PLACA
✅ Consulta De CEP
✅ Consulta De IP
✅ Consulta De SITE
⚙️ FERRAMENTAS ⚙️
_CHK GG_ CHECKER
━━━━━━━━━━━━━━━━━━━━━
🛒 PLANOS  INDIVIDUAIS:

🔘 DIARIO = R$10,00
🔘 1 SEMANA = R$20,00
🔘 15 DIAS = R$29,00
🔘 1 MÊS = R$40,00
🔘 BIMESTRAL = R$60,00
🔘 ANUAL = R$450,00

━━━━━━━━━━━━━━━━━━━━━

Para mais informações, entre em contato com o suporte.";

    $button[] = ['text' => "🔙", 'callback_data' => "voltar"];
    $menu['inline_keyboard'] = array_chunk($button, 1);

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

function comandos($dados) {
    $chat_id = $dados["chat_id"];
    $message_id = $dados["query_message_id"];

    $txt = "*☆ | COMANDOS BOT @teddykatchau | ☆*
*🔄 Bases de dados atualizada, servidores otimizados!*

*● | PARÂMETROS | ●*
🟢 *STATUS 》* ONLINE
🟡 *STATUS 》* MANUTENÇÃO
🔴 *STATUS 》* OFFLINE

*• | MÓDULOS | •*
🟢 SCORE: `/score 00000000000`
🟢 CPF1: `/cpf1 00000000000`
🟢 CPF2: `/cpf2 00000000000`
🟢 CPF3: `/cpf3 00000000000`
🔴 CPF4: `/cpf4 00000000000`

🔴 TEL1: `/tel1 81971185449`
🔴 TEL2: `/tel2 81971185449`
🔴 TEL3: `/tel3 81971185449`
🟢 NOME: `/nome Jamilly Cambui`
🔴 PARENTES: `/parentes 00000000000`
🔴 VIZINHOS: `/vizinhos 00000000000`
🔴 BIN: `/bin 000000`
🔴 CEP: `/cep 54520015`

🔴 IP:
🟢 PLACA1:
🔴 EMAIL: `/email joao@hotmail.com`
🟢 CNPJ: `/cnpj 0000000000000`
🔴 RG: `/rg 0000000`

🔴 PLACA2:
🔴 SITE:

*● | CHECKERS | ●*

🟡 CHK: `/chk`
🟢 CHK SIPNI: `/chksip email:senha`

⚡️ *Use os comandos em Grupos e no Privado do Robô*
👤 *Suporte: @teddykatchau*
━━━━━━━━━━━━━━━━━━━━━";

    $button[] = ['text' => "🔙", "callback_data" => "voltar"];

    $menu['inline_keyboard'] = array_chunk($button, 1);

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

function planos($dados) {
    $chat_id = $dados["chat_id"];
    $message_id = $dados["query_message_id"];

    $txt = "🧸 | _ PLANOS  INDIVIDUAIS:

🔘 DIARIO = R$10,00
🔘 1 SEMANA = R$20,00
🔘 15 DIAS = R$29,00
🔘 1 MÊS = R$40,00
🔘 BIMESTRAL = R$60,00
🔘 ANUAL = R$450,00
_";

    $button[] = ['text' => "🔙", "callback_data" => "start"];

    $menu['inline_keyboard'] = array_chunk($button, 2);

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

function start($dados) {
    $chat_id = $dados["chat_id"];
    $id = $dados["id"];
    $message_id = $dados["query_message_id"];
    $nome = $dados["nome"];

    $txt = "🧸 | *Bem Vindo! {$nome}*

ぴ *CHAT_ID : {$chat_id}*
ぴ *USER_ID : {$id}*
[ ](https://i.ibb.co/2YhfdmV/1688958230412.png)
_Navegue pelo meu menu abaixo:_";

    $button[] = ['text' => "📄 | Comandos", 'callback_data' => "consultas"];
$button[] = ['text' => "💰 | Planos", 'callback_data' => "tabela"];
$button[] = ['text' => "</> Dev", 'url' => "t.me/teddykatchau"];
$button[] = ['text' => "⚡ | APIS", 'url' => "t.me/teddykatchau"];


$menu['inline_keyboard'][] = [$button[0]];
$menu['inline_keyboard'][] = [$button[1], $button[2]];
$menu['inline_keyboard'][] = [$button[3]];

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

// Nome do arquivo a ser criado

if ($callback_query) {
    $query_data = $callback_query['data'];
    $query_message_id = $callback_query['message']['message_id'];
    $query_chat_id = $callback_query['message']['chat']['id'];
    $query_nome = $callback_query['message']['chat']['first_name'];
    $query_id = $callback_query['id'];

    if ($query_data == "exibir_planos") {
        exibir_planos($query_chat_id, $query_message_id);
    } elseif ($query_data == "voltar") {
        voltar($query_chat_id, $query_message_id);
    }
}

// COMANDOS COM PREFIXO

$comando = explode(' ', $texto)[0];

switch ($comando) {

case "/menu":
case "/start":

// CRIA UM ARQUIVO COM OS DADOS DOS USUÁRIOS
if (!file_exists($usuarios)) {

file_put_contents($usuarios, $duser);
$msg = "✅ | Arquivo $id Criado com sucesso";
echo $msg;

} else {
$msg = "⚠️ | `$id` Já existe";
echo $msg;
}

$rs = "R$";

$saldo = $dusers['saldo'];
$creditos = $dusers['creditos'];

 $txt = "
🧸 | *Bem Vindo! {$nome}*

🆔 | *CHAT_ID*: `{$chat_id}`
🆔 | *USER_ID*: `{$id}`
🪙 | *SALDO*: `$saldo $rs`
💎 | *CREDITOS* 💎: `$creditos`

_Navegue pelo meu menu abaixo:_";
    // BOTÕES 

$button[] = ['text' => "📄 | Comandos", 'callback_data' => "comandos"];
$button[] = ['text' => "💰 | Planos", 'callback_data' => "tabela"];
$button[] = ['text' => "</> Dev", 'url' => "t.me/teddykatchau"];

$menu['inline_keyboard'][] = [$button[0]];
$menu['inline_keyboard'][] = [$button[1], $button[2]];
 

         bot("sendChatAction", array(
        "chat_id" => $chat_id,
        "action" => "typing"
        ));

        bot("sendMessage", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));

break;

        case "/pix":
            
            $rest = substr($texto, 5);
$configjson = "config.json";
$config = json_decode(file_get_contents($configjson), true);

            $valor_min = $config['recargas']['min'];
            $valor_min_t = "R$" . number_format($valor_min, 2, ",", ".");

            $valor_max_t = "R$" . number_format($valor_max, 2, ",", ".");
            $valor_max = $config['recargas']['max'];

            $token_mp = $config['token']['mercado-pago'];


  if ($texto == null) {
$txt = "*💠 ADIÇÃO DE SALDO VIA PIX

PARA CRIAR UMA TRANSAÇÃO NO BOT USE O COMANDO /pix

EXEMPLO: /pix {$valor_min}

✅ SEU SALDO SERÁ CREDITADO APÓS 1 A 5 MINUTOS APÓS O PAGAMENTO!

⚠️ CASO O VALOR DO PAGAMENTO NÃO TENHA SIDO CREDITADO NA STORE APÓS ALGUNS MINUTOS CHAME O SUPORTE DO BOT!*";

bot("sendChatAction", array(
"chat_id" => $chat_id,
"action" => "typing"
));

bot("sendMessage", array(
"chat_id" => $chat_id,
"text" => $txt,
"parse_mode" => "Markdown",
"reply_to_message_id" => $message_id
                    ));
            } elseif (!is_numeric($rest)) {
                // sem valor {ERRO}
                $txt = "*⚠️ Insira um valor válido!*";
bot("sendChatAction", array(
"chat_id" => $chat_id,
"action" => "typing"
));

bot("sendMessage", array(
"chat_id" => $chat_id,
"text" => $txt,
"parse_mode" => "Markdown",
"reply_to_message_id" => $message_id
                    ));
            } elseif ($rest > $valor_max) {
                // {ERRO}
                $txt = "*⚠️ O Máximo para uma transação no bot é de {$valor_max_t}!*";
                
bot("sendChatAction", array(
"chat_id" => $chat_id,
"action" => "typing"
));

bot("sendMessage", array(
"chat_id" => $chat_id,
"text" => $txt,
"parse_mode" => "Markdown",
"reply_to_message_id" => $message_id
                    ));
                    
            } elseif ($rest < $valor_min) {
                // {ERRO}
                $txt = "*⚠️ O Mínimo para uma transação no bot é de {$valor_min_t}!*";
                
bot("sendChatAction", array(
"chat_id" => $chat_id,
"action" => "typing"
));

bot("sendMessage", array(
"chat_id" => $chat_id,
"text" => $txt,
"parse_mode" => "Markdown",
"reply_to_message_id" => $message_id
                    ));
            } else {
                // {SUCESSO}
                $rest_t = "R$" . number_format($rest, 2, ",", ".");

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL =>
                        "https://pladixmirror.com/mercadoPago/createPix.php?accessToken=" .
                        $token_mp .
                        "&value=" .
                        $rest .
                        "&time=10",
                    CURLOPT_RETURNTRANSFER => true,
                ]);

                $exec = curl_exec($curl);
                $exec = json_decode($exec, true);
                curl_close($curl);

                $qr = $exec["qr_code"];
                $id_pix = $exec["id_pix"];
                $tempo = $exec["time"];

                $txt = "*✅ Transação foi criada*
  
* 🏷️ Pix Copia e Cola:* `$qr`

💰 *Valor:* `{$rest_t}`

⏰ *A TRANSAÇÃO EXPIRA EM 10 MINUTOS!*

⚠️ *CASO O PAGAMENTO SEJA FEITO E NÃO SEJA CREDITADO DENTRO DE 5 MINUTOS NA STORE CHAMAR O SUPORTE!*";

                $api_point = "https://api.telegram.org/bot";
                $parameter = "/sendMessage?chat_id=";
                $parameter2 = "&reply_to_message_id=" . $message_id;
                $text = "&text=" . urlencode($txt);
                $mode = "&parse_mode=Markdown";
                $token = $config['token']['bot'];

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL =>
                        $api_point .
                        $token .
                        $parameter .
                        $id .
                        $text .
                        $mode .
                        $parameter2,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                ]);
                $data = json_decode(curl_exec($curl), 1);
                $result = $data["result"];
                $msg_id = $result["message_id"];
                curl_close($curl);

                $pagamento = json_decode(
                    file_get_contents(__DIR__ . "/recargas.json"),
                    1
                );

                $pagamento[] = [
                    "id" => $id_pix,
                    "amount" => $rest,
                    "user" => $id,
                    "message_id" => $msg_id,
                    "user_message_id" => $message_id,
                    "status" => "pending",
                ];

                file_put_contents(
                    __DIR__ . "/recargas.json",
                    json_encode($pagamento, JSON_PRETTY_PRINT)
                );
            }
            break;


default:
}

if ($callback_query) {
    $query_data = $callback_query['data'];
    $query_message_id = $callback_query['message']['message_id'];
    $query_chat_id = $callback_query['message']['chat']['id'];
    $query_nome = $callback_query['message']['chat']['first_name'];
    $query_usuario = $callback_query['message']['chat']['username'];
    $query_id = $callback_query['id'];

    $callback = explode("|", $query_data)[0];
    $optional = isset(explode("|", $query_data)[1]) ? explode("|", $query_data)[1] : null;

    if ($callback === "delete_message") {
        bot("deleteMessage", array(
            "chat_id" => $query_chat_id,
            "message_id" => $query_message_id
        ));
    } elseif (function_exists($callback)) {
        $dados = array(
            "chat_id" => $query_chat_id,
            "id" => $query_chat_id,
            "nome" => $query_nome,
            "usuario" => $query_usuario,
            "message_id" => $query_message_id,
            "query_message_id" => $query_message_id,
            "query_nome" => $query_nome,
            "query_id" => $query_id,
            "optional" => $optional,
            "query_usuario" => $query_usuario
        );
        $callback($dados);
    } else {
        bot("answerCallbackQuery", array(
            "callback_query_id" => $query_id,
            "text" => "⚠️ | Função em desenvolvimento!",
            "show_alert" => false,
            "cache_time" => 10
        ));
    }
}

?>