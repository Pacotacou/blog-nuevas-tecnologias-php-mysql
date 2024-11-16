document.addEventListener('DOMContentLoaded', function() {
    const messages = document.querySelectorAll('p');
    messages.forEach(message => {
        setTimeout(() => {
            message.style.display = 'none';
        }, 3000);
    });
});
