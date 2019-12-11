//global variables for diff functions
var delid;
var deletes = '#modal-delete-party, #modal-delete-admin, #modal-delete-office, #modal-delete-state, #modal-delete-lga, #modal-delete-constituency, #modal-delete-voter, #modal-delete-candidate';
var views = '#modal-edit-state, #modal-edit-lga, #modal-edit-party, #modal-edit-office, #modal-edit-constituency, #modal-edit-admin, #modal-edit-voter';
var editid;
var msg;
var editidentifier;


$(document).on('change', '#consti, #state, #econsti, #estate', function () {
    if ($(this).is(':checked')) {
        $(this).attr('value', 1);
    } else {
        $(this).attr('value', 0);
    }
});

//toggling of sidebar
$(document).on('click', '.side-bar', function () {
    $('.side-bar').removeClass('active');
    $(this).toggleClass('active');
});

$('.nav-link').on('click', function (e) {

    if (e.target.dataset['mycontent'] !== undefined && e.target.dataset['mycontent'] !== 'home') {
        e.preventDefault();
        let url = e.target.dataset['mycontent'];
        getpage(url);
    }
});

$(document).on('click', '.mymodal', function (e) {
    $('#new-modal').modal('show');
    // $('#new-modal').modal({keyboard: false, backdrop: 'static'});
});

