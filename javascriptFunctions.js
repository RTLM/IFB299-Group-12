function submitForm(formId,status){
	document.getElementById("status"+formId).value = ""+status;
	document.getElementById("form"+formId).submit();
}