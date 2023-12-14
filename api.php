/*
CRIA UM ARQUIVO CHAMADO "dono.txt" => PRA PD ADD OS IDS DPS CRIA O "ids.txt" => NÃO PRECISO NEM EXPLICAR 🥸
*/

$authorized_chats = array();

$file = fopen('ids.txt', 'r');
if ($file) {
    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        if (!empty($line)) {
            $authorized_chats[] = $line;
        }
    }
    fclose($file);
}

$input = file_get_contents('php://input');

$update = json_decode($input, true);

$message = isset($update['message']) ? $update['message'] : null;
$callback_query = isset($update['callback_query']) ? $update['callback_query'] : null;

$chat_id = isset($message['chat']['id']) ? $message['chat']['id'] : null;
$message_id = isset($message['message_id']) ? $message['message_id'] : null;
$tipo = isset($message['chat']['type']) ? $message['chat']['type'] : null;
$texto = isset($message['text']) ? $message['text'] : null;
$id = isset($message['from']['id']) ? $message['from']['id'] : null;
$isbot = isset($message['from']['is_bot']) ? $message['from']['is_bot'] : null;

$query_chat_id = isset($callback_query['message']['chat']['id']) ? $callback_query['message']['chat']['id'] : null;
$query_message_id = isset($callback_query['message']['message_id']) ? $callback_query['message']['message_id'] : null;
$query_usuario = isset($callback_query['message']['chat']['username']) ? $callback_query['message']['chat']['username'] : null;
$query_nome = isset($callback_query['message']['chat']['first_name']) ? $callback_query['message']['chat']['first_name'] : null;
$query_id = isset($callback_query['id']) ? $callback_query['id'] : null;
$query_data = isset($callback_query['data']) ? $callback_query['data'] : null;

function bot($method, $parameters) {
    $token = "6918944778:AAH9uO-FvkTzSMhK8JC_teidZtIkvvCEQgQ";
    $url = "https://api.telegram.org/bot$token/$method";
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($parameters),
        ),
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}