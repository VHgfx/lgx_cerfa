
$(document).ready(function(){
    /**
     * Fonction qui ouvre la modal pour l'ajouter
     */
    $(document).on('click','#add',function(e){
        e.preventDefault();
        $('#introplus').text('AJOUTER UN Cerfa');
        $('#confirmplus').text('ENREGISTRER');
        $('#idemployeur').val('');
        $('#idformation').val('');
        $('#emailAA').val('');
        $('#new').modal();
    });



    $(document).on('submit', '#newForm1', function (e) {
        e.preventDefault();
        
        var $form = $(this),
            idemployeur = $('#idemployeur').val(),
            idformation = $('#idformation').val(),
            emailAA = $('#emailAA').val(),
            act = $('.newBtn').html(),
            url = $(this).attr('action');
     
        if (idemployeur!==''  ){
            if(emailAA ===''){
                toastr.error("Veuillez remplir l'email de l'apprenant ",'Oups!');
                return;
            }
           
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    idemployeur: idemployeur,
                    idformation: idformation,
                    emailAA: emailAA
                  }, 
                datatype: 'json',
                beforeSend: function () {
                   
                    $('.newBtn').html('<i class="fa fa-refresh fa-spin fa-2x"></i>').prop('disabled', true);
                },
                success: function (json) {
                  
                    if (json.statuts === 0){
                      
                        showAlert($form,1,json.mes);
                        toastr.success(json.mes,'Succès!');
                        window.location.reload();
                    } else {
                        toastr.error(json.mes,'Oups!');
                        showAlert($form,2,json.mes);
                    }
                },
                complete: function () {
                    $('.newBtn').html(act).prop('disabled', false);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR+ textStatus+ errorThrown);
                }
            });
        }else{
            toastr.error('Veuillez remplir correctement tous les champs requis','Oups!');
            showAlert($form,2,'Veuillez remplir correctement tous les champs requis');
        }

    });

    
    $(document).on('click','.edit',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var idemployeur = $(this).attr('data-idemployeur'); 
        var idformation = $(this).attr('data-idformation'); 
        
        var nomA = $(this).attr('data-nomA');
        var nomuA = $(this).attr('data-nomuA');
        var prenomA = $(this).attr('data-prenomA');
        var sexeA = $(this).attr('data-sexeA');
        var naissanceA = $(this).attr('data-naissanceA');
        var departementA = $(this).attr('data-departementA');
        var communeNA = $(this).attr('data-communeNA');
        var nationaliteA = $(this).attr('data-nationaliteA');
        var regimeA = $(this).attr('data-regimeA');
        var situationA = $(this).attr('data-situationA');
        var titrePA = $(this).attr('data-titrePA');
        var derniereCA = $(this).attr('data-derniereCA');
        var securiteA = $(this).attr('data-securiteA');
        var intituleA = $(this).attr('data-intituleA');
        var titreOA = $(this).attr('data-titreOA');
        var declareSA = $(this).attr('data-declareSA');
        var declareHA = $(this).attr('data-declareHA');
        var declareRA = $(this).attr('data-declareRA');
        var rueA = $(this).attr('data-rueA');
        var voieA = $(this).attr('data-voieA');
        var complementA = $(this).attr('data-complementA');
        var postalA = $(this).attr('data-postalA');
        var communeA = $(this).attr('data-communeA');
        var numeroA = $(this).attr('data-numeroA');
        var emailA = $(this).attr('data-emailA');


        var nomR = $(this).attr('data-nomR');
        var emailR = $(this).attr('data-emailR');
        var rueR = $(this).attr('data-rueR');
        var voieR = $(this).attr('data-voieR');
        var complementR = $(this).attr('data-complementR');
        var postalR = $(this).attr('data-postalR');
        var communeR = $(this).attr('data-communeR');


        var nomM = $(this).attr('data-nomM');
        var prenomM = $(this).attr('data-prenomM');
        var naissanceM = $(this).attr('data-naissanceM');
        var securiteM = $(this).attr('data-securiteM');
        var emailM = $(this).attr('data-emailM');
        var emploiM = $(this).attr('data-emploiM');
        var diplomeM = $(this).attr('data-diplomeM');
        var niveauM = $(this).attr('data-niveauM');


        var nomM1 = $(this).attr('data-nomM1');
        var prenomM1 = $(this).attr('data-prenomM1');
        var naissanceM1 = $(this).attr('data-naissanceM1');
        var securiteM1 = $(this).attr('data-securiteM1');
        var emailM1 = $(this).attr('data-emailM1');
        var emploiM1 = $(this).attr('data-emploiM1');
        var diplomeM1 = $(this).attr('data-diplomeM1');
        var niveauM1 = $(this).attr('data-niveauM1');
        
       
        
        
        
        var travailC = $(this).attr('data-travailC');
        var derogationC = $(this).attr('data-derogationC');
        var numeroC = $(this).attr('data-numeroC');
        var conclusionC = $(this).attr('data-conclusionC');
        var debutC = $(this).attr('data-debutC');
        var finC = $(this).attr('data-finC');
        var avenantC = $(this).attr('data-avenantC');
        var executionC = $(this).attr('data-executionC');
        var dureC = $(this).attr('data-dureC');
        var typeC = $(this).attr('data-typeC');
        var rdC = $(this).attr('data-rdC');
        var raC = $(this).attr('data-raC');
        var rpC = $(this).attr('data-rpC');
        var rsC = $(this).attr('data-rsC');

        var rdC1 = $(this).attr('data-rdC1');
        var raC1 = $(this).attr('data-raC1');
        var rpC1 = $(this).attr('data-rpC1');
        var rsC1 = $(this).attr('data-rsC1');

        var rdC2 = $(this).attr('data-rdC2');
        var raC2 = $(this).attr('data-raC2');
        var rpC2 = $(this).attr('data-rpC2');
        var rsC2 = $(this).attr('data-rsC2');

        var salaireC = $(this).attr('data-salaireC');
        var caisseC = $(this).attr('data-caisseC');
        var logementC = $(this).attr('data-logementC');
        var avantageC = $(this).attr('data-avantageC');
        var autreC = $(this).attr('data-autreC');

        
        var lieuO = $(this).attr('data-lieuO');
        var priveO = $(this).attr('data-priveO');
        var attesteO = $(this).attr('data-attesteO');
        
        
        $('#idElement').val(id);
        $('#idemployeurs').val(idemployeur);
        $('#idformations').val(idformation);
      
        $('#nomA').val(nomA);
        $('#nomuA').val(nomuA);
        $('#prenomA').val(prenomA);
        $('#sexeA').val(sexeA);
        $('#naissanceA').val(naissanceA);
        $('#departementA').val(departementA);
        $('#communeNA').val(communeNA);
        $('#nationaliteA').val(nationaliteA);
        $('#regimeA').val(regimeA);
        $('#situationA').val(situationA);
        $('#titrePA').val(titrePA);
        $('#derniereCA').val(derniereCA);
        $('#securiteA').val(securiteA);
        $('#intituleA').val(intituleA);
        $('#titreOA').val(titreOA);
        $('#declareSA').val(declareSA);
        $('#declareHA').val(declareHA);
        $('#declareRA').val(declareRA);
        $('#rueA').val(rueA);
        $('#voieA').val(voieA);
        $('#complementA').val(complementA);
        $('#postalA').val(postalA);
        $('#communeA').val(communeA);
        $('#numeroA').val(numeroA);
        $('#emailA').val(emailA);

        $('#nomR').val(nomR);
        $('#emailR').val(emailR);
        $('#rueR').val(rueR);
        $('#voieR').val(voieR);
        $('#complementR').val(complementR);
        $('#postalR').val(postalR);
        $('#communeR').val(communeR);



        $('#nomM').val(nomM);
        $('#prenomM').val(prenomM);
        $('#naissanceM').val(naissanceM);
        $('#securiteM').val(securiteM);
        $('#emailM').val(emailM);
        $('#emploiM').val(emploiM);
        $('#diplomeM').val(diplomeM);
        $('#niveauM').val(niveauM);


        $('#nomM1').val(nomM1);
        $('#prenomM1').val(prenomM1);
        $('#naissanceM1').val(naissanceM1);
        $('#securiteM1').val(securiteM1);
        $('#emailM1').val(emailM1);
        $('#emploiM1').val(emploiM1);
        $('#diplomeM1').val(diplomeM1);
        $('#niveauM1').val(niveauM1);




        $('#travailC').val(travailC);
        $('#derogationC').val(derogationC);
        $('#numeroC').val(numeroC);
        $('#conclusionC').val(conclusionC);
        $('#debutC').val(debutC);
        $('#finC').val(finC);
        $('#avenantC').val(avenantC);
        $('#executionC').val(executionC);
        $('#dureC').val(dureC);
        $('#typeC').val(typeC);
        $('#rdC').val(rdC);
        $('#raC').val(raC);
        $('#rpC').val(rpC);
        $('#rsC').val(rsC);
        $('#rdC1').val(rdC1);
        $('#raC1').val(raC1);
        $('#rpC1').val(rpC1);
        $('#rsC1').val(rsC1);

        $('#rdC2').val(rdC2);
        $('#raC2').val(raC2);
        $('#rpC2').val(rpC2);
        $('#rsC2').val(rsC2);

        $('#salaireC').val(salaireC);
        $('#caisseC').val(caisseC);
        $('#logementC').val(logementC);
        $('#avantageC').val(avantageC);
        $('#autreC').val(autreC);

        $('#lieuO').val(lieuO);
        $('#priveO').val(priveO);
        $('#attesteO').val(attesteO);

        
        $('#action').val('edit');
        $('#intro').text('MODIFIER UN Cerfa');
        $('#confirm').text('ENREGISTRER');
        $('#host').modal();
    });

    $(document).on('submit', '#newFrom', function (e) {
        e.preventDefault();
        
        var $form = $(this),
            id = $('#idElement').val(),

            idemployeur = $('#idemployeurs').val(),
            idformation = $('#idformations').val(),

            nomA = $('#nomA').val();
            nomuA = $('#nomuA').val();
            prenomA = $('#prenomA').val();
            sexeA = $('#sexeA').val();
            naissanceA = $('#naissanceA').val();
            departementA = $('#departementA').val();
            communeNA = $('#communeNA').val();
            nationaliteA = $('#nationaliteA').val();
            regimeA = $('#regimeA').val();
            situationA = $('#situationA').val();
            titrePA = $('#titrePA').val();
            derniereCA = $('#derniereCA').val();
            securiteA = $('#securiteA').val();
            intituleA = $('#intituleA').val();
            titreOA = $('#titreOA').val();
            declareSA = $('#declareSA').val();
            declareHA = $('#declareHA').val();
            declareRA = $('#declareRA').val();
            rueA =$('#rueA').val();
            voieA = $('#voieA').val();
            complementA = $('#complementA').val();
            postalA = $('#postalA').val();
            communeA = $('#communeA').val();
            numeroA = $('#numeroA').val();
            emailA = $('#emailA').val();


            nomR = $('#nomR').val();
            emailR = $('#emailR').val();
            rueR =$('#rueR').val();
            voieR = $('#voieR').val();
            complementR = $('#complementR').val();
            postalR = $('#postalR').val();
            communeR = $('#communeR').val();



            nomM = $('#nomM').val();
            prenomM = $('#prenomM').val();
            naissanceM = $('#naissanceM').val();
            securiteM = $('#securiteM').val();
            emailM = $('#emailM').val();
            emploiM = $('#emploiM').val();
            diplomeM = $('#diplomeM').val();
            niveauM = $('#niveauM').val();

            nomM1 = $('#nomM1').val();
            prenomM1 = $('#prenomM1').val();
            naissanceM1 = $('#naissanceM1').val();
            securiteM1 = $('#securiteM1').val();
            emailM1 = $('#emailM1').val();
            emploiM1 = $('#emploiM1').val();
            diplomeM1 = $('#diplomeM1').val();
            niveauM1 = $('#niveauM1').val();



            travailC=$('#travailC').val();
            derogationC=$('#derogationC').val();
            numeroC=$('#numeroC').val();
            conclusionC=$('#conclusionC').val();
            debutC=$('#debutC').val();
            finC=$('#finC').val();
            avenantC=$('#avenantC').val();
            executionC=$('#executionC').val();
            dureC=$('#dureC').val();
            typeC=$('#typeC').val();
            rdC=$('#rdC').val();
            raC=$('#raC').val();
            rpC=$('#rpC').val();
            rsC=$('#rsC').val();

            rdC1=$('#rdC1').val();
            raC1=$('#raC1').val();
            rpC1=$('#rpC1').val();
            rsC1=$('#rsC1').val();

            rdC2=$('#rdC2').val();
            raC2=$('#raC2').val();
            rpC2=$('#rpC2').val();
            rsC2=$('#rsC2').val();

            salaireC=$('#salaireC').val();
            caisseC=$('#caisseC').val();
            logementC=$('#logementC').val();
            avantageC=$('#avantageC').val();
            autreC=$('#autreC').val();

            lieuO = $('#lieuO').val();
            priveO = $('#priveO').val();
            attesteO = $('#attesteO').val();


            action = $('#action').val(),
            act = $('.newBtn').html(),
            url = $(this).attr('action');


            
            
        if (idemployeur!==''  ){

            if(emailA ===''){
                toastr.error("Veuillez remplir l'email de l'apprenant ",'Oups!');
                return;
            }

            if(isNaN(salaireC.trim())){
                toastr.error("Veuillez remplir correctement le champ salaire ",'Oups!');
                return;
            }
           
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    idemployeur:idemployeur,
                    idformation:idformation,  
                    nomA: nomA,
                    nomuA: nomuA,
                    prenomA: prenomA,
                    sexeA: sexeA,
                    naissanceA: naissanceA,
                    departementA: departementA,
                    communeNA: communeNA,
                    nationaliteA: nationaliteA,
                    regimeA: regimeA,
                    situationA: situationA,
                    titrePA: titrePA,
                    derniereCA: derniereCA,
                    securiteA: securiteA,
                    intituleA: intituleA,
                    titreOA: titreOA,
                    declareSA: declareSA,
                    declareHA: declareHA,
                    declareRA: declareRA,
                    rueA: rueA,
                    voieA: voieA,
                    complementA: complementA,
                    postalA: postalA,
                    communeA: communeA,
                    numeroA: numeroA,
                    emailA: emailA,

                    nomR: nomR,
                    emailR: emailR,
                    rueR: rueR,
                    voieR: voieR,
                    complementR: complementR,
                    postalR: postalR,
                    communeR: communeR,




                    nomM: nomM,
                    prenomM: prenomM,
                    naissanceM: naissanceM,
                    securiteM: securiteM,
                    emailM: emailM,
                    emploiM: emploiM,
                    diplomeM: diplomeM,
                    niveauM: niveauM,

                    nomM1: nomM1,
                    prenomM1: prenomM1,
                    naissanceM1: naissanceM1,
                    securiteM1: securiteM1,
                    emailM1: emailM1,
                    emploiM1: emploiM1,
                    diplomeM1: diplomeM1,
                    niveauM1: niveauM1,

                    travailC: travailC,
                    derogationC: derogationC,
                    numeroC: numeroC,
                    conclusionC: conclusionC,
                    debutC: debutC,
                    finC: finC,
                    avenantC: avenantC,
                    executionC: executionC,
                    dureC: dureC,
                    typeC: typeC,
                    rdC: rdC,
                    raC: raC,
                    rpC: rpC,
                    rsC: rsC,
                    rdC1: rdC1,
                    raC1: raC1,
                    rpC1: rpC1,
                    rsC1: rsC1,

                    rdC2: rdC2,
                    raC2: raC2,
                    rpC2: rpC2,
                    rsC2: rsC2,

                    salaireC: salaireC,
                    caisseC: caisseC,
                    logementC: logementC,
                    avantageC: avantageC,
                    autreC: autreC,
                    
                    lieuO: lieuO,
                    priveO: priveO,
                    attesteO: attesteO,
                    
                    id: id,
                    action: action
                  },

                  
                  
                datatype: 'json',
                beforeSend: function () {
                   
                    $('.newBtn').html('<i class="fa fa-refresh fa-spin fa-2x"></i>').prop('disabled', true);
                },
                success: function (json) {
                   
                    if (json.statuts === 0){
                      
                        showAlert($form,1,json.mes);
                        toastr.success(json.mes,'Succès!');
                        window.location.reload();
                    } else {
                        toastr.error(json.mes,'Oups!');
                        showAlert($form,2,json.mes);
                    }
                },
                complete: function () {
                    $('.newBtn').html(act).prop('disabled', false);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR+ textStatus+ errorThrown);
                }
            });
        }else{
            toastr.error('Veuillez remplir correctement tous les champs requis','Oups!');
            showAlert($form,2,'Veuillez remplir correctement tous les champs requis');
        }

    });

    $(document).on('click','.trash', function (e) {
        e.preventDefault();
        var url = $(this).data('url'),
            id = $(this).data('id');
        swal({
                title: "Etes vous sûr?",
                text: "Le cerfa va être supprimée.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#153C4A",
                confirmButtonText: "Oui, valider!",
                cancelButtonText: "Annuler",
                closeOnConfirm: true
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type: 'post',
                        url : url,
                        data: 'id='+id,
                        datatype: 'json',
                        beforeSend: function () {
                            run_waitMe(current_effect,loadingText);
                        },
                        complete: function () {
                            dismiss_waitMe();
                        },
                        success: function (json) {
                            if (json.statuts === 0) {
                                toastr.success(json.mes,'Succès!');
                                window.location.reload();
                            } else {
                                toastr.error(json.mes,'Oups!');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown){}
                    });
                }
            });
    });

    $(document).on('click','.gene', function (e) {
        e.preventDefault();
        var url = $(this).data('url'),
            id = $(this).data('id');

          
        swal({
                title: "Etes vous sûr?",
                text: "voulez vous generer le cerfa.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#153C4A",
                confirmButtonText: "Oui, valider!",
                cancelButtonText: "Annuler",
                closeOnConfirm: true
            },
            function(isConfirm){
                
                if (isConfirm) {
                    $.ajax({
                        type: 'post',
                        url : url,
                        data: 'id='+id,
                        datatype: 'json',
                        beforeSend: function () {
                            run_waitMe(current_effect,loadingText);
                        },
                        complete: function () {
                            dismiss_waitMe();
                        },
                        success: function (json) {
                           
                            if (json.statuts === 0) {
                                toastr.success(json.mes,'Succès!');
                                window.location.reload();
                            } else {
                                console.log(json);
                                toastr.error(json.mes,'Oups!');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log(jqXHR+ textStatus+ errorThrown);
                        }
                    });
                }
            });
    });

    $(document).on('click','.send', function (e) {
        e.preventDefault();
        var url = $(this).data('url'),
            id = $(this).data('id');
        swal({
                title: "Etes vous sûr?",
                text: "Le cerfa va être envoyer a l'apprenant.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#153C4A",
                confirmButtonText: "Oui, valider!",
                cancelButtonText: "Annuler",
                closeOnConfirm: true
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type: 'post',
                        url : url,
                        data: 'id='+id,
                        datatype: 'json',
                        beforeSend: function () {
                            run_waitMe(current_effect,loadingText);

                        },
                        complete: function () {
                            dismiss_waitMe();
                            window.location.reload();
                        },
                        success: function (json) {
                            if (json.statuts === 0) {
                                toastr.success(json.mes,'Succès!');
                                window.location.reload();
                            } else {
                         	       toastr.error(json.mes,'Oups!');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown){}
                    });
                }
            });
    });

    
    $(document).on('click','.sendEmployeur', function (e) {
        e.preventDefault();
        var url = $(this).data('url'),
            id = $(this).data('id');
        swal({
                title: "Etes vous sûr?",
                text: "Le cerfa va être envoyer a l'employeur.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#153C4A",
                confirmButtonText: "Oui, valider!",
                cancelButtonText: "Annuler",
                closeOnConfirm: true
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type: 'post',
                        url : url,
                        data: 'id='+id,
                        datatype: 'json',
                        beforeSend: function () {
                            run_waitMe(current_effect,loadingText);

                        },
                        complete: function () {
                            dismiss_waitMe();
                            window.location.reload();
                        },
                        success: function (json) {
                            if (json.statuts === 0) {
                                toastr.success(json.mes,'Succès!');
                                window.location.reload();
                            } else {
                         	       toastr.error(json.mes,'Oups!');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown){}
                    });
                }
            });
    });

});