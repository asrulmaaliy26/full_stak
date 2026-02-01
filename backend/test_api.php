<?php

$baseUrl = 'http://localhost:8000';

// 1. Get News List to find an ID
$json = file_get_contents($baseUrl . '/news');
$data = json_decode($json, true);

if (empty($data['data'])) {
    echo "No news found to test.\n";
    exit;
}

$newsItem = $data['data'][0];
$id = $newsItem['id'];
$initialViews = $newsItem['views'];

echo "Testing News ID: $id\n";
echo "Initial Views: $initialViews\n";

// 2. POST to increment views
$url = $baseUrl . "/news/$id/views";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response Code: $httpCode\n";
echo "Response Body: $response\n";

// 3. Verify increment
$json2 = file_get_contents($baseUrl . "/news/$id");
$data2 = json_decode($json2, true);
$newViews = $data2['data']['views'];

echo "New Views: $newViews\n";

if ($newViews > $initialViews) {
    echo "SUCCESS: Views incremented.\n";
} else {
    echo "FAILURE: Views did not increment.\n";
}
