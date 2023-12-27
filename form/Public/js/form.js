function sendData() {
    buttoncircle();
    var nomA = document.getElementById("nomA").value;
    var nomuA = document.getElementById("nomuA").value;
    var prenomA = document.getElementById("prenomA").value;
    var sexeA = document.getElementById("sexeA").value;
    var naissanceA = document.getElementById("naissanceA").value;
    var departementA = document.getElementById("departementA").value;
    var communeNA = document.getElementById("communeNA").value;
    var nationaliteA = document.getElementById("nationaliteA").value;
    var regimeA = document.getElementById("regimeA").value;
    var situationA = document.getElementById("situationA").value;
    var titrePA = document.getElementById("titrePA").value;
    var derniereCA = document.getElementById("derniereCA").value;
    var securiteA = document.getElementById("securiteA").value;
    var intituleA = document.getElementById("intituleA").value;
    var titreOA = document.getElementById("titreOA").value;
    var declareSA = document.getElementById("declareSA").value;
    var declareHA = document.getElementById("declareHA").value;
    var declareRA = document.getElementById("declareRA").value;
    var rueA = document.getElementById("rueA").value;
    var voieA = document.getElementById("voieA").value;
    var complementA = document.getElementById("complementA").value;
    var postalA = document.getElementById("postalA").value;
    var communeA = document.getElementById("communeA").value;
    var numeroA = document.getElementById("numeroA").value;
    var nomR = document.getElementById("nomR").value;
    var emailR = document.getElementById("emailR").value;
    var rueR = document.getElementById("rueR").value;
    var voieR = document.getElementById("voieR").value;
    var complementR = document.getElementById("complementR").value;
    var postalR = document.getElementById("postalR").value;
    var communeR = document.getElementById("communeR").value;

    if (
      nomA !== "" &&
      prenomA !== "" &&
      sexeA !== "" &&
      naissanceA !== "" &&
      departementA !== "" &&
      communeNA !== "" &&
      nationaliteA !== "" &&
      regimeA !== "" &&
      situationA !== "" &&
      titrePA !== "" &&
      derniereCA !== "" &&
      securiteA !== "" &&
      intituleA !== "" &&
      titreOA !== "" &&
      declareSA !== "" &&
      declareHA !== "" &&
      declareRA !== "" &&
      rueA !== "" &&
      voieA !== "" &&
      postalA !== "" &&
      communeA !== "" &&
      numeroA !== "" 
    
    ) {
      var url = 'form'; // L'URL à laquelle vous souhaitez envoyer les données
      var data = new URLSearchParams();

      // Ajoutez tous les champs de formulaire aux données
      data.append('nomA', nomA);
      data.append('nomuA', nomuA);
      data.append('prenomA', prenomA);
      data.append('sexeA', sexeA);
      data.append('naissanceA', naissanceA);
      data.append('departementA', departementA);
      data.append('communeNA', communeNA);
      data.append('nationaliteA', nationaliteA);
      data.append('regimeA', regimeA);
      data.append('situationA', situationA);
      data.append('titrePA', titrePA);
      data.append('derniereCA', derniereCA);
      data.append('securiteA', securiteA);
      data.append('intituleA', intituleA);
      data.append('titreOA', titreOA);
      data.append('declareSA', declareSA);
      data.append('declareHA', declareHA);
      data.append('declareRA', declareRA);
      data.append('rueA', rueA);
      data.append('voieA', voieA);
      data.append('complementA', complementA);
      data.append('postalA', postalA);
      data.append('communeA', communeA);
      data.append('numeroA', numeroA);
      data.append('nomR', nomR);
      data.append('emailR', emailR);
      data.append('rueR', rueR);
      data.append('voieR', voieR);
      data.append('complementR', complementR);
      data.append('postalR', postalR);
      data.append('communeR', communeR);

      // Envoi de la requête POST
      fetch(url, {
        method: 'POST',
        body: data,
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
        .then(response => response.text())
        .then(response => {
          if (response.indexOf("succès") !== -1) {
          
            toastr.options.timeOut = 2000;
            toastr.error("Une erreur s'est produite lors de l'envoi des données. Veuillez réessayer à partir du lien reçu par mail.", "Erreur", { "iconClass": 'customer-error' });
          } else {

            toastr.options.timeOut = 2000;
            toastr.success("Le formulaire a été soumis avec succès.", "Succès", { "iconClass": 'customer-success' });
            toastr.info("Merci pour votre collaboration. Nous reviendrons vers vous au plus vite", "Formulaire soumis avec succès", { "iconClass": 'customer-authentification' });
            setTimeout(redirection, 2000);
            document.getElementById("myForm").reset();
           
           
          }
        })
        .catch(error => {
          toastr.options.timeOut = 1500;
          toastr.error(error+"Une erreur s'est produite lors de la soumission du formulaire.", "Erreur", { "iconClass": 'customer-error' });
        });
    } else {
      toastr.options.timeOut = 1500;
      toastr.error("Veuillez remplir correctement tous les champs", "Erreur", { "iconClass": 'customer-error' });
    }
    return false; // Empêche le formulaire de se soumettre normalement
  }



  
function redirection(){
    window.location.replace('home');
    }
    
    
    
    function buttoncircle(){
    document.getElementById("circle").innerHTML='<i class="fa fa-refresh fa-spin"></i>';
    setTimeout(buttonredirection, 1500);
    }
    
    function buttonredirection(){
    document.getElementById("circle").innerHTML="Envoyer";
    }
