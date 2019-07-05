$('.nav-link').on('click', function (e) {

    if (e.target.dataset['mycontent'] !== undefined && e.target.dataset['mycontent'] !== 'home') {
        e.preventDefault();

        let url = e.target.dataset['mycontent'];
        console.log(url);
        $.ajax({
            method: 'POST',
            url: 'getdashdisplay',
            data: {display: url, _token: token}
        }).done(function (msg) {
            // e.target.classList.add('active');
            $('#mycontainer').html(msg);
            console.log(msg);
        });
    }
});