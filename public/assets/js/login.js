toastr.options = {
    closeButton: true, // Afficher un bouton de fermeture sur les toasts
    progressBar: true, // Afficher une barre de progression pour le temps de disparition
    //positionClass: 'toast-top-right', // Position du toast (ex. en haut à droite)
    showDuration: 300, // Durée d'affichage du toast en millisecondes
    hideDuration: 1000, // Durée de disparition du toast en millisecondes
    timeOut: 3000, // Délai avant que le toast ne disparaisse en millisecondes
    extendedTimeOut: 1000, // Délai supplémentaire si l'utilisateur survole le toast
    tapToDismiss: false, // Permettre de cliquer sur le toast pour le faire disparaître
    preventDuplicates: true, // Empêcher l'affichage de toasts identiques
    newestOnTop: false, // Afficher les nouveaux toasts en haut (sinon, en bas)
    showEasing: 'swing', // Effet d'affichage (ex. 'linear', 'swing', 'bounceOut')
    hideEasing: 'linear', // Effet de disparition
    showMethod: 'fadeIn', // Méthode d'affichage (ex. 'fadeIn', 'slideDown')
    hideMethod: 'fadeOut' // Méthode de disparition (ex. 'fadeOut', 'slideUp')
};


document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const url = loginForm.getAttribute('action');
            const login = document.getElementById('login').value;
            const password = document.getElementById('password').value;

            if (login && password) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `login=${login}&password=${password}`,
                })
                .then(response => response.text())
                .then(responseText => {
                    if (responseText === 'true') {
                      
                       
                        toastr.success("Authentification réussie", 'Succès');
                        
                        setTimeout(function () {
                            window.location.assign("home");
                        }, 3000);
                       
                    } else if (responseText === "Votre mot de passe est incorrect") {
                       
                       
                        toastr.error("Votre mot de passe est incorrect", 'Oups!');
                    } else if (responseText === "Votre compte est bloqué, veuillez contacter l'administrateur") {
                     
                       
                        toastr.error("Votre compte est bloqué, veuillez contacter l'administrateur", 'Oups!');
                    } else if (responseText === "Aucun administrateur n'est attaché à ce login") {
                    
                        
                        toastr.error("Aucun administrateur n'est attaché à ce login", 'Oups!');
                    } else {
                       
                        toastr.error(  "Une erreur inattendue s'est produite", 'Oups!');
                          
                    }
                })
                .catch(error => {
                  
                    console.error(error);
                   
                });
                   
            } else {
                toastr.error( 'Veuillez remplir correctement tous les champs requis', 'Oups!');
               
            }
        });
    }
});
