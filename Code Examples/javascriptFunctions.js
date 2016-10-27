/*This file is part of On the Spot delivery website
for Assignment of IFB299, SEM-2, 2016, QUT. This website 
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
function submitForm2(formId){
	var noError = validateName("receiversname") && validateNumber("receiverscontact") && validateWeight("weight") && optionValidator("size") && optionValidator("valuable");
	return noError;
}
/*This function will update status with timestamps
Built from submitForm function
@param:formId-> ID of form to submit.
@param:status-> Status of Package.
@author: Navjot Singh Dhaliwal
Version 1.1 
Added timestamps
@author: Joshua Russell-Ahern
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
function hideElements(eventExecutor, button){
	var completed = 1;
	var pending = 2;
	var elements = document.getElementsByTagName('div');
	$(button).removeClass("disabled").siblings().removeClass("active");
	$(button).addClass("active").siblings().addClass("disabled");	
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
	var valid;
	switch(type){
		case "name":{
			setTimeout(function(valid){validateName(id);},1);
			break;
		}
		case "password":{
			setTimeout(function(){validatePassword(id);},1);
		}
		case "address":{
			valid = validateAddress(id);
			break;
		}
		case "number":{
			setTimeout(function(){validateNumber(id);},1);
			break;
		}
		case "weight":{
			setTimeout(function(){validateWeight(id);},1);
		}
	}
}
/*Helper function for validate method. This function will help
to validate name
@author: Navjot Singh Dhaliwal
*/
function validateName(id){
	var string = document.getElementById(id).value;
	if(/^[a-z A-Z]+$/.test(string)){
		changeProperty(id,"color",true);
		return true;
	}
	else{
		changeProperty(id,"color",false);
		return false;
	}
}
/*Helper function for validate method. This function will help
to validate password.
@author: Navjot Singh Dhaliwal
*/
function validatePassword(id){
	var string = document.getElementById(id).value;
	if(/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/.test(string)){
		changeProperty(id,"color",true);
		return true;
	}
	else{
		changeProperty(id,"color",false);
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
		changeProperty(id,"color",true);
		return true;
	}
	else{
		changeProperty(id,"color",false);
		return false;
	}
}
/*Helper function for validate method. This function will help
to validate address.
@author: Navjot Singh Dhaliwal
*/
function validateAddress(id){

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
		return false;
	}
	weight = parseInt(string);
	if(weight > maxWeight){
		changeProperty(id,"color",false);
		return false;
	}
	changeProperty(id,"color",true);
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
		color="red";
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
		}
	}
}
/*This function will append child into given element
@author: Navjot Singh Dhaliwal
*/
function appendElementB(id,elementType,elementValue,idOfNewElement){
	var element = document.createElement(elementType);
	element.id = idOfNewElement;
	element.style.cursor = "pointer";
	var value = document.createTextNode(elementValue);
	var parent = document.getElementById(id);
	element.appendChild(value);
	parent.appendChild(element);
}

/*This function will check if address is correct and 
append the formatted address to the given element.
@copyright: google
@modifiedBy: Navjot Singh Dhaliwal
*/
function doGeocode(id){
  	var addr = document.getElementById(id);
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({'address': addr.value, 
						'region' : 'aus', 
						'bounds': new google.maps.LatLngBounds(new google.maps.LatLng( -27.657579, 152.692471), new google.maps.LatLng( -27.184346, 153.277443)),
						'componentRestrictions' : {country: 'AU'}}, function(results, status){
	    if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
	    	changeProperty(id,"color",true);
	    	document.getElementById(id).value = results[0].formatted_address;
	    }
	    else{
	    	changeProperty(id,"color",false);
	    }
	});
}

function optionValidator(id){
	var string = document.getElementById(id).value;
	if(string == ""){
		return false;
	}
	return true;
}