const inputName = document.querySelector('#inputName');
const inputScore = document.querySelector('.score__name');
// console.log(inputName);
// console.log(inputScore);

inputName.addEventListener('input', () => {
    // console.log('hello');
    let value = inputName.value;
    inputScore.value = value;
})

