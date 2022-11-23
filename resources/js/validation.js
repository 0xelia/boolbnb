const imagesEl = document.getElementById('image')
if(imagesEl) {
    imagesEl.addEventListener('change', checkSize)
}

function checkSize() {
    const image_error = document.getElementById('image_error')    
    const submit = document.getElementById('submit')
    if(this.size > 2048) {
        submit.classList.toggle('pointer-events-none')
        image_error.classList.toggle('hidden')
    } else {
        submit.classList.toggle('pointer-events-none')
        image_error.classList.toggle('hidden')
    }
}