const imageEl = document.getElementById('image');
const imagesEl = document.getElementById('images');
const buttonEl = document.getElementById('submit');

const titleWrapper = document.querySelector('.title-wrapper');
const titleInput = document.getElementById('title');
const titleError = document.querySelector('.title-error');

const roomsWrapper = document.querySelector('.rooms-wrapper');
const roomsInput = document.getElementById('rooms');
const roomsError = document.querySelector('.rooms-error');

const bedsWrapper = document.querySelector('.beds-wrapper');
const bedsInput = document.getElementById('beds');
const bedsError = document.querySelector('.beds-error');

const bathsWrapper = document.querySelector('.baths-wrapper');
const bathsInput = document.getElementById('baths');
const bathsError = document.querySelector('.baths-error');

const metersWrapper = document.querySelector('.meters-wrapper');
const metersInput = document.getElementById('meters');
const metersError = document.querySelector('.meters-error');

const addressWrapper = document.querySelector('.address-wrapper');
const addressInput = document.querySelector('.tt-search-box-input');
const addressError = document.querySelector('.address-error');

const priceWrapper = document.querySelector('.price-wrapper');
const priceInput = document.getElementById('price');
const priceError = document.querySelector('.price-error');

const visibilityWrapper = document.querySelector('.visibility-wrapper');
const visibilityError = document.querySelector('.visibility-error');

if(titleInput) {
    titleInput.addEventListener('focusout', (event) => {
        if (!titleInput.validity.valid) {
            titleError.textContent = 'Il titolo deve avere massimo 255 caratteri';
            titleWrapper.classList.add('text-red-700');
            titleInput.classList.add('border-red-700', 'border-2');
        }
        else {
            titleError.textContent = '';
            titleWrapper.classList.remove('text-red-700');
            titleInput.classList.remove('border-red-700', 'border-2');
        }
    });
}

if(roomsInput) {
    roomsInput.addEventListener('focusout', (event) => {
        if (!roomsInput.validity.valid) {
            roomsError.textContent = 'Inserisci un numero valido';
            roomsWrapper.classList.add('text-red-700');
            roomsInput.classList.add('border-red-700', 'border-2');
        }
        else {
            roomsError.textContent = '';
            roomsWrapper.classList.remove('text-red-700');
            roomsInput.classList.remove('border-red-700', 'border-2');
        }
    });
}

if(bedsInput) {
    bedsInput.addEventListener('focusout', (event) => {
        if (!bedsInput.validity.valid) {
            bedsError.textContent = 'Inserisci un numero valido';
            bedsWrapper.classList.add('text-red-700');
            bedsInput.classList.add('border-red-700', 'border-2');
        }
        else {
            bedsError.textContent = '';
            bedsWrapper.classList.remove('text-red-700');
            bedsInput.classList.remove('border-red-700', 'border-2');
        }
    });
}

if(bathsInput) {
    bathsInput.addEventListener('focusout', (event) => {
        if (!bathsInput.validity.valid) {
            bathsError.textContent = 'Inserisci un numero valido';
            bathsWrapper.classList.add('text-red-700');
            bathsInput.classList.add('border-red-700', 'border-2');
        }
        else {
            bathsError.textContent = '';
            bathsWrapper.classList.remove('text-red-700');
            bathsInput.classList.remove('border-red-700', 'border-2');
        }
    });
}

if(metersInput) {
    metersInput.addEventListener('focusout', (event) => {
        if (!metersInput.validity.valid) {
            metersError.textContent = 'Inserisci un numero valido';
            metersWrapper.classList.add('text-red-700');
            metersInput.classList.add('border-red-700', 'border-2');
        }
        else {
            metersError.textContent = '';
            metersWrapper.classList.remove('text-red-700');
            metersInput.classList.remove('border-red-700', 'border-2');
        }
    });
}

if(addressInput) {
    addressInput.addEventListener('focusout', (event) => {
        if (!addressInput.value) {
            addressError.textContent = 'Inserisci un indirizzo valido';
            addressWrapper.classList.add('text-red-700');
            addressInput.classList.add('border-red-700', 'border-2');
        }
        else {
            addressError.textContent = '';
            addressWrapper.classList.remove('text-red-700');
            addressInput.classList.remove('border-red-700', 'border-2');
        }
    });
}

if(priceInput) {
    priceInput.addEventListener('focusout', (event) => {
        if (!metersInput.validity.valid) {
            priceError.textContent = 'Inserisci un numero valido';
            priceWrapper.classList.add('text-red-700');
            priceInput.classList.add('border-red-700', 'border-2');
        }
        else {
            priceError.textContent = '';
            priceWrapper.classList.remove('text-red-700');
            priceInput.classList.remove('border-red-700', 'border-2');
        }
    });
}

// titleWrapper.addEventListener('focusout', formValidation, error='title-error', message='Inserisci un titolo compreso tra 5 e 255 caratteri');
// roomsWrapper.addEventListener('focusout', formValidation, error='rooms-error', message='Inserisci un numero da 1 a 255');
// bedsWrapper.addEventListener('focusout', formValidation, error='beds-error', message='Inserisci un numero tra 1 e 255');
// bathsWrapper.addEventListener('focusout', formValidation, error='baths-error', message='Inserisci un numero tra 0 e 255');
// metersWrapper.addEventListener('focusout', formValidation, error='meters-error', message='Inserisci un numero tra 0 e 65535');

// function formValidation(event) {
//     const wrapperEl = this;
//     const inputEl = event.target;
//     const errorEl = wrapperEl.querySelector('.' + error);

//     console.log(wrapperEl);
//     console.log(inputEl);
//     console.log(errorEl);

//     if (!inputEl.validity.valid) {
//         errorEl.textContent = message;
//         wrapperEl.classList.add('text-red-700');
//         inputEl.classList.add('border-red-700', 'border-2');
//     }
//     else {
//         errorEl.textContent = '';
//         wrapperEl.classList.remove('text-red-700');
//         inputEl.classList.remove('border-red-700', 'border-2');
//     }
// }

if(imageEl) {
    imageEl.addEventListener('change', checkSize)
}

function checkSize() {
    const id = this.id.concat('_error')
    const image_error = document.getElementById(id)    
    const files = [...this.files];
    files.every(image => {
        if(image.size > 2097152) {
            image_error.classList.remove('hidden')
            return false
        } else {
            image_error.classList.add('hidden')
        }
    });
}

if(imagesEl) {
    imagesEl.addEventListener('change', checkSize)
}

// buttonEl.addEventListener('click', function (event) {
//     if (
//         titleInput.value && 
//         roomsInput.value && 
//         bedsInput.value &&
//         bathsInput.value &&
//         metersInput.value &&
//         addressInput.value &&
//         priceInput.value
//     ) {
//         buttonEl.setAttribute('type', 'submit');
//     }

// })
