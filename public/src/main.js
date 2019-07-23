// use this to get the id from the icon click
// let id = e.target.parentNode.childNodes["0"].parentNode.parentElement.parentElement.dataset['id'];

$(document).on('change', '#consti, #state', function() {
    if ($(this).is(':checked')) {
      $(this).attr('value', 1);
    } else {
      $(this).attr('value', 0);
    }
});

$(document).on('click', '.side-bar', function(){
    $('.side-bar').removeClass('active');
    $(this).toggleClass('active');
  });

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

$(document).on('click', '.viewmodal', function(e){
    //add more view-modal ids in the next line.
    let views = '#state-view-modal, #lga-view-modal, #party-view-modal, #office-view-modal, #admin-view-modal';

    e.preventDefault();
    $(views).modal('show');
    let identifier = $('.table').data('identifier');

    let id = e.target.parentNode.childNodes["0"].parentNode.parentElement.parentElement.dataset['id'];
    // console.log(id, identifier);
    $.ajax({
        method: 'POST',
        url: urlid,
        data: {id: id, identifier: identifier, _token: token} //add an identifier here
    }).done(function(response){
        switch (identifier) {
            case 'state':
                $('#vname').val(response['state'].name);
                break;

            case 'lga':
                console.log(response['lga']);
                $('#vlga').val(response['lga'].name);
                $('#vstate').val(response['lga'].state);
                break;

            case 'party':
                $('#vname').val(response.party.name);
                $('#vacronym').val(response.party.acronym);
                $('#vdesc').val(response.party.desc);
                break;

            case 'office':
                $('#vname').val(response.office.name);
                if(response.office.state == 1){
                    $('#vstate').attr('checked', true);
                }else{
                    $('#vstate').attr('checked', false);
                }
                if(response.office.consti == 1){
                    $('#vconsti').attr('checked', true);
                }else{
                    $('#vconsti').attr('checked', false);
                }
                break;

            case 'admin':
                $('#vfirstname').val(response.admin.firstname);
                $('#vmiddlename').val(response.admin.midname);
                $('#vlastname').val(response.admin.lastname);
                $('#vgender').val(response.admin.gender);
                $('#vdob').val(response.admin.dob);
                $('#vphone').val(response.admin.phone);
                $('#vemail').val(response.admin.email);
                break;

            default:
                console.log(response['message']);
                break;
        }

        // $('#vlga').val(response['message'].name); // use case to distiguish between what was clicked and display the need values
    });

    // let statename = e.target.parentElement.parentElement.parentElement.childNodes[1].textContent;
});

$(document).on('click', '.deletemodal', function(e){
    e.preventDefault();
    $('#deletemodal').modal('show');
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

$(document).on('click', '#modal-save-party', function(e){
    e.preventDefault();

    $.ajax({
        method: 'POST',
        url: urlAddParty,
        data: {
            acronym: $('#acronym').val(),
            name: $('#name').val(),
            desc: $('#desc').val(),
             _token: token
            }
    }).done(function(response){
        $('#new-modal').modal('hide');

        $('body').removeClass('modal-open');
        $(".modal-backdrop").remove();
        getpage('addparty');
        console.log(response['message']);
        //remember to display the success notification using toast
    });
});

$(document).on('click', '#modal-save-office', function(e){
    e.preventDefault();
    $.ajax({
        method: 'POST',
        url: urlAddOffice,
        data: {
            name: $('#name').val(),
            consti: $('#consti').val(),
            state: $('#state').val(),
            _token: token,
            }
    }).done(function(response){
        $('#new-modal').modal('hide');

        $('body').removeClass('modal-open');
        $(".modal-backdrop").remove();
        getpage('addoffice');
        console.log(response['message']);
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
