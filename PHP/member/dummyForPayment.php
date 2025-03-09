<!DOCTYPE html>
<html lang="en">

<head>
    <title>EMI</title>
    <style type="text/css">
        table{
            margin-bottom:20px;
        }
        input[type="number"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    
    <form action="" method="post" name="EMI_pay">
    Amount: <input type="number" id="amount" name="amount" min="100" placeholder="<?php echo $eemi; ?>" >
    </form>
    <button onclick="makeEMIPayment()">Make EMI payment</button>

    <script>
    function makeEMIPayment() {
        var amount = document.getElementById("amount").value;
        if (amount < 100) {
            alert("Amount must be greater than or equal to 100.");
            return;
        }  
        var url = "makePayment.php?emi_amount=" + amount;
        window.location.href = url;
    }
    </script>

</body>

</html>	
