// DevTalk site-wide behaviour. Lives in a file (not inline attributes) so the
// Content Security Policy can keep script-src 'self' without 'unsafe-inline'.
//
// Any element with data-confirm="..." asks for confirmation before its default
// action (following a link, submitting a form) goes ahead.
document.addEventListener('click', (event) => {
    const el = event.target.closest('[data-confirm]');
    if (el && !window.confirm(el.dataset.confirm)) {
        event.preventDefault();
    }
});
