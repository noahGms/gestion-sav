require('./bootstrap');

document.addEventListener('DOMContentLoaded', function () {
    const collapseEl = document.getElementById('settings-collapse');
    const location = window.location.toString();

    if (location.includes("settings/")) {
        collapseEl.classList.add('show');
    } else {
        collapseEl.classList.remove('show');
    }

    const collapseLink = document.getElementsByClassName('collapse-link');

    for (const link of collapseLink) {
        if (link.textContent === 'Utilisateurs' && location.includes('/users')) {
            link.classList.add('active-class');
        } else if (link.textContent === 'Etats' && location.includes('/states')) {
            link.classList.add('active-class');
        } else if (link.textContent === 'Marques' && location.includes('/brands')) {
            link.classList.add('active-class');
        } else if (link.textContent === 'Catégories' && location.includes('/categories')) {
            link.classList.add('active-class');
        } else if (link.textContent === 'Types' && location.includes('/types')) {
            link.classList.add('active-class');
        } else if (link.textContent === 'Retours' && location.includes('/returns')) {
            link.classList.add('active-class');
        } else if (link.textContent === 'Interventions' && location.includes('/interventions')) {
            link.classList.add('active-class');
        } else if (link.textContent === 'Depots' && location.includes('/depots')) {
            link.classList.add('active-class');
        }
    }
});
