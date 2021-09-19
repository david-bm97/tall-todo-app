import Toastify from 'toastify-js'

window.addEventListener('show-toast', event => {
    console.log('Show: ' + event.detail.text);
    Toastify({
        text: event.detail.text,
        duration: 3000,
        position: 'right',
        gravity: 'bottom'
    }).showToast();
})
