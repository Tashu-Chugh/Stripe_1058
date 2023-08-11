<?php 
    
$currency = "inr"; 
  
/* 
 * Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 
define('STRIPE_API_KEY', 'sk_test_51Ndu4wSA7sxjrgLsKuLLaamUAnYKfAjLKHez3oVarUOHeb10HMOvBvI2stSC23byDHPnDTLO9dlBcVoXTjqDPnQx00ZQtw8zy5'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51Ndu4wSA7sxjrgLsp7s5OUNQwLNv1V2Y3TNRMpvIeXg7BqHP5Ll1LaPYArIeYmsMPHpAZbn8aePNLtLpgsh0i83n00jMv7a1q4'); 
define('STRIPE_SUCCESS_URL', 'https://example.com/payment-success.php'); //Payment success URL 
define('STRIPE_CANCEL_URL', 'https://example.com/payment-cancel.php'); //Payment cancel URL 
    
// Database configuration    
define('DB_HOST', 'localhost');   
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', '');   
define('DB_NAME', 'sampledb'); 
 
?>