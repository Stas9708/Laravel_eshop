window.addEventListener('scroll', function () {
    document.getElementById('header-nav').classList.toggle('headernav-scroll', window.scrollY > 135);
});

document.addEventListener('livewire:navigated', () => {

    $('#top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 500);
        return false;
    });

});

$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#top').fadeIn();
        } else {
            $('#top').fadeOut();
        }
    });

});

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "500",
    "timeOut": "4000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "slideDown",
    "hideMethod": "slideUp"
}

window.addEventListener("popstate", function (e) {
    window.location.reload();
});
