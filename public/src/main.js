//global variables for diff functions
var delid;
var deletes = '#modal-delete-party, #modal-delete-admin, #modal-delete-office, #modal-delete-state, #modal-delete-lga, #modal-delete-constituency';
var views = '#modal-edit-state, #modal-edit-lga, #modal-edit-party, #modal-edit-office, #modal-edit-constituency';
var editid;
var editidentifier;


$(document).on('change', '#consti, #state, #econsti, #estate', function() {
    if ($(this).is(':checked')) {
      $(this).attr('value', 1);
    } else {
      $(this).attr('value', 0);
    }
});

//toggling of sidebar
$(document).on('click', '.side-bar', function(){
    $('.side-bar').removeClass('active');
    $(this).toggleClass('active');
  });

$('.nav-link').on('click', function (e) {

    if (e.target.dataset['mycontent'] !== undefined && e.target.dataset['mycontent'] !== 'home') {
        e.preventDefault();
        let url = e.target.dataset['mycontent'];
        getpage(url);
        //remember to change the color of the sidebar
    }
});

$(document).on('click', '.mymodal', function(e){
    $('#new-modal').modal('show');
    // $('#new-modal').modal({keyboard: false, backdrop: 'static'});
});

$(document).on('click', '.viewmodal', function(e){
    //add more view modal ids here.
    let views = '#state-view-modal, #lga-view-modal, #party-view-modal, #office-view-modal, #admin-view-modal, #constituency-view-modal';

    e.preventDefault();
    $(views).modal('show');
    let identifier = $('.table').data('identifier');

    let id = e.target.parentNode.childNodes["0"].parentNode.parentElement.parentElement.dataset['id'];
    // console.log(id, identifier);
    $.ajax({
        method: 'POST',
        url: urlView,
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

            case 'constituency':
                $('#vconlgas').empty();
                $('#vconcount').empty();

                $('#vconname').val(response.constituency.name);
                $('#vconstate').val(response.constituency.state);
                $('#vconcount').append(response.constituency.lgas.length);
                let sortedlga = response.constituency.lgas;
                sortedlga = sortedlga.sort();

                sortedlga.forEach(lga => {
                    $('#vconlgas').append("<li class='list-group-item disabled'>"+lga+"</li>");
                });
                // console.log(response.constituency.name, response.constituency.lgas, response.constituency.state);

            default:
                console.log(response['message']);
                break;
        }
    });
    // let statename = e.target.parentElement.parentElement.parentElement.childNodes[1].textContent;
});

//Modal for Editing records
$(document).on('click', '.editmodal', function (e) {
    e.preventDefault();
    $('#edit-modal').modal('show');
    var id = e.target.parentNode.parentNode.parentNode.dataset['id'];
    let identifier = $('.table').data('identifier');

    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {
            id: id,
            identifier: identifier,
            update: 0,
            _token: token
        }
    }).done(function (response) {
        switch (identifier) {
            case 'state':
                $('#ename').val(response.state.name);
                break;

            case 'lga':
                $('#elga').val(response.lga.name);
                $('#estate').val(response.stateid);
                break;

            case 'party':
                $('#ename').val(response.party.name);
                $('#eacronym').val(response.party.acronym);
                $('#edesc').val(response.party.description);
                break;

            case 'office':
                $('#ename').val(response.office.name);
                $('#econsti').val(response.office.is_constituency);
                $('#estate').val(response.office.is_state);
                (response.office.is_constituency == 0) ? $('#econsti').attr('checked', false) : $('#econsti').attr('checked', true);
                (response.office.is_state == 0) ? $('#estate').attr('checked', false) : $('#estate').attr('checked', true);
                break;

            case 'constituency':
                $('#ename').val(response.constituency.name);
                $('#estate').val(response.constituency.stateid);
                // $('#elgas').val(response.constituency.lgasid);

                $.get (urlGetLgaById + '?state_id=' + response.constituency.stateid, function(data){
                    let lgaids = [];
                    $('#elgas').empty();

                    response.constituency.lgasid.forEach(lga => {
                        lgaids.push(lga.id);
                        $('#elgas').append("<option value='"+lga.id+"'>"+lga.name+"</option>");
                        $('#elgas').selectpicker('refresh');
                    });
                    $('#elgas').selectpicker('refresh');
                    $.each(data, function(index, lga){
                        $('#elgas').append("<option value='"+lga.id+"'>"+lga.name+"</option>");
                        $('#elgas').selectpicker('refresh');
                    });

                    $('#elgas').val(lgaids);
                    $('#elgas').selectpicker('refresh');
                });
                console.log(response.constituency.lgasid);
                break;

            default:
                break;
        }
    }
    );
    console.log(identifier, id);
    editid = id;
    editidentifier = identifier;
});


