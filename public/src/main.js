$('.nav-item').on('click', function (e) {
    e.preventDefault();
    console.log(e.target.parentNode.dataset['mycontent']);
    console.log(e);
})