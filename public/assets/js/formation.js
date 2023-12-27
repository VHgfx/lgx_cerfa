
$(document).ready(function(){
    /**
     * Fonction qui ouvre la modal pour l'ajouter
     */
    $(document).on('click','#add',function(e){
        e.preventDefault();
        $('#intro').text('AJOUTER UNE FORMATION');
        $('#confirm').text('ENREGISTRER');

        $('#nomF').val('');
        $('#diplomeF').val('');
        $('#intituleF').val('');
        $('#numeroF').val('');
        $('#siretF').val('');
        $('#codeF').val('');
        $('#rnF').val('');
        $('#entrepriseF').val('');
        $('#responsableF').val('');
        $('#rueF').val('');
        $('#voieF').val('');
        $('#complementF').val('');
        $('#postalF').val('');
        $('#communeF').val('');


        $('#debutO').val('');
        $('#prevuO').val('');
        $('#dureO').val('');
        $('#nomO').val('');
        $('#numeroO').val('');
        $('#siretO').val('');
        $('#rueO').val('');
        $('#voieO').val('');
        $('#complementO').val('');
        $('#postalO').val('');
        $('#communeO').val('');
     
        $('#action').val('add');
        $('#new').modal();
    });

    /**
     * Fonction qui ouvre la Modal d'edition
     */
    $(document).on('click','.edit',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
 
        var nomF = $(this).attr('data-nomF');
        var diplomeF = $(this).attr('data-diplomeF');
        var intituleF = $(this).attr('data-intituleF');
        var numeroF = $(this).attr('data-numeroF');
        var siretF = $(this).attr('data-siretF');
        var codeF = $(this).attr('data-codeF');
        var rnF = $(this).attr('data-rnF');
        var entrepriseF = $(this).attr('data-entrepriseF');
        var responsableF = $(this).attr('data-responsableF');
        var rueF = $(this).attr('data-rueF');
        var voieF = $(this).attr('data-voieF');
        var complementF = $(this).attr('data-complementF');
        var postalF = $(this).attr('data-postalF');
        var communeF = $(this).attr('data-communeF');


        var debutO = $(this).attr('data-debutO');
        var prevuO = $(this).attr('data-prevuO');
        var dureO = $(this).attr('data-dureO');
        var nomO = $(this).attr('data-nomO');
        var numeroO = $(this).attr('data-numeroO');
        var siretO = $(this).attr('data-siretO');
        var rueO = $(this).attr('data-rueO');
        var voieO = $(this).attr('data-voieO');
        var complementO = $(this).attr('data-complementO');
        var postalO = $(this).attr('data-postalO');
        var communeO = $(this).attr('data-communeO');
      
        
        
        $('#idElement').val(id);


        $('#nomF').val(nomF);
        $('#diplomeF').val(diplomeF);
        $('#intituleF').val(intituleF);
        $('#numeroF').val(numeroF);
        $('#siretF').val(siretF);
        $('#codeF').val(codeF);
        $('#rnF').val(rnF);
        $('#entrepriseF').val(entrepriseF);
        $('#responsableF').val(responsableF);
        $('#rueF').val(rueF);
        $('#voieF').val(voieF);
        $('#complementF').val(complementF);
        $('#postalF').val(postalF);
        $('#communeF').val(communeF);


        
        $('#debutO').val(debutO);
        $('#prevuO').val(prevuO);
        $('#dureO').val(dureO);
        $('#nomO').val(nomO);
        $('#numeroO').val(numeroO);
        $('#siretO').val(siretO);
        $('#rueO').val(rueO);
        $('#voieO').val(voieO);
        $('#complementO').val(complementO);
        $('#postalO').val(postalO);
        $('#communeO').val(communeO);

        
        $('#action').val('edit');
        $('#intro').text('MODIFIER UNE FORMATION');
        $('#confirm').text('ENREGISTRER');
        $('#new').modal();
    });

    $(document).on('submit', '#newFrom', function (e) {
        e.preventDefault();
        
        var $form = $(this),
            id = $('#idElement').val(),
            nomF = $('#nomF').val();
            diplomeF = $('#diplomeF').val();
            intituleF =  $('#intituleF').val();
            numeroF = $('#numeroF').val();
            siretF=  $('#siretF').val();
            codeF = $('#codeF').val();
            rnF = $('#rnF').val();
            entrepriseF = $('#entrepriseF').val();
            responsableF = $('#responsableF').val();
            rueF = $('#rueF').val();
            voieF = $('#voieF').val();
            complementF = $('#complementF').val();
            postalF = $('#postalF').val();
            communeF =  $('#communeF').val();


            debutO = $('#debutO').val();
            prevuO= $('#prevuO').val();
            dureO = $('#dureO').val();
            nomO = $('#nomO').val();
            numeroO = $('#numeroO').val();
            siretO = $('#siretO').val();
            rueO=  $('#rueO').val();
            voieO = $('#voieO').val();
            complementO= $('#complementO').val();
            postalO =$('#postalO').val();
            communeO = $('#communeO').val();
          
            action = $('#action').val(),
            act = $('.newBtn').html(),
            url = $(this).attr('action');


         
            
        if (nomF!=='' ){

            $.ajax({
                type: 'post',
                url: url,
                data: {
                  
                    nomF: nomF,
                    diplomeF: diplomeF,
                    intituleF: intituleF,
                    numeroF: numeroF,
                    siretF: siretF,
                    codeF: codeF,
                    rnF: rnF,
                    entrepriseF: entrepriseF,
                    responsableF: responsableF,
                    rueF: rueF,
                    voieF: voieF,
                    complementF: complementF,
                    postalF: postalF,
                    communeF: communeF,

                    debutO: debutO,
                    prevuO: prevuO,
                    dureO: dureO,
                    nomO: nomO,
                    numeroO: numeroO,
                    siretO: siretO,
                    rueO: rueO,
                    voieO: voieO,
                    complementO: complementO,
                    postalO: postalO,
                    communeO: communeO,
                   
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
                text: "La formation va être supprimée.",
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

   

});