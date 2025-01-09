<?php
        // $conn=mysqli_connect('localhost','root','');
        // To use the database
        $conn=mysqli_connect('localhost','root','','SMSC_project');
        if(!$conn){
            die("Connection failed: ".
            mysqli_connect_errno() );
        }

        // Creating a new database
        // $sql1="CREATE DATABASE SMSC_project";
        // if(mysqli_query($conn,$sql1)){
        //     echo "Database Created Successfully.";
        // }
        // else{
        //     echo "Database could not be created.";
        // }

        // Creating new tables
        $sql2="CREATE TABLE members
            (
            member_id INT AUTO_INCREMENT PRIMARY KEY,
            member_name VARCHAR(30) NOT NULL,
            address VARCHAR(30) NOT NULL, 
            phone BIGINT UNIQUE NOT NULL,
            email VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(30) NOT NULL,
            account_no VARCHAR(10) NOT NULL,
            index(account_no),
            FOREIGN KEY (account_no) REFERENCES accounts(account_no)
            )";
        if(mysqli_query($conn,$sql2)){
            echo "Table members created successfully.";
        }
        else{
             echo "Table members not created.";
        }
        $sql3="CREATE TABLE loans
        (
            loan_id INT AUTO_INCREMENT PRIMARY KEY,
            loan_type VARCHAR(30) NOT NULL,
            loan_amount INT NOT NULL,
            term_months INT NOT NULL,
            interest_rate INT,
            start_date DATE,
            request_status enum('pending', 'approved', 'rejected') default pending,
            status enum('active', 'expired','defaulted'),
            member_id int not null,
            collateral_id int,
            backer_id int,
            INDEX(member_id, collateral_id,backer_id),
                FOREIGN KEY (member_id) REFERENCES members(member_id),
                FOREIGN KEY (collateral_id) REFERENCES collaterals(collateral_id),
                FOREIGN KEY (backer_id) REFERENCES backers(backer_id)
        );";
        if(mysqli_query($conn,$sql3)){
            echo "Table loans created successfully.";
        }
        else{
             echo "Table loans not created.";
        }
        $sql4="CREATE TABLE collaterals
            (
            collateral_id INT AUTO_INCREMENT PRIMARY KEY,
            collateral_type VARCHAR(20) NOT NULL,
            collateral_value BIGINT NOT NULL,
            member_id int not null,
            INDEX(member_id),
                FOREIGN KEY (member_id) REFERENCES members(member_id)
            )";
        if(mysqli_query($conn,$sql4)){
            echo "Table collaterals created successfully.";
        }
        else{
             echo "Table collaterals not created.";
        }
        $sql5="CREATE TABLE description
            (
            desc_id INT AUTO_INCREMENT PRIMARY KEY,
            description TEXT NOT NULL,
            loan_id int not null,
            INDEX(loan_id),
                FOREIGN KEY (loan_id) REFERENCES loans(loan_id),
            status ENUM('defaulted','rejected') NOT NULL
            )";
        if(mysqli_query($conn,$sql5)){
            echo "Table decription created successfully.";
        }
        else{
             echo "Table decription not created.";
        }
        $sql6="CREATE TABLE emi
            (
            emi_id INT AUTO_INCREMENT PRIMARY KEY,
            emi_amount DECIMAL(10,2) NOT NULL,
            paid_date DATE NOT NULL,
            loan_id INT NOT NULL,
            INDEX(loan_id),
                FOREIGN KEY (loan_id) REFERENCES loans(loan_id)
            )";
        if(mysqli_query($conn,$sql6)){
            echo "Table emi created successfully.";
        }
        else{
             echo "Table emi not created.";
        } 
        $sql7="CREATE TABLE accounts
            (
            account_no VARCHAR(10) PRIMARY KEY,
            account_type VARCHAR(40) NOT NULL,
            interest_rate FLOAT NOT NULL,
            balance DECIMAL(10,2) NOT NULL
            )";
        if(mysqli_query($conn,$sql7)){
            echo "Table accounts created successfully.";
        }
        else{
             echo "Table accounts not created.";
        } 
        $sql8="CREATE TABLE admins
        (
            admin_id INT AUTO_INCREMENT PRIMARY KEY,
            admin_name VARCHAR(30) NOT NULL,
            admin_email VARCHAR(50) NOT NULL,
            password VARCHAR(30) NOT NULL
        )";
        if(mysqli_query($conn,$sql8)){
            echo "Table admins created successfully.";
        }
        else{
             echo "Table admins not created.";
        } 
        $sql9="CREATE TABLE backers
            (
            backer_id INT AUTO_INCREMENT PRIMARY KEY,
            member_id INT NOT NULL,
            account_no_of_backer INT NOT NULL,
            INDEX(member_id, account_no_of_backer),
                FOREIGN KEY (member_id) REFERENCES members(member_id),
                FOREIGN KEY (account_no_of_backer) REFERENCES accounts(account_no)
            )";
        if(mysqli_query($conn,$sql9)){
            echo "Table backers created successfully.";
        }
        else{
             echo "Table backers not created.";
        }

        mysqli_close($conn);
?>