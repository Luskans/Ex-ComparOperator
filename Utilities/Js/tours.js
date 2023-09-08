const inputNames = document.querySelectorAll('#inputName');
const inputScores = document.querySelectorAll('.score__name');

for (let inputName of inputNames) {
    inputName.addEventListener('input', () => {
        let value = inputName.value;
        for (let inputScore of inputScores) {
            inputScore.value = value;
        }
    })
}

// inputNames.addEventListener('input', () => {
//     let value = inputNames.value;
//     inputScores.value = value;
// })

