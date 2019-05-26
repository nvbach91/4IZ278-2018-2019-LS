/*když uživatel klikne u nějakého prvku s našeptávačem (třeba Google Maps našeptávač) na enter, neměl by se odeslat formulář, pouze potvrdit našeptání*/
$(document).ready(function(){
$('#autocomplete').keypress(function(event) {
    if (event.which == 13 ) {
        event.preventDefault();
    }
});
});