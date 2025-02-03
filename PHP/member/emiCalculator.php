<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMI CALCULATOR</title>
</head>
<body>
    <form action="">
        Enter Loan Amount: <input type="number" name="loan_amount"> 
        Enter Interest Rate in %: <input type="number" name="interest_rate">
        Enter Loan Tenure (Months): <input type="number" name="tenure">
        <input type="submit" name="submit" value="Calculate">
    </form>
</body>
</html> -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMI CALCULATOR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 300px;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="number"],
        input[type="submit"] {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #output {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: none;
        }
    </style>
</head>
<body>
    <form id="emi-form">
        <label for="loan_amount">Enter Loan Amount:</label>
        <input type="number" id="loan_amount" name="loan_amount" required>
        
        <label for="interest_rate">Enter Interest Rate in %:</label>
        <input type="number" id="interest_rate" name="interest_rate" required>
        
        <label for="tenure">Enter Loan Tenure (Months):</label>
        <input type="number" id="tenure" name="tenure" required>

        <input type="submit" name="submit" value="Calculate">
    </form>

    <div id="output">
        <h2>EMI Calculation Result</h2>
        <p>Total Interest Amount: <span id="total_interest"></span></p>
        <p>Total Principal: <span id="total_principal"></span></p>
        <p>Total Payment (Principal + Interest): <span id="total_payment"></span></p>
        <p>EMI Amount: <span id="emi_amount"></span></p>
    </div>

    <script>
        document.getElementById('emi-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            var loanAmount = parseFloat(document.getElementById('loan_amount').value);
            var interestRate = parseFloat(document.getElementById('interest_rate').value);
            var tenure = parseFloat(document.getElementById('tenure').value);
            
            var monthlyInterestRate = (interestRate / 100) / 12;
            var totalPayments = tenure;
            var monthlyInterestFactor = Math.pow((1 + monthlyInterestRate), totalPayments);
            var emiAmount = loanAmount * monthlyInterestRate * (monthlyInterestFactor / (monthlyInterestFactor - 1));
            
            var totalPayment = emiAmount * totalPayments;
            var totalInterest = totalPayment - loanAmount;
            var totalPrincipal = loanAmount;
            
            document.getElementById('total_interest').innerText = totalInterest.toFixed(2);
            document.getElementById('total_principal').innerText = totalPrincipal.toFixed(2);
            document.getElementById('total_payment').innerText = totalPayment.toFixed(2);
            document.getElementById('emi_amount').innerText = emiAmount.toFixed(2);
            
            document.getElementById('output').style.display = 'block';
        });
    </script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMI CALCULATOR</title>
    <style>
        form {
            width: 300px;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Add margin bottom to create space between form and output */
        }

        input[type="number"],
        input[type="submit"] {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #output {
            width: 400px; /* Same width as the form */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: none;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <form id="emi-form">
        <label for="loan_amount">Enter Loan Amount:</label>
        <input type="number" id="loan_amount" name="loan_amount" required>
        
        <label for="interest_rate">Enter Interest Rate in %:</label>
        <input type="number" id="interest_rate" name="interest_rate" required>
        
        <label for="tenure">Enter Loan Tenure (Months):</label>
        <input type="number" id="tenure" name="tenure" required>

        <input type="submit" name="submit" value="Calculate">
    </form>

    <div id="output">
        <h2>EMI Calculation Result</h2>
        <p>Total Interest Amount: <span id="total_interest"></span></p>
        <p>Total Principal: <span id="total_principal"></span></p>
        <p>Total Payment (Principal + Interest): <span id="total_payment"></span></p>
        <p>EMI Amount: <span id="emi_amount"></span></p>
    </div>

    <script>
        document.getElementById('emi-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            var loanAmount = parseFloat(document.getElementById('loan_amount').value);
            var interestRate = parseFloat(document.getElementById('interest_rate').value);
            var tenure = parseFloat(document.getElementById('tenure').value);
            
            var monthlyInterestRate = (interestRate / 100) / 12;
            var totalPayments = tenure;
            var monthlyInterestFactor = Math.pow((1 + monthlyInterestRate), totalPayments);
            var emiAmount = loanAmount * monthlyInterestRate * (monthlyInterestFactor / (monthlyInterestFactor - 1));
            
            var totalPayment = emiAmount * totalPayments;
            var totalInterest = totalPayment - loanAmount;
            var totalPrincipal = loanAmount;
            
            document.getElementById('total_interest').innerText = totalInterest.toFixed(2);
            document.getElementById('total_principal').innerText = totalPrincipal.toFixed(2);
            document.getElementById('total_payment').innerText = totalPayment.toFixed(2);
            document.getElementById('emi_amount').innerText = emiAmount.toFixed(2);
            
            document.getElementById('output').style.display = 'block';
        });
    </script>
</body>
</html>


