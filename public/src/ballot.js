// $(document).on('click', '.test', function(e){
//     console.log('yes');
// });


$('.test').on('click', function (e) {
    e.preventDefault();

    console.log(e.target.innerHTML, e.target.dataset['office_id']);
    $('#test2').text(e.target.innerHTML);

    let office_id = e.target.dataset['office_id'];
    $.ajax({
        method: 'GET',
        url: 'http://127.0.0.1/voting/public/ballot/getOfficebyId',
        data: { office_id: office_id, _token: token }
    }).done(function(response) {
        console.log(response);
        $('.ballotbox').html(JSON.stringify(response));
    });

});


