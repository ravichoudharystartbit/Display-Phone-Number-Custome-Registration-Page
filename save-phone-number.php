<?php
header("Access-Control-Allow-Origin: *");
/* install composer*/
require_once './vendor/autoload.php';

/*webhook verification function*/
function verify_webhook($data, $hmac_header, $app_api_secret) {
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $app_api_secret, true));
        return $calculated_hmac;    
}

// Set variable for Shopify webhook verification
$webhookContent = '';
$customerID = '';
$countryCode = '';
$hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
$data = file_get_contents('php://input');
$verified = verify_webhook($data, $hmac_header, "app_api_secret");
$webhookContent = json_decode($data);
/*Check webhook verification*/
if(isset($verified) && !empty($webhookContent)){  

    //Get Customer Detail
    $customerId= $webhookContent->id;
    $explodePhoneNum = explode("full_number:",$webhookContent->note);
    $customerPhoneNumber = trim($explodePhoneNum[1]);

    /*Using Shopify APi Update customer Phone Number*/
    $config = array(
            'ShopUrl' => 'store-testing.myshopify.com',
            'AccessToken' => 'access_code'
    );
    $shopify = new PHPShopify\ShopifySDK($config);
    $updatenote = array (
            "note" => ''
    );
    $updatephone = array (
            "phone" => $customerPhoneNumber
    );
    //update note field if phone number is valid
    try {
            $updatePhone = $shopify->Customer($customerId)->put($updatephone);                 
            $updateNote = $shopify->Customer($customerId)->put($updatenote);
        } catch (ApiException $e) {
                 echo $e->getMessage();
        }

}//check empty webhook data
?>
