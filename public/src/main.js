$('.nav-link').on('click', function (e) {

    if (e.target.dataset['mycontent'] !== undefined && e.target.dataset['mycontent'] !== 'home') {
        e.preventDefault();

        let url = e.target.dataset['mycontent'];
        getpage(url);
        // e.target.classList.add('active');
        //remember to change the color of the sidebar
    }
});

$(document).on('click', '.mymodal', function(e){
    $('#new-modal').modal('show');
    // $('#new-modal').modal({keyboard: false, backdrop: 'static'});
});

$(document).on('click', '#modal-save-admin', function(e){
    e.preventDefault();

    if($('#cpassword').val() === $('#password').val())
    {
        $.ajax({
            method: 'POST',
            url: urlAddAdmin,
            data: {
                firstname: $('#firstname').val(),
                middlename: $('#middlename').val(),
                lastname: $('#lastname').val(),
                gender: $('#gender').val(),
                dob: $('#dob').val(),
                phone: $('#phone').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                _token: token
            }
        }).done(function(response){
            console.log(response['message']);
            $('#new-modal').modal('hide');

            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();
            getpage('addadmin');
        });
    }
    else{
        console.log('check your password');
    }
});

$(document).on('click', '#modal-save-state', function(e){
    e.preventDefault();

    $.ajax({
        method: 'POST',
        url: urlAddState,
        data: {state: $('#state').val(), _token: token}
    }).done(function(response){
        $('#new-modal').modal('hide');

        $('body').removeClass('modal-open');
        $(".modal-backdrop").remove();
        getpage('addstate');
        //remember to display the success notification using toast
    });
});

$(document).on('click', '#modal-save-lga', function(e){
    e.preventDefault();

    $.ajax({
        method: 'POST',
        url: urlAddLga,
        data: {lga: $('#lga').val(), state: $('#state').val(), _token: token}
    }).done(function(response){
        $('#new-modal').modal('hide');

        $('body').removeClass('modal-open');
        $(".modal-backdrop").remove();
        getpage('addlga');
        //remember to display the success notification using toast
    });
});

function getpage(pagename){
    $.ajax({
        method: 'POST',
        url: 'getdashdisplay',
        data: {display: pagename, _token: token}
    }).done(function (page) {
        $('#mycontainer').html(page);
    });
}
