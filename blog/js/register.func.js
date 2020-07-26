//on charge JQuery pour faire un ajout suppréssion des classes

$(document).ready(function(){
    $('.field-input').focus(function(){
        $(this).parent().addClass('is-focused has-label');
    });

    // à la perte du focus
    $('.field-input').blur(function(){
        $parent = $(this).parent();
        if($(this).val() == ''){
            $parent.removeClass('has-label');
        }
        $parent.removeClass('is-focused');
    });

    // si un champs est rempli on rajoute directement la class has-label
    $('.field-input').each(function(){
        if($(this).val() != ''){
            $(this).parent().addClass('has-label');
        }
    });
//pour l'enregistrement si on soumet le formulaire : 
    $('#regForm').submit(function(){
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();

        var result = true;
//si jamais la var name egale à chaine vide : 
        if(name == ""){
            $('#name').parent().addClass('is-focused error');
            result = false;
        }
//si jamais la var email égale vide
        if(email == ""){
            $('#email').parent().addClass('is-focused error');
            result = false;
        }
//si jamais la var password est vide
        if(password == ""){
            $('#password').parent().addClass('is-focused error');
            result = false;
        }

        return result;

    });
//si l'user appuie sur une touche j'enlève l'erreur. 
    $('#name').keyup(function(){
        if($('#name').val() == ""){
            $('#name').parent().addClass('is-focused error');
        }else{
            $('#name').parent().removeClass('error');
        }
    });

    $('#email').keyup(function(){
        if($('#email').val() == ""){
            $('#email').parent().addClass('is-focused error');
        }else{
            $('#email').parent().removeClass('error');
        }
    });

    $('#password').keyup(function(){
        if($('#password').val() == ""){
            $('#password').parent().addClass('is-focused error');
        }else{
            $('#password').parent().removeClass('error');
        }
    });

});