function FormValidation() {
    fullname = document.validation.name.value;
    address = document.validation.address.value;
    phone = document.validation.phone.value;
    accNo = document.validation.accNo.value;
    email = document.validation.email.value;
    password = document.validation.password.value;
    rpassword = document.validation.rpassword.value; 
    var nameExp = /^[a-zA-Z ]+$/;
    var phoneExp = /^98[0-9]{8}$/;
    var emailExp=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/;
    var accExp= /^[a-zA-Z0-9]+$/;
    if (fullname == "") {
        alert("Enter Name");
        return false;
    }
    if (!fullname.match(nameExp)) {
        alert("Name must be in text.");
        return false;
    }
    if (address == "") {
        alert("Enter Address");
        return false;
    }
    if (phone == "") {
        alert("Enter phone no.");
        return false;
    }
    if (!phone.match(phoneExp)) {
        alert("Phone must be only 10 numbers.");
        return false;
    }
    if(accNo == ""){
        alert("Enter account no");
    }
    if (!accNo.match(accExp)) {
        alert("Account Number Incorrect.");
        return false;
    }
    if (email == "") {
        alert("Enter Email");
        return false;
    }
    if(!(email.match(emailExp))){
        alert("Wrong email format.");
        return false;
    }
    if(password == "" || password.length<6){
        alert("Password must be more than 6 characters.");
        return false;
    }
    if(rpassword !== password){
        alert("Passwords do not match");
        return false;
    }
}