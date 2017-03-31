function myFunction() {
    alert("vous êtes bien déconnecté");
}



//Requete ajax pour remplir le formulaire d'édition
$updateUser = false;
$("User").change(function (e) {
    if ($updateUser === false) {
        $.ajax({
            type: 'PUT',
            async: false,
            dataType: 'json',
            url: "/editprofil1/{id}",
            data:
                    {
                        "nom": $("#userbundle_user_nom").val(),
                        "prenom": $("#userbundle_user_prenom").val(),
                        "username": $("#userbundle_user_username").val()


                    },
            success: function (data ) {

                $("#userbundle_user_nom").val(data.nom);
                $("#userbundle_user_prenom").val(data.prenom);
                $("#userbundle_user_username").val(data.username);
                $updateUser = true;

            }
        }
        );
    }
    ;
});