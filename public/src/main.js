$('.nav-item').on('click', function (e) {
    e.preventDefault();
    console.log(e.target.dataset['mycontent']);
    console.log(e);
});