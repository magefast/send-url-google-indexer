<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'google-api-php-client-main/vendor/autoload.php';

$client = new Google_Client();

const LIMIT_URLS = 200;

// service_account_file.json is the private key that you created for your service account.
$client->setAuthConfig('service_account_file.json');
$client->addScope('https://www.googleapis.com/auth/indexing');

// Get a Guzzle HTTP Client
$httpClient = $client->authorize();
$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

$contentArray = [];

$handle = fopen("urls.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $url = trim($line);
        $contentArray[] = json_encode(['url' => $url, 'type' => 'URL_UPDATED']);
    }

    fclose($handle);
}

$limit = LIMIT_URLS;

foreach ($contentArray as $content) {
    if ($limit == 0) {
        echo "\n";
        echo "Limit of " . LIMIT_URLS . " URLs reached.\n";
        break;
    }
    $limit--;

    $response = $httpClient->post($endpoint, ['body' => $content]);
    $status_code = $response->getStatusCode();
    $text = $response->getReasonPhrase();

    echo "\n";
    echo $content;
    echo "\n";
    echo $status_code;
    echo ' ';
    echo $text;
    echo "\n";
    echo "\n";
}

