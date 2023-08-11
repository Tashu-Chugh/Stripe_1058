<!DOCTYPE html>
<?php 
require_once '../ajax/config.php';   ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Page</title>
    
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="normalize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
 <section>
     <div class="col-sm-12">
         <div class="col-sm-2"></div>
         <div class="col-sm-8">
             
                <div class="plan-container">
                    <h2>SELECTED PLAN DETAILS</h2>
                    <div class="package-name">
                        <p id="package"></p>
                    </div>
                    <div class="package-price">
                        <p id="price"></p>
                    </div>
                    <div class="package-duration">
                        <p id="duration"></p>
                    </div>
                </div>
                  <button class="stripe-button" id="payButton">
                    <div class="spinner hidden" id="spinner"></div>
                            <span id="buttonText">Pay Now</span>
                 </button>
            
         </div>
         <div class="col-sm-2"></div>
     </div>
 </section>
        
</body>

<script src="https://js.stripe.com/v3/"></script>

<script>
function load_data()
{
    $.ajax(
                {
                    type:'POST',
                    url:"../ajax/get_plan.php",
                    data:{hash:'hash'},
                    success:function(data)
                    {
                        console.log(data);
                           var da = JSON.parse(data);
                           document.getElementById('package').innerHTML = da['package'];
                           document.getElementById('price').innerHTML = da['cost'];
                           document.getElementById('duration').innerHTML= da['duration'];
                        
                        
                    }
                });
}
load_data();
const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

// Select payment button
const payBtn = document.querySelector("#payButton");

// Payment request handler
payBtn.addEventListener("click", function (evt) {
    setLoading(true);

    createCheckoutSession().then(function (data) {
        if(data.sessionId){
            stripe.redirectToCheckout({
                sessionId: data.sessionId,
            }).then(handleResult);
        }else{
            handleResult(data);
        }
    });
});
    
// Create a Checkout Session with the selected product
const createCheckoutSession = function (stripe) {
    return fetch("../ajax/payment_init.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            createCheckoutSession: 1,
        }),
    }).then(function (result) {
        return result.json();
    });
};

// Handle any errors returned from Checkout
const handleResult = function (result) {
    if (result.error) {
        showMessage(result.error.message);
    }
    
    setLoading(false);
};

// Show a spinner on payment processing
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        payBtn.disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#buttonText").classList.add("hidden");
    } else {
        // Enable the button and hide spinner
        payBtn.disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#buttonText").classList.remove("hidden");
    }
}

// Display message
function showMessage(messageText) {
    const messageContainer = document.querySelector("#paymentResponse");
    
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
    
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 5000);
}
</script>

</html>
