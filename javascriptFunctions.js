/*This file is part of On the Spot delivery website
for Assignment of IFB299, SEM-2, 2016, QUT. This file 
contains javascript functions.
@author:Navjot Singh Dhaliwal
*/

/*This function will submit the form
@param:formId-> ID of form to submit.
@param:status-> Status of Package.
@author: Navjot Singh Dhaliwal
Version 1.1 
Allowed for general use of function
@author: Joshua Russell-Ahern
*/
function submitForm(formId, item, columm){
	document.getElementById(columm+formId).value = ""+item;
	document.getElementById("form"+formId).submit();
}
/*This function is specfically designed for order.php
@author: Navjot singh Dhaliwal
*/
function validateOrderForm(formId){
	validateAddresses('destination');
	validateAddresses('pickup');
	var noError = validateName("receiversname") && validateNumber("receiverscontact") && validateWeight("weight") && optionValidator("size") && validateIfTrue('destinationValidator') && validateIfTrue('pickupValidator');
	if(noError == false){
		window.scroll(0,0);
	}
	return noError;
}

function validateRegisterForm(){
	validateAddresses("address");
	var noError = validateEmail("email") && validatePassword("password") && validateNumber('contact') && validateIfTrue('address') && validateName("firstname") && validateName("lastname");
	if(noError == false){
		window.scroll(0,0);
	}
	return noError;	
}

/*This function will validate the address 
@author:Navjot Singh Dhaliwal
*/
function validateAddresses(id){
	var address = document.getElementById(id).value;
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({'address': address},function(results, status){
	    if (status === google.maps.GeocoderStatus.OK && results.length == 1) {
	    	valueChanger(id+"Validator",true);
	    }
	    else{
	    	valueChanger(id+"Validator",false);
	    }
	});
}

function valueChanger(id,value){
	var element = document.getElementById(id);
	element.value = value;
}

/*This function will update status with timestamps
Built from submitForm function
@param:formId-> ID of form to submit.
@param:status-> Status of Package.
@author: Navjot Singh Dhaliwal & Joshua Russell-Ahern
*/
function updateStatus(formId, item, columm, orderNo){
	$.ajax({
		method: "GET",
        url: "updateTimestamp.php",          
        data: { status: item, orderNo: orderNo}
    }); 
	document.getElementById(columm+formId).value = ""+item;
	document.getElementById("form"+formId).submit();
	  
}
/*Simple function to change the cursor type on elements
@author:Navjot Singh Dhaliwal
*/
function changeCursorType(cursorType,elementTag){
	var tagElements = document.getElementsByTagName(elementTag);
	for(var i = 0; i < tagElements.length;i++){
		tagElements[i].style.cursor = cursorType;
	}
}

