/*!
    * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2022 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

$(document).ready(function() {
    $('#tableCondidats').DataTable( {
        "language": {
            "lengthMenu": "Affichage _MENU_ enregistrements par page",
            "zeroRecords": "Rien trouvé - désolé",
            "info": "Affichage la page _PAGE_ sur _PAGES_",
            "infoEmpty": "Aucun enregistrement disponible",
            "search": "Chercher",
            "infoFiltered": "(filtré de _MAX_ total d'enregistrements)"
        }
    } );
} );
