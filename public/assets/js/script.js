$(document).ready(function(){
    $('#checkstatus').click(function(e) {
        e.preventDefault();
        var name = $(this).find('input[name=name]').val();
        $.ajax({
            type: "POST",
            url: host + '/product/creditcheck',
        }).done(function( msg ) {
            alert( msg );
        });
    });
});