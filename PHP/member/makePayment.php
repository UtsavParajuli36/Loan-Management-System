<!DOCTYPE html>
<html lang="en">
<head>
    <title>Paying EMI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>  
    <h1>Note: While paying the EMI, the amount is first deposited into your account and emi amount is automatically deducted from your account.</h1>
    <?php
    session_start();
    $amountt = $_GET['emi_amount'];
    $amount = trim($amountt,"'");
    $_SESSION["totalAmount"]=$amount;
    // $amount=100;
    $tax = 0;
    $totalamount = $amount + $tax;
    $successUrl = "http://localhost/LoanMgmtSystem/PHP/member/successPayment.php";  
    $failureUrl = "http://localhost/LoanMgmtSystem/PHP/member/failurePayment.php";
    // $status = TRUE;
    // $url .= "?status=" . urlencode($status);
    ?>
    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        <label>Payments</label>
        <!-- <label>Amount</label> -->
        <input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>" required >
        <!-- <label>Tax amount</label> -->
        <input type="hidden" id="tax_amount" name="tax_amount" value="<?php echo $tax; ?>" required >
        <label>Total amount</label>
        <input type="text" id="total_amount" name="total_amount" value="<?php echo $totalamount; ?>" required readonly>
        <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="" required>
        <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
        <input type="hidden" id="success_url" name="success_url" value="<?php echo $successUrl;?>" required>
        <input type="hidden" id="failure_url" name="failure_url" value="<?php echo $failureUrl;?>" required>
        <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
        <input type="hidden" id="signature" name="signature" value="" required>
        <input value="Submit" type="submit">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>
    <script>
        var uuid = Date.now();
        var message = `total_amount=<?php echo $totalamount; ?>,transaction_uuid=${uuid},product_code=EPAYTEST`;
        var hash = CryptoJS.HmacSHA256(message, "8gBm/:&EnhH.1/q");
        var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
        var transacton = document.getElementById('transaction_uuid');
        transacton.value = uuid;
        var signature = document.getElementById('signature');
        signature.value = hashInBase64;
    </script>
</body>
</html>