/*Simple function to hide elements
@author:Navjot Singh Dhaliwal
*/
function hideElements(eventExecutor){
	var completed = 1;
	var pending = 2;
	var elements = document.getElementsByTagName('div');
	if(eventExecutor == completed){
		for(var i = 0; i < elements.length;i++){
			if(elements[i].getAttribute('name') == "Pending" ||	elements[i].getAttribute('name') == "Ready For Pickup" || elements[i].getAttribute('name') == "With Driver For Delivery" || elements[i].getAttribute('name') == "On Way to Warehouse" ||	elements[i].getAttribute('name') == "At Warehouse"){
				elements[i].style.display = "none";
			}
			else if(elements[i].getAttribute('name') == "Complete"){
				elements[i].style.display = "block";
			}
		}
	}
	else{
		for(var i = 0; i < elements.length;i++){
			if(elements[i].getAttribute('name') == "Pending" ||	elements[i].getAttribute('name') == "Ready For Pickup" || elements[i].getAttribute('name') == "With Driver For Delivery" || elements[i].getAttribute('name') == "On Way to Warehouse" ||	elements[i].getAttribute('name') == "At Warehouse"){
				elements[i].style.display = "block";
			}
			else if(elements[i].getAttribute('name') == "Complete"){
				elements[i].style.display = "none";
			}
		}
	}
}
/*This function clicks an element of given ID
@author:Navjot Singh Dhaliwal
*/
function clickElement(ID){
	document.getElementById(ID).click();
}
/*This function will validate user input on client side.
@author: Navjot Singh Dhaliwal
*/
function validate(id,type,flag){
	if(flag !=false){
		validateAddresses('destination');
		validateAddresses('pickup');
	}
	else{
		validateAddresses('address');
	}
	switch(type){
		case "name":{
			setTimeout(function(){validateName(id);},1);
			break;
		}
		case "password":{
			setTimeout(function(){validatePassword(id);},1);
			break;
		}
		case "number":{
			setTimeout(function(){validateNumber(id);},1);
			break;
		}
		case "weight":{
			setTimeout(function(){validateWeight(id);},1);
			break;
		}
		case "email":{
			setTimeout(function(){validateEmail(id);},1);
			break;
		}
	}
}
/*Helper function to validate email
@author: Navjot Singh Dhaliwal
*/
function validateEmail(id) {
	var email = document.getElementById(id).value;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(email)){
		changeProperty(id,"color",true);
		return true;
	}
	else{
		changeProperty(id,"color",false);
		return false;
	}
}
/*Helper function for validate method. This function will help
to validate name
@author: Navjot Singh Dhaliwal
*/
function validateName(id){
	var string = document.getElementById(id).value;
	var labelId = id+"Label";
	if(/^[a-z A-Z]+$/.test(string) && string.length < 20){
		changeProperty(id+"Label","color",true);
		changeProperty(id,"color",true);
		return true;
	}
	else{
		changeProperty(id,"color",false);
		changeProperty(id+"Label","color",false);
		return false;
	}
}
/*Helper function for validate method. This function will help
to validate password.
@author: Navjot Singh Dhaliwal
*/
function validatePassword(id){
	var string = document.getElementById(id).value;
	if(/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/.test(string) && string.length > 8){
		changeProperty(id,"color",true);
		changeProperty(id+"Label","color",true);
		return true;
	}
	else{
		changeProperty(id,"color",false);
		changeProperty(id+"Label","color",false);
		return false;
	}
}
/*Helper function for validate method. This function will help
to validate contact number.
@author: Navjot Singh Dhaliwal
*/
function validateNumber(id){
	var preg = /^(0(2|3|4|7|8))?\d{8}$/; 
	var string = document.getElementById(id).value;
	if(preg.test(string) && string.length == 10){
		changeProperty(id+"Label","color",true);
		changeProperty(id,"color",true);
		return true;
	}
	else{
		changeProperty(id,"color",false);
		changeProperty(id+"Label","color",false);
		return false;
	}
}
/*Helper function for validate method. This function will help
to validate destination.
@author: Navjot Singh Dhaliwal
*/
function validateIfTrue(id){
	var desElement = document.getElementById(id);
	var destination = desElement.value;
	if(destination == "false"){
		document.getElementById(id+"Label").style.color = "orangered";
		return false;
	}
	document.getElementById(id+"Label").style.color = "black";
	return true;
}
/*Helper function for validate method. This function will help
to validate weight.
@author: Navjot Singh Dhaliwal
*/
function validateWeight(id){
	var string = document.getElementById(id).value;
	var maxWeight = 22;
	var weight;
	if(!isNumeric(string)){
		changeProperty(id,"color",false);
		changeProperty(id+"Label","color",false);
		return false;
	}
	weight = parseInt(string);
	if(weight > maxWeight || weight <= 0){
		changeProperty(id,"color",false);
		document.getElementById(id+"Label").innerHTML = "Weight should be < 22 && > 0";
		changeProperty(id+"Label","color",false);
		return false;
	}
	changeProperty(id,"color",true);
	changeProperty(id+"Label","color",true);
	document.getElementById(id+"Label").innerHTML = "Weight:(Kgs):";
	return true;
}
/*Helper function for validateWeight method. This function will help
to validate given string if it is a number.
@author: Navjot Singh Dhaliwal
*/
function isNumeric(string) {
  return !isNaN(parseFloat(string)) && isFinite(string);
}

/*Helper function to change property of given element
@author:Navjot Singh Dhaliwal*/
function changeProperty(id,attribute,status){
	var color;
	var displayOfElement;
	if(status){
		color="black";
		displayOfElement = "block";
	}
	else{
		color="orangered";
		displayOfElement = "none";
	}
	var element = document.getElementById(id);
	switch(attribute){
		case "color":{
			element.style.color = color;
			break;
		}
		case "disabled":{
			element.disabled = status;
			break;
		}
		case "display":{
			element.style.display = displayOfElement;
			break;
		}
		case "value":{
			element.value = status;
			break;
		}
	}
}
/*This function will append child into given element
@author: Navjot Singh Dhaliwal
@id->parent elment
*/
function appendElement(id,elementType,elementValue,idOfNewElement){
	var parent = document.getElementById(id);
	var newElement = document.createElement(elementType);
	newElement.id = idOfNewElement;
	newElement.value = elementValue;
	parent.appendChild(newElement);
}
/**
This function will create two elements which will be used to 
validate destination and pick up address
@author: Navjot Singh Dhaliwal
*/
function prepareOrder(){
	appendElement("addressDiv","INPUT",false,"destinationValidator");
	appendElement("addressDiv","INPUT",false,"pickupValidator");	
}
function prepareRegister(){
	appendElement("addressDiv","INPUT",false,"addressValidator");
}
/*This function will check if address is correct and 
append the formatted address to the given element.
@copyright: google
@modifiedBy: Navjot Singh Dhaliwal
*/
function doGeocode(id){
  	var addr = document.getElementById(id);
  	var flag = false;
  	var p = 2;
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({'address': addr.value},function(results, status){
	    if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
	    	document.getElementById(id+"Label").innerHTML = id;
	    	changeProperty(id+"Label","color",true);
	    	changeProperty(id,"color",true);
	    	changeProperty(id,"value",results[0].formatted_address);
	    	validateAddresses('destination');
	    	validateAddresses('pickup');
	    }
	    else{
	    	document.getElementById(id+"Label").innerHTML = "Invalid Location!! Make sure it exists inside brisbane area.."
	    	changeProperty(id+"Label","color",false);
	    	changeProperty(id,"color",false);
	    	validateAddresses('destination');
	    	validateAddresses('pickup');
	    }
	});
	
}

/*Check if option has been selected
@author: Navjot Singh Dhaliwal
NOT GENERIC
*/
function optionValidator(id){
	var element = document.getElementById(id);
	if(element.value == ""){
		document.getElementById(id+"Label").style.color = "orangered";
		return false;
	}
	document.getElementById(id+"Label").style.color = "black";
	return true;
}
