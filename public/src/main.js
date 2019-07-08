$('.nav-link').on('click', function (e) {

    if (e.target.dataset['mycontent'] !== undefined && e.target.dataset['mycontent'] !== 'home') {
        e.preventDefault();

        let url = e.target.dataset['mycontent'];
        $.ajax({
            method: 'POST',
            url: 'getdashdisplay',
            data: {display: url, _token: token}
        }).done(function (msg) {
            // e.target.classList.add('active');
            //remember to change the color of the sidebar
            $('#mycontainer').html(msg);
            // console.log(msg);
        });
    }
});

$(document).on('click', '.test', function(e){
    $('#new-modal').modal();
});

$(document).on('click', '#modal-save-admin', function(e){
    e.preventDefault();
    // let fir = $('#firstname').val();
    // console.log(fir);

    // if($('#cpassword').val() === $('#password').val())
    // {
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
        });
    // }
    // else{
    //     console.log('check your password');
    // }
});
