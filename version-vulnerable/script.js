document.addEventListener('DOMContentLoaded', function () {
    const sortie = document.getElementById('sortie-dom');
    if (!sortie) return;
    const fragment = window.location.hash.slice(1);
    let valeur;
    try {
        valeur = decodeURIComponent(fragment);
    } catch (erreur) {
        // Un fragment mal encodé ne doit pas empêcher le reste de la page de fonctionner.
        valeur = fragment;
    }
    sortie.innerHTML = valeur;
});
