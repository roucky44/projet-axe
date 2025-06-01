<?php
require_once("lib/session.php");
require_once("lib/connexion.php");

header('Content-Type: application/json');

if (!isset($_SESSION['iduser'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['iduser'];

// temps booster
$stmt = $pdo->prepare("SELECT last_booster FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$last = $stmt->fetchColumn();

if ($last && strtotime($last) > strtotime('-24 hours')) {
    echo "Attend les 24 heures avant d'ouvrir à nouveau.";
    exit;
}

// ca fetch 5 cartes random depuis l'api
$apiUrl = "https://the-one-api.dev/v2/character";
$apiToken = "KtFGls3XWxo_air2CXKc";
$ch = curl_init($apiUrl); //
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $apiToken"]);
$response = curl_exec($ch);
curl_close($ch);

// vérifie la réponse de l'API
$data = json_decode($response, true);
if (!$data || !isset($data['docs'])) {
    echo json_encode(['success' => false, 'message' => 'API error']);
    exit;
}

// prend des cartes aléatoires
$allCards = $data['docs'];
shuffle($allCards);
$cards = array_slice($allCards, 0, 5);

// sauvegarde les cartes dans la base de données
foreach ($cards as $card) {
    $stmt = $pdo->prepare("INSERT INTO user_cards (user_id, card_id, card_name, card_image) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $user_id,
        $card['_id'],
        $card['name'],
        isset($card['image']) ? $card['image'] : null
    ]);
}

// update le dernier booster ouvert
$stmt = $pdo->prepare("UPDATE users SET last_booster = NOW() WHERE id = ?");
$stmt->execute([$user_id]);

echo json_encode(['success' => true, 'cards' => $cards]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button id="open-booster-btn">Ouvrir un booster quotidien</button>
<div id="booster-result"></div>
</body>
</html>