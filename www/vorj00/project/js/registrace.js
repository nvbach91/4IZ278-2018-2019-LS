/*vyskakovací hlášky u registrace*/
$(document).ready(function(){
    
$('#email').on('input', function() {
	$.post('include/check.php', { email: registrace.email.value },
	function(result){
		if(result=='"emailzabran"'){
			$('#email').each(function() {
				this.setCustomValidity('Tento e-mail už je zaregistrovaný.');
			});
		}
		else{
			$('#email').each(function() {
				this.setCustomValidity('');
			});
		}
	});
});

$('#first_name').on('input', function() {
if($(this).val().length>25){
$(this).each(function() {
   this.setCustomValidity('Jméno může obsahovat maximálně 25 znaků.');
});
}
else{
	$(this).each(function() {
		this.setCustomValidity('');
});
}
});

$('#prijmeni').on('input', function() {
if($(this).val().length>25){
$(this).each(function() {
   this.setCustomValidity('Jméno může obsahovat maximálně 25 znaků.');
});
}
else{
	$(this).each(function() {
		this.setCustomValidity('');
});
}
});

$('#confirm_email, #email').on('input', function() {
if(($('#email').val()!="")&&($('#confirm_email').val()!="")){
if($('#email').val()!=$('#confirm_email').val()){
$('#confirm_email').each(function() {
   this.setCustomValidity('Raději si zkontroluj e-maily.');
});
}
else{
	$('#confirm_email').each(function() {
   this.setCustomValidity('');
});
}}
});  
    
$('#heslo').on('input', function() {
if($(this).val().length<6){
$(this).each(function() {
   this.setCustomValidity('Heslo musí absahovat alespoň 6 znaků nebo odpověď na smysl života, PIN ke kartě, klíče od baráku a krev jednorožce.');
});
}
else{
	$(this).each(function() {
   this.setCustomValidity('');
});
}
});

$('#heslo1, #heslo2').on('input', function() {
if($(this).val().length<6){
$(this).each(function() {
   this.setCustomValidity('Heslo musí absahovat alespoň 6 znaků nebo odpověď na smysl života, PIN ke kartě, klíče od baráku a krev jednorožce.');
});
}
else{
    if(!($(this).val()==$('#heslo1').val() && $(this).val()==$('#heslo2').val())){
        $('#heslo1').get(0).setCustomValidity('');   
        $('#heslo2').get(0).setCustomValidity('Hesla nejsou shodná.');   
    }
    else{
    $('#heslo1').get(0).setCustomValidity('');
    $('#heslo2').get(0).setCustomValidity('');
}
}
});      
    
});