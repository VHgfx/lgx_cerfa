
$(document).ready(function(){
   
    
    $(document).on('submit', '#newForm', function (e) {
        e.preventDefault();
        
        var $form = $(this),
            url = $(this).attr('action'),
            nom = $('#nom').val(),
            type = $('#type').val(),
            couleur = $('#couleur').val(),
            id = $('#idElement').val(),
            action = $('#action').val(),
            act = $('.newBtn').html();
        if (nom != '' &&  type != '' &&  couleur != ''  && url != '') {
            $.ajax({
                type: 'post',
                url: url,
                data: 'nom='+nom+'&type='+type+'&couleur='+couleur+'&action='+action+'&id='+id,
                datatype: 'json',
                beforeSend: function () {
                    $('.newBtn').html('<i class="fa fa-refresh fa-spin fa-2x"></i>').prop('disabled', true);
                },
                success: function (json) {
                    if (json.statuts === 0) {
                        showAlert($form,1,json.mes);
                        toastr.success(json.mes,'Succès!');
                        window.location.reload();
                      
                    } else {
                        showAlert($form,2,json.mes);
                        toastr.error(json.mes,'Oups!');
                    }
                },
                complete: function () {
                    $('.newBtn').html(act).prop('disabled', false);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR+ textStatus+ errorThrown);
                }
            });
        } else {
            toastr.error('Veuillez remplir correctement tous les champs requis','Oups!');
            showAlert($form,2,'Veuillez remplir correctement tous les champs requis');
        }
    });
    $(document).on('click','.edit', function (e) {
        e.preventDefault();
        var 
            type = $(this).data('type'),
            nom = $(this).data('nom'),
            couleur = $(this).data('couleur'),
            id = $(this).data('id');
       
       
        $('#type').val(type);
        $('#nom').val(nom);
        $('#couleur').val(couleur);
        $('#idElement').val(id);
        $('#action').val('edit');
        $('.titleForm').html("MODIFIER le bureau");
        $('.newBtn').html("ENREGISTRER");
        $('.newModal').modal({backdrop: 'static', keyboard: false});
    });
    $(document).on('click','.new', function (e) {
        e.preventDefault();
        $('#type').val('');
        $('#nom').val('');
        $('#couleur').val('');
        $('#idElement').val('');
        $('#action').val('add');
        $('.titleForm').html("NOUVEAU bureau");
        $('.newBtn').html("ENREGISTRER");
        $('.newModal').modal({backdrop: 'static',  keyboard: false});
    });
    
   
    
    
   

  




    $(document).on('click','.trash', function (e) {
        e.preventDefault();
        var url = $(this).data('url'),
            id = $(this).data('id');
        swal({
                title: "Etes vous sûr?",
                text: "Le bureau va être supprimée.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00008B",
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