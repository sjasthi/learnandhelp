<?php
$api_key = 'aba4023a2e8289976cca95235b0d1557'; // Your FavQs API key
$keywords = isset($_GET['keywords']) ? $_GET['keywords'] : 'books,libraries,joy,reading';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://favqs.com/api/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $api_key"));

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$quote = isset($data['quotes'][0]['quote']) ? $data['quotes'][0]['quote'] : 'No quote found.';

echo $quote;
?>
