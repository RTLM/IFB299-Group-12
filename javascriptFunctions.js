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