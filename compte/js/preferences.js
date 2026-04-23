function validateForm() {
    let isValid = true;
    const selects = document.querySelectorAll('select');
    let notified = false;
    selects.forEach(function (select) {
        if (select.value === "" && !notified) {
            isValid = false;
            notified = true;
            alert("Veuillez sélectionner une option pour toutes les préférences.");
        }
    });
    return isValid;
}