// Actual saving of the edited data
$(document).on('click', views, function (e) {
    e.preventDefault();
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: toBeParse(editidentifier)
    }).done(function (response) {
        $('#edit-modal').modal("hide");

        getpage('add' + editidentifier);
        console.log(response.message);
    });
});

// used to parse edited data to the actual ajax update request
function toBeParse(identifier){
    switch (identifier) {
        case 'state':
            return {
                id: editid,
                // dataType: 'json',
                identifier: identifier,
                update: 1,
                _token: token,
                name: $('#ename').val()
            };

        case 'lga':
            return {
                id: editid,
                identifier: identifier,
                _token: token,
                update: 1,
                name: $('#elga').val(),
                stateid: $('#estate').val()
            };

        case 'party':
            return {
                id: editid,
                identifier: identifier,
                update: 1,
                _token: token,
                name: $('#ename').val(),
                acronym: $('#eacronym').val(),
                desc: $('#edesc').val()
            };

        case 'office':
            return {
                id: editid,
                identifier: identifier,
                update: 1,
                _token: token,
                name: $('#ename').val(),
                is_state: $('#estate').val(),
                is_constituency: $('#econsti').val()
            };

        default:
            break;
    }
}


$(document).on('click', '#delete', function(e){
    e.preventDefault();
    $('#deletemodal').modal('show');
    delid = e.target.parentNode.parentNode.parentNode.dataset['id'];
});

//for deletion of entered data uses switch
$(document).on('click', deletes, function(e){
    e.preventDefault();
    let identifier = $('.table').data('identifier');

    console.log(identifier, delid);
    $.ajax({
        method: 'POST',
        url: urlDelete,
        data: {
            identifier: identifier,
            id: delid,
            _token: token
        }
    }).done(function(response){
        $('#deletemodal').modal('hide');
        $('body').removeClass('modal-open');
        $(".modal-backdrop").remove();
        getpage('add' + identifier);
        console.log(response.message);
        //try to make the response a notification!!!
    });
});

{
    $(document).on('click', '#modal-save-admin', function (e) {
        e.preventDefault();

        if ($('#cpassword').val() === $('#password').val()) {
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
            }).done(function (response) {
                console.log(response['message']);
                $('#new-modal').modal('hide');

                $('body').removeClass('modal-open');
                $(".modal-backdrop").remove();
                getpage('addadmin');
            });
        }
        else {
            console.log('check your password');
        }
    });

    $(document).on('click', '#modal-save-state', function (e) {
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: urlAddState,
            data: { state: $('#state').val(), _token: token }
        }).done(function (response) {
            $('#new-modal').modal('hide');

            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();
            getpage('addstate');
            //remember to display the success notification using toast
        });
    });

    $(document).on('click', '#modal-save-lga', function (e) {
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: urlAddLga,
            data: { lga: $('#lga').val(), state: $('#state').val(), _token: token }
        }).done(function (response) {
            $('#new-modal').modal('hide');

            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();
            getpage('addlga');
            //remember to display the success notification using toast
        });
    });

    $(document).on('click', '#modal-save-party', function (e) {
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
        }).done(function (response) {
            $('#new-modal').modal('hide');

            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();
            getpage('addparty');
            console.log(response['message']);
            //remember to display the success notification using toast
        });
    });

    $(document).on('click', '#modal-save-office', function (e) {
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
        }).done(function (response) {
            $('#new-modal').modal('hide');

            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();

            getpage('addoffice');
            console.log(response['message']);
            //remember to display the success notification using toast
        });
    });

    $(document).on('click', '#modal-save-constituency', function (e) {
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: urlAddConstituency,
            data: {
                name: $('#conname').val(),
                state_id: $('#constate').val(),
                lga_id: $('#conlgas').val(),
                _token: token
            }
        }).done(function (response) {
            $('#new-modal').modal('hide');

            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();

            getpage('addconstituency');
            //remember to display the success notification using toast
        });
    });
}

//this controls the multi-select for adding of constituency lgas
$(document).on('change', '#constate', function(e){
    var state_id = e.target.value;
    if(state_id){
        $.get (urlGetLgaById + '?state_id=' + state_id, function(data){
            $('#conlgas').empty();
            $('#conlgas').selectpicker('refresh');
            $.each(data, function(index, lga){
                $('#conlgas').append("<option value='"+lga.id+"'>"+lga.name+"</option>");
                $('#conlgas').selectpicker('refresh');
            });
        });
    }
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
