const addDestinationAdmin = document.querySelector('#addDestinationAdmin');
const destinationsAdmin = document.querySelector('#destinationsAdmin');

let countDestination = 2;

addDestinationAdmin.addEventListener('click', ()=>{
    // the div
    let div = document.createElement('div');
    div.classList.add('d-flex', 'justify-content-center', 'gap-3', 'mb-3');


    // the input for destination name
    let input1 = document.createElement('input');
    input1.classList.add('form-control');
    input1.setAttribute('type', 'text');
    input1.setAttribute('name', 'destination' + countDestination);
    input1.setAttribute('placeholder', 'Destination ' + countDestination);
    input1.setAttribute('required', '');


    // the input for price of destination
    let input2 = document.createElement('input');
    input2.classList.add('form-control');
    input2.setAttribute('type', 'number');
    input2.setAttribute('name', 'price' + countDestination);
    input2.setAttribute('placeholder', 'Prix ' + countDestination);
    input2.setAttribute('required', '');

    div.appendChild(input1);
    div.appendChild(input2);

    destinationsAdmin.insertBefore(div, destinationsAdmin.childNodes[countDestination]);

    countDestination++;
})