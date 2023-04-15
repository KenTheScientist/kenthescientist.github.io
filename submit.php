<?php
if(isset($_POST['submit'])){
    
require __DIR__ . '/vendor/autoload.php';

putenv('GOOGLE_APPLICATION_CREDENTIALS=credentials.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);

$service = new Google_Service_Sheets($client);

$spreadsheetId = '1GUREvx9Iyq0TBs_FeVld6X40hcdTWiJAVUJ94JS2kVw';
$range = 'Sheet1!A1:B2';

$values = [
    ['John', 'Doe'],
];

$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);

$params = [
    'valueInputOption' => 'RAW'
];

$insert = [
    'insertDataOption' => 'INSERT_ROWS'
];

$result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params, $insert);

printf("%d cells appended.", $result->getUpdates()->getUpdatedCells());

}
?>