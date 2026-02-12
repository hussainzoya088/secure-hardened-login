
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', (e) => {
        const password = form.querySelector('input[type="password"]');
        if (password && password.value.length < 12) {
            alert("Security Notice: Password must be 12+ characters.");
            e.preventDefault();         }
    });
});