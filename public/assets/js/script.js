$(document).ready(function(){
    $('#checkstatus').click(function(e) {

        e.preventDefault();

        $.ajax({
            type: "POST",
			data: $('#orderform').serialize(),
            url: '/products/creditcheck',
        }).done(function( msg ) {
            alert( msg );
        });
    });
});