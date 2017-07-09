function validateForm(){
    var usrinput = document.forms['regForm']['username'].value;
    var inputtxt = document.forms['regForm']['password'].value;
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;


    var spaceSearch = usrinput.search(/\s/);
    var phoneExpression = /^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{1}(\ |-){0,1}[0-9]{3}$/;
    var phone = document.forms['regForm']['phone'].value;
    if(spaceSearch > -1)
        {
            window.alert("Your username cannot have a space in it.");
            return false;
        }

    else if(! inputtxt.match(passw))
        {
            window.alert('Your password must be at least 6 characters, with at least 1 uppercase character and 1 numerical digit.');
            return false;
        }
    else if (! phone.match(phoneExpression))
        {
            window.alert('Please enter a correct phone number format. Mobile numbers must start with 04 and landline numbers must contain the area code.');
            return false;
        }
    else
        {
            window.alert('Thank you for registering with us!');
            return true;
        }
}


function validateClientLogin(){

	var userinput = document.forms['clientLogin']['username'].value;
	var userpass = document.forms['clientLogin']['password'].value;
	if (userinput == null || userpass == null){
		alert("Username and password must be filled in.")
	}
    
}

function validateContractorLogin(){
	var userinput = document.forms['contractorLogin']['username'].value;
	var userpass = document.forms['contractorLogin']['password'].value;
	if (userinput == null || userpass == null){
		alert("Username and password must be filled in.")
	}
}

function myFunction() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar")

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

function myFunction1() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar")

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
