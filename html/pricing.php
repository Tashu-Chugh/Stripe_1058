<!DOCTYPE html>
<?php session_start();?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Page</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="normalize.min.css">
    <link rel="stylesheet" href="../css/pricing.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <section>
        <div>
            <div class="pricing-container">
                <h1>Choose the right plan for you</h1>
                <h5>Click on the Package you want to select</h5>
            </div>
            <div class="pricing-table">
                <table>
                <thead style="display:block;">
                    <tr>
                        <th colspan="20%">
                            <label class="switch">
                                <input type="checkbox" id="subscription-toggle" onchange="toggle_button()">
                                <span class="slider"></span>
                            </label>
                            <span class="toggle-label" id="monthly" style="display:block;" >Monthly</span>
                            <span class="toggle-label" id="yearly" style="display:none;">Yearly</span>
                        </th>
                        <th class="square pricing-card" colspan="20%"><span class="package-name">Mobile</span></th>
                        <th class="square pricing-card " colspan="20%"><span class="package-name">Basic</span></th>
                        <th class="square pricing-card " colspan="20%"><span class="package-name">Standard</span></th>
                        <th class="square pricing-card " colspan="20%"><span class="package-name">Premium</span></th>
                    </tr>
                </thead>
                <tbody id="monthly-price" style="display:block;">
                    <tr >
                        <td>Monthly price</td>
                        <td><span class="monthly-price">500 INR</span>  </td>
                        <td><span class="monthly-price">1000 INR</span> </td>
                        <td><span class="monthly-price">2500 INR</span></td>
                        <td><span class="monthly-price">5500 INR</span></td>
                    </tr>
                    <tr>
                        <td>Video Quality</td>
                        <td>Good</td>
                        <td>Good</td>
                        <td>Better</td>
                        <td>Best</td>
                    </tr>
                    <tr>
                        <td>Resolution</td>
                        <td>480p</td>
                        <td>480p</td>
                        <td>1080p</td>
                        <td>4k + HDR</td>
                    </tr>
                    <tr>
                        <td>Devices you can use to watch</td>
                        <td>Phone+ Tablet</td>
                        <td>Phone+ Tablet+ Computer+ TV</td>
                        <td>Phone+ Tablet+ Computer+ TV</td>
                        <td>Phone+ Tablet+ Computer+ TV</td>
                    </tr>
                </tbody>
                <tbody id="yearly-price" style="display:none;">
                    <tr>
                    <td>Yearly price</td>
                        <td><span class="yearly-price">1000 INR</span></td>
                        <td><span class="yearly-price">2000 INR</span></td>
                        <td><span class="yearly-price">5000 INR</span></td>
                        <td><span class="yearly-price">7000 INR</span></td>
                    <tr>
                        <td>Video Quality</td>
                        <td>Good</td>
                        <td>Good</td>
                        <td>Better</td>
                        <td>Best</td>
                    </tr>
                    <tr>
                        <td>Resolution</td>
                        <td>480p</td>
                        <td>480p</td>
                        <td>1080p</td>
                        <td>4kK + HDR</td>
                    </tr>
                    <tr>
                        <td>Devices you can use to watch</td>
                        <td>Phone 
                            Tablet</td>
                        <td>Phone
                            Tablet
                            Computer TV
                        </td>
                        <td>Phone
                            Tablet Computer TV</td>
                        <td>Phone
                            Tablet Computer TV</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="center">
            <button class="next-button" onclick="redirection();">Next</a></button>
        </div>
    </section>
</body>

<script type="text/javascript">
        var toggle_value="monthly";
        var packageName="";
    function toggle_button() {
        const toggle = document.getElementById("subscription-toggle");
        const labelm = document.getElementById('monthly');
        const labely = document.getElementById('yearly');
        const monthly = document.getElementById("monthly-price");
        const yearly = document.getElementById("yearly-price");
        if(toggle.checked)
        {
            labelm.style.display =" none";
            labely.style.display ="block";
            monthly.style.display =" none";
            yearly.style.display ="block";
            toggle_value="yearly";
        }
        else
        {
            labely.style.display =" none";
            labelm.style.display ="block";
            yearly.style.display ="none";
            monthly.style.display ="block";
            toggle_value="monthly";
    }

}
</script>
<script>
        const thElements = document.querySelectorAll(".pricing-card");

        thElements.forEach(th => {
            th.addEventListener("click", function() {
                 thElements.forEach(element => {
                    element.classList.remove("premium");
                });
                this.classList.add("premium");
                packageName = this.querySelector(".package-name").textContent;
                

            });
        });
        function redirection()
        { 
            alert();
            $.ajax(
                {
                    type:'POST',
                    url:"../ajax/session_variable.php",
                    data:{package:packageName,plan:toggle_value,hash:'hash'},
                    success:function(data)
                    {
                        console.log(data);
                        if(data=='0')
                        {
                            window.location.href = "payment.php";
                        }
                        
                        else
                        {
                            alert('something went wrong');
                        }
                    }
                });
            
        }
    </script>
    <script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</html>
