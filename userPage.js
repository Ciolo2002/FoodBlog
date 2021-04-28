function onChange2() {
    const password = document.querySelector('#password2');
    const confirm = document.querySelector('#confirm_password2');
    if (confirm.value === password.value) {
        confirm.setCustomValidity('');
    } else {
        confirm.setCustomValidity('Passwords do not match');
    }
}