$(document).on('click', '.viewmodal', function (e) {
    //add more view modal ids here.
    let views = '#state-view-modal, #lga-view-modal, #party-view-modal, #office-view-modal, #admin-view-modal, #constituency-view-modal, #voter-view-modal';

    e.preventDefault();
    $(views).modal('show');
    let identifier = $('.table').data('identifier');

    let id = e.target.parentNode.childNodes["0"].parentNode.parentElement.parentElement.dataset['id'];
    // console.log(id, identifier);
    $.ajax({
        method: 'POST',
        url: urlView,
        data: { id: id, identifier: identifier, _token: token } //add an identifier here
    }).done(function (response) {
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
                if (response.office.state == 1) {
                    $('#vstate').attr('checked', true);
                } else {
                    $('#vstate').attr('checked', false);
                }
                if (response.office.consti == 1) {
                    $('#vconsti').attr('checked', true);
                } else {
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

            case 'voter':
                $('#vnin').val(response.voter.vin);
                $('#vfirstname').val(response.voter.first_name);
                $('#vmidname').val(response.voter.mid_name);
                $('#vlastname').val(response.voter.last_name);
                $('#vgender').val(response.voter.gender);
                $('#vdob').val(response.voter.DOB);
                $('#vphone').val(response.voter.phone);
                $('#vemail').val(response.voter.email);
                $('#vaddress').val(response.voter.address);
                $('#vstate').val(response.voter.state);
                $('#vlga').val(response.voter.lga);
                $('#vconsti').val(response.voter.consti);
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
                    $('#vconlgas').append("<li class='list-group-item disabled'>" + lga + "</li>");
                });
            // console.log(response.constituency.name, response.constituency.lgas, response.constituency.state);

            default:
                console.log(response.message);
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
            case 'admin':
                $('#efirstname').val(response.admin.first_name);
                $('#emiddlename').val(response.admin.mid_name);
                $('#elastname').val(response.admin.last_name);
                $('#egender').val(response.admin.gender);
                $('#edob').val(response.admin.DOB);
                $('#ephone').val(response.admin.phone);
                $('#eemail').val(response.admin.email);
                break;

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

            case 'voter':
                $('#enin').val(response.voter.vin);
                $('#efirstname').val(response.voter.first_name);
                $('#emidname').val(response.voter.mid_name);
                $('#elastname').val(response.voter.last_name);
                $('#egender').val(response.voter.gender);
                $('#edob').val(response.voter.DOB);
                $('#ephone').val(response.voter.phone);
                $('#eemail').val(response.voter.email);
                $('#eaddress').val(response.voter.address);
                $('#estate').val(response.voter.state_id);

                $.get(urlGetLgaByStateId + '?stateid=' + response.voter.state_id, function (data) {
                    $('#elgas').empty();

                    $.each(data, function (index, lga) {
                        $('#elgas').append("<option value='" + lga.id + "'>" + lga.name + "</option>");
                    });
                    $('#elgas').val(response.voter.lga_id);
                    $('#elgas').selectpicker('refresh');
                });
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

                $.get(urlGetLgaById + '?state_id=' + response.constituency.stateid, function (data) {
                    let lgaids = [];
                    $('#elgas').empty();

                    response.constituency.lgasid.forEach(lga => {
                        lgaids.push(lga.id);
                        $('#elgas').append("<option value='" + lga.id + "'>" + lga.name + "</option>");
                    });
                    $('#elgas').selectpicker('refresh');
                    $.each(data, function (index, lga) {
                        $('#elgas').append("<option value='" + lga.id + "'>" + lga.name + "</option>");
                    });

                    $('#elgas').val(lgaids);
                    $('#elgas').selectpicker('refresh');
                });

                //refresh the lga if state is changed
                $(document).on('change', '#estate', function () {
                    $('#elgas').val([]);
                    let state_id = $('#estate').val();

                    $.get(urlGetLgaById + '?state_id=' + state_id, function (data) {
                        $('#elgas').empty();
                        $.each(data, function (index, lga) {
                            $('#elgas').append("<option value='" + lga.id + "'>" + lga.name + "</option>");
                            $('#elgas').selectpicker('refresh');
                        });
                    });
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
        msg = response.message;
        console.log(msg);
        setTimeout(displayNotification, 500);
    });

});


// used to parse edited data to the actual ajax update request
function toBeParse(identifier) {
    switch (identifier) {
        case 'admin':
            return {
                id: editid,
                identifier: identifier,
                update: 1,
                _token: token,
                firstname: $('#efirstname').val(),
                middlename: $('#emiddlename').val(),
                lastname: $('#elastname').val(),
                gender: $('#egender').val(),
                dob: $('#edob').val(),
                phone: $('#ephone').val(),
                email: $('#eemail').val()
            };

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

        case 'voter':
            return {
                id: editid,
                identifier: identifier,
                _token: token,
                update: 1,
                nin: $('#enin').val(),
                firstname: $('#efirstname').val(),
                midname: $('#emidname').val(),
                lastname: $('#elastname').val(),
                phone: $('#ephone').val(),
                gender: $('#egender').val(),
                dob: $('#edob').val(),
                address: $('#eaddress').val(),
                lgaid: $('#elgas').val(),
                stateid: $('#estate').val(),
                email: $('#eemail').val()
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

        case 'constituency':
            return {
                id: editid,
                identifier: identifier,
                update: 1,
                _token: token,
                name: $('#ename').val(),
                stateid: $('#estate').val(),
                lgaids: $('#elgas').val(),
            };

        default:
            break;
    }
}


$(document).on('click', '#delete', function (e) {
    e.preventDefault();
    $('#deletemodal').modal('show');
    delid = e.target.parentNode.parentNode.parentNode.dataset['id'];
});

//for deletion of entered data uses switch
$(document).on('click', deletes, function (e) {
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
    }).done(function (response) {
        $('#deletemodal').modal('hide');
        $('body').removeClass('modal-open');
        $(".modal-backdrop").remove();

        msg = response.message;
        setTimeout(displayNotification, 500);

        getpage('add' + identifier);

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
            msg = 'Check your password!';
            setTimeout(displayNotification, 500);
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
            msg = response.message;
            setTimeout(displayNotification, 500);
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
            msg = response.message;
            setTimeout(displayNotification, 500);
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
            msg = response.message;
            setTimeout(displayNotification, 500);
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
            msg = response.message;
            setTimeout(displayNotification, 500);
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
            msg = response.message;
            setTimeout(displayNotification, 500);
        });
    });

    $(document).on('click', '#modal-save-voter', function (e) {
        e.preventDefault();

        if ($('#cpassword').val() === $('#password').val()) {
            $.ajax({
                method: 'POST',
                url: urlAddVoter,
                data: {
                    nin: $('#nin').val(),
                    email: $('#email').val(),
                    firstname: $('#firstname').val(),
                    midname: $('#midname').val(),
                    lastname: $('#lastname').val(),
                    gender: $('#gender').val(),
                    dob: $('#dob').val(),
                    phone: $('#phone').val(),
                    address: $('#address').val(),
                    stateid: $('#state').val(),
                    lgaid: $('#lga').val(),
                    password: $('#password').val(),
                    _token: token
                }
            }).done(function (response) {
                $('#new-modal').modal('hide');

                $('body').removeClass('modal-open');
                $(".modal-backdrop").remove();

                getpage('addvoter');
                msg = response.message;
                console.log(msg);
                setTimeout(displayNotification, 500);
            });
        }
        else {
            msg = 'Check your password!';
            setTimeout(displayNotification, 500);
            console.log('check your password');
        }
    });

    //Adding of new candidate method
    $(document).on('click', '#modal-save-candidate', function(e){
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: urlAddCandidate,
            data: {
                office: $('#office').val(),
                candidate: $('#candidate').val(),
                state: $('#state').val(),
                constituency: $('#constituency').val(),
                party: $('#party').val(),
                _token: token
            }
        }).done(function (response){
            $('#new-modal').modal('hide');

            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();

            getpage('addcandidate');
            msg = response.message;
            console.log(msg);
            setTimeout(displayNotification, 500);
        });
        console.log($('#office').val(), $('#candidate').val(), $('#state').val(), $('#constituency').val(), $('#party').val())
    });
}

