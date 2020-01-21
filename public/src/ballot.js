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
        console.log(response);

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
        console.log(response);
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
        console.log(response);
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


$(document).on('click', '.flip-card-inner', function(e){
    e.preventDefault();
    console.log(e);
    $('#confirmVote-modal').modal('show');
    let pacr = $(this).find('p')[0].textContent;
    console.log(pacr);
    $('#mpartyacr').text(pacr);

    let candidate_id = $(this).find('p')[0].dataset['candidate_id'];
    let party_id = $(this).find('p')[0].dataset['party_id'];
    let office_id = $(this).find('p')[0].dataset['office_id'];
    console.log(candidate_id, party_id, office_id)

});
