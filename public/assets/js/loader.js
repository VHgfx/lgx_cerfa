window.onbeforeunload = function() {
    window.scrollTo(0, 0);
};


// Récupérez la référence du conteneur de la barre latérale
const sidebarContainer = document.querySelector('.sidebar-container');

// Masquez la barre latérale lors du chargement initial
sidebarContainer.style.display = 'none';

// Attendez que la page soit entièrement chargée
window.addEventListener('load', () => {
    // Une fois que la page est prête, réaffichez la barre latérale
    sidebarContainer.style.display = 'block';
});


// Attendez que le document soit prêt
$(document).ready(function() {
    console.log('voilak');
    // Gérez le clic sur les liens avec la classe 'update-session'
   
});


function ok(link){
    var page = link.getAttribute('data-page');
    

        // Effectuez une requête AJAX pour mettre à jour la session
        $.ajax({
            url: 'session', // Remplacez par le chemin de votre script PHP
            method: 'POST',
            data: { page: page }, // Envoyez la page au script PHP
            success: function(response) {
                // La session a été mise à jour avec succès
                console.log(response+'Session mise à jour avec succès.');
            },
            error: function(error) {
                // Gérez les erreurs
                console.error(error+'Erreur lors de la mise à jour de la session:', error);
            }
        });
}