{
    $(document).on('click', '#candidateSearch', function(e){
        console.log('yes');
    });

    //Credit from http://jsfiddle.net/zscQy/
    function sortTable(table, col, reverse) {
        var tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
            tr = Array.prototype.slice.call(tb.rows, 0), // put rows into array
            i;
        reverse = -((+reverse) || -1);
        tr = tr.sort(function (a, b) { // sort rows
            return reverse // `-1 *` if want opposite order
                * (a.cells[col].textContent.trim() // using `.textContent.trim()` for test
                    .localeCompare(b.cells[col].textContent.trim())
                   );
        });
        for(i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
    }

    function makeSortable(table) {
        var th = table.tHead, i;
        th && (th = th.rows[0]) && (th = th.cells);
        if (th) i = th.length;
        else return; // if no `<thead>` then do nothing
        while (--i >= 0) (function (i) {
            var dir = 1;
            th[i].addEventListener('click', function () {sortTable(table, i, (dir = 1 - dir))});
        }(i));
    }

    function makeAllSortable(parent) {
        parent = parent || document.body;
        var t = parent.getElementsByTagName('table'), i = t.length;
        while (--i >= 0) makeSortable(t[i]);
    }

    window.onload = function () {makeAllSortable();};
}

// candiate search control to hide the state and constituency Dropdowns
{
    $(document).on('change', '#search_office', function(e){
        let isconsti = $(this).find(':selected').data('isconsti');
        let isstate = $(this).find(':selected').data('isstate');

        if(isstate === 0 && isconsti === 0){
            $('#search_consti').hide();
            $('#search_state').hide();
        }

        if(isstate === 1 && isconsti === 0){
            $('#search_consti').hide();
            $('#search_state').show();
        }

        if(isstate === 0 && isconsti === 1){
            $('#search_consti').show();
            $('#search_state').show();
        }
    });
}

//for controlling the multiple voters for a particular party in a particular office
{
    $(document).on('change', '#office', function(e){
        let isconsti = $(this).find(':selected').data('isconsti');
        let isstate = $(this).find(':selected').data('isstate');

        if(isstate === 0 && isconsti === 0)  //for president 00
        {
            $('#stateholder').hide();
            $('#constituencyholder').hide();

            $.get(getAvailbleParty00 + '?office_id=' + $('#office').val(), function(data) {
                $('#party').empty();
                $('#party').selectpicker('refresh');
                $.each(data, function (index, party){
                    $('#party').append(`<option value="${party.id}"> ${party.acronym} - ${party.name} </option>`);
                    $('#party').selectpicker('refresh');
                });
            });
        }

        if(isstate === 1 && isconsti === 0) //for governors 10
        {
            $('#stateholder').show();
            $('#constituencyholder').hide();

            $(document).on('change', '#state', function(e){
                $.get(getAvailbleParty10 + '?state_id=' + $('#state').val() + '&' + 'office_id=' + $('#office').val(), function(data){
                    $('#party').empty();
                    $('#party').selectpicker('refresh');
                    $.each(data, function (index, party){
                        $('#party').append(`<option value="${party.id}"> ${party.acronym} - ${party.name} </option>`);
                        $('#party').selectpicker('refresh');
                    });
                });
            });
        }

        if(isstate === 0 && isconsti === 1) // for senators 01
        {
            $('#stateholder').show();
            $('#constituencyholder').show();

            $(document).on('change', '#constituency', function(e){
                $.get(getAvailbleParty01 + '?state_id=' + $('#state').val() + '&' + 'office_id=' + $('#office').val() + '&' + 'consti_id' + $('#constituency').val(), function(data){
                    $('#party').empty();
                    $('#party').selectpicker('refresh');
                    $.each(data, function (index, party){
                        $('#party').append(`<option value="${party.id}"> ${party.acronym} - ${party.name} </option>`);
                        $('#party').selectpicker('refresh');
                    });
                });
            });
        }
    });
}

//Display of Notifications
function displayNotification() {
    $('.lead').text(msg);
    $('#toast').toast('show');
}

//this controls the multi-select for adding of constituency lgas
$(document).on('change', '#constate', function (e) {
    var state_id = e.target.value;
    if (state_id) {
        $.get(urlGetLgaById + '?state_id=' + state_id, function (data) {
            $('#conlgas').empty();
            $('#conlgas').selectpicker('refresh');
            $.each(data, function (index, lga) {
                $('#conlgas').append("<option value='" + lga.id + "'>" + lga.name + "</option>");
                $('#conlgas').selectpicker('refresh');
            });
        });
    }
});

// populates the lga dropdowns after state is picked for both new and edits
$(document).on('change', '#state, #estate', function (e) {
    var state_id = e.target.value;
    if (state_id) {
        $.get(urlGetLgaByStateId + '?stateid=' + state_id, function (data) {
            $('#lga, #elgas').empty();
            $('#lga, #elgas').selectpicker('refresh');
            $.each(data, function (index, lga) {
                $('#lga, #elgas').append("<option value='" + lga.id + "'>" + lga.name + "</option>");
                $('#lga, #elgas').selectpicker('refresh');
            });
        });
    }
});

//populates constituency when the state is picked
$(document).on('change', '#state', function (e) {
    state_id = e.target.value;
    if(state_id){
        $.get(urlGetConstiByStateId + '?state_id=' + state_id, function (data) {
            $('#constituency').empty();
            $('#constituency').selectpicker('refresh');
            $.each(data, function(index, consti){
                $('#constituency').append("<option value='" + consti.id + "'>" + consti.name + "</option>");
                $('#constituency').selectpicker('refresh');
            });
        });
    }
});

function getpage(pagename) {
    $.ajax({
        method: 'POST',
        url: 'getdashdisplay',
        data: { display: pagename, _token: token }
    }).done(function (page) {
        $('#mycontainer').html(page);
    });
}
