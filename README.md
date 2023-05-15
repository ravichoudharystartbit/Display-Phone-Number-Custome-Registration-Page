#1 You can use below code to add phone number field in customer-registration liquid file. This code will help to display phone number field on the customer registration page. This will save phone number in note field.

<input type="text" name="customer[note][phonenumber]">

#2 You need to create a custom app to save phone number in customer phone number field. Please create the custom app from shopify store. 

#3 You need to install PHP SHopifySDK on you PHP server.

composer require phpclassic/php-shopify

#4 Configure ShopifySDK

$config = array(
    'ShopUrl' => 'yourshop.myshopify.com',
    'AccessToken' => '***ACCESS-TOKEN-FOR-THIRD-PARTY-APP***',
);

#5 Call file 'save-phone-number.php' on the customer create webhook.
Phone Number Field On customer-registration page:-
<p align="center">
  <img src="https://github.com/ravichoudharystartbit/Display-Phone-Number-Custome-Registration-Page/blob/d493d18ddc40f29daad73edc59b105d4b76a32f0/phone-number-field.png" width="350" title="hover text">
</p>
Webhook Image:-
<p align="center">
  <img src="https://github.com/ravichoudharystartbit/Display-Phone-Number-Custome-Registration-Page/blob/1301ea670bd769bea105234659f77240b371704a/webhook.png" width="350" title="hover text">
</p>

