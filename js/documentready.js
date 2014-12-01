$(document).ready(function () {
    treinRitDetails();
});

function treinRitDetails() {
    $(".treinRit").click(function(){
        $(this).find('.treinRitDetails').slideToggle('fast');
        $(this).find('.arrow').toggleClass('arrow-down').toggleClass('arrow-up');
    });
};