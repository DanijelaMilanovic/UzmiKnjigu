/**
 * provjera da li password ima minimalno 8 karaktera, maksimalno 32 od kojih mora biti minimalno jedno veliko slovo,
 * jedno malo slovo, jedna cifra i jedan znak 
 */
const pattern =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,32}$/;

$('#sign-up').click(function() {
    var password = $('#password').val();

    console.log($('#password').val());
    console.log(!password.match(pattern));
    if(!pattern.test(password)) {
        $('.password-uncheck').css('display', 'block');
        return;
    }
    document.forms[0].submit();
});
