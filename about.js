window.addEventListener('load', () => {
    document.querySelector('#aboutCard')?.classList.add('show');
    document.querySelector('.section-title')?.classList.add('show');
    document.querySelectorAll('.card').forEach(card => {
        card.classList.add('show');
    });
});
