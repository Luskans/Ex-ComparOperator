const inputName = document.querySelector('#inputName');
const inputScore = document.querySelector('.score__name');

inputName.addEventListener('input', () => {
    let value = inputName.value;
    inputScore.value = value;
})

