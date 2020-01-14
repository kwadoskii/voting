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

        let candidates = response.reduce((acc, { id, first_name, last_name, acronym }) => acc +=
        `<div class='col-md-4 mb-3'>
            <div class='flip-card'>
                <div class='flip-card-inner'>
                    <div class="flip-card-front">
                        <p class="party" data-party_id ='' data-candidate_id = '${id}'>${acronym}</p>
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
        let candidates = response.reduce((acc, { id, first_name, last_name, acronym }) => acc +=
        `<div class='col-md-4 mb-3'>
            <div class='flip-card'>
                <div class='flip-card-inner'>
                    <div class="flip-card-front">
                        <p class="party" data-party_id ='' data-candidate_id = '${id}'>${acronym}</p>
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
    let consti_id = e.target.dataset['consti_id'];

    $.ajax({
        method: 'GET',
        url: getStateOfficebyId,
        data: { office_id: office_id, state_id: state_id, consti_id: consti_id, _token: token }
    }).done(function (response) {
        console.log(response);
        let candidates = response.reduce((acc, { id, first_name, last_name, acronym }) => acc +=
        `<div class='col-md-4 mb-3'>
            <div class='flip-card'>
                <div class='flip-card-inner'>
                    <div class="flip-card-front">
                        <p class="party" data-party_id ='' data-candidate_id = '${id}'>${acronym}</p>
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

// "<div class='col-md-4 mb-3'>" +
//     "<div class='flip-card'>" +
//     "<div class='flip-card-inner'>" +
//     "<div class='flip-card-front'>" +
//     "<p class='party'>kowa</p>" +
//     "</div>" +
//     "<div class='flip-card-back'>" +
//     "<h1>Goodluck Jonathan</h1>" +
//     "</div></div></div></div>");
