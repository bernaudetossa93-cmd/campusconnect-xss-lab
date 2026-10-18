document.addEventListener('DOMContentLoaded', function () {
    const sortie = document.getElementById('sortie-dom');
    if (!sortie) return;
    const valeur = decodeURIComponent(window.location.hash.slice(1));
    sortie.textContent = valeur;
});
