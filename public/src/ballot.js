$('.genElec').on('click', function (e) {
    e.preventDefault();

    // console.log(e.target.innerHTML, e.target.dataset['office_id']);
    $('#ballotheader').text(e.target.innerHTML);

    let office_id = e.target.dataset['office_id'];
    $.ajax({
        method: 'GET',
        url: getOfficebyId,
        data: { office_id: office_id, _token: token }
    }).done(function (response) {
        // console.log(response);

        let candidates = response.reduce((acc, { id, partyid, first_name, last_name, acronym }) => acc +=
        `<div class='col-md-4 mb-3'>
            <div class='flip-card'>
                <div class='flip-card-inner'>
                    <div class="flip-card-front">
                        <p class="party" data-party_id ='${partyid}' data-candidate_id = '${id}' data-office_id = ${office_id}>${acronym}</p>
                    </div>
                    <div class="flip-card-back">
                        <h1>${first_name} ${last_name}</h1>
                    </div>
                </div>
            </div>
        </div>`, ``);

        $('.ballotbox').html(candidates);
    });
});


$('.stateElec').on('click', function (e) {
    e.preventDefault();
    $('#ballotheader').text(e.target.innerHTML);
    let office_id = e.target.dataset['office_id'];
    let state_id = e.target.dataset['state_id'];

    $.ajax({
        method: 'GET',
        url: getStateOfficebyId,
        data: { office_id: office_id, state_id: state_id, _token: token }
    }).done(function (response) {
        //console.log(response);
        let candidates = response.reduce((acc, { id, partyid, first_name, last_name, acronym }) => acc +=
        `<div class='col-md-4 mb-3'>
            <div class='flip-card'>
                <div class='flip-card-inner'>
                    <div class="flip-card-front">
                        <p class="party" data-party_id ='${partyid}' data-candidate_id = '${id}' data-office_id = ${office_id}>${acronym}</p>
                    </div>
                    <div class="flip-card-back">
                        <h1>${first_name} ${last_name}</h1>
                    </div>
                </div>
            </div>
        </div>`, ``);

        $('.ballotbox').html(candidates);
    });
});

$('.constiElec').on('click', function (e) {
    e.preventDefault();
    $('#ballotheader').text(e.target.innerHTML);
    let office_id = e.target.dataset['office_id'];
    let state_id = e.target.dataset['state_id'];
    let lga_id = e.target.dataset['lga_id'];

    $.ajax({
        method: 'GET',
        url: getConstiOfficebyId,
        data: { office_id: office_id, state_id: state_id, lga_id: lga_id, _token: token }
    }).done(function (response) {
        //console.log(response);
        let candidates = response.reduce((acc, { id, partyid, first_name, last_name, acronym }) => acc +=
        `<div class='col-md-4 mb-3'>
            <div class='flip-card'>
                <div class='flip-card-inner'>
                    <div class="flip-card-front">
                        <p class="party" data-party_id ='${partyid}' data-candidate_id = '${id}' data-office_id = ${office_id}>${acronym}</p>
                    </div>
                    <div class="flip-card-back">
                        <h1>${first_name} ${last_name}</h1>
                    </div>
                </div>
            </div>
        </div>`, ``);

        $('.ballotbox').html(candidates);
    });
});

{
    var candidate_id, party_id, office_id;

    $(document).on('click', '.flip-card-inner', function (e) {
        e.preventDefault();
        // console.log(e);
        $('#confirmVote-modal').modal('show');
        let partyAcronym = $(this).find('p')[0].textContent;
        // console.log(partyAcronym);
        $('#mpartyacr').text(partyAcronym);

        candidate_id = $(this).find('p')[0].dataset['candidate_id'];
        party_id = $(this).find('p')[0].dataset['party_id'];
        office_id = $(this).find('p')[0].dataset['office_id'];

    });

    $(document).on('click', '#confirmVoteBtn', (e) => {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: vote,
            data: {
                candidate_id: candidate_id,
                party_id: party_id,
                office_id: office_id,
                _token: token
            }
        }).done(function(response){
            // console.log(response.message);
            // console.log(candidate_id, party_id, office_id);
            $('#confirmVote-modal').modal('hide');
            displayNotification(response.message);
        });
    });
}

//Display of Notifications
function displayNotification(msg) {
    $('.lead').text(msg);
    $('#toast').toast('show');
}
