$(document).ready(function() {
    // Écouteur d'événement pour le changement de catégorie de véhicule
    $('#vehicle-category').change(function() {
        var selectedCategory = $(this).val();

        // Requête AJAX pour récupérer les modèles de véhicules correspondants
        $.ajax({
            url: '../php/get_models.php',
            type: 'GET',
            data: { vehicleCategory: selectedCategory },
            dataType: 'json',
            success: function(response) {
                // Réinitialisation de la liste des modèles de véhicules
                $('#vehicle-model').empty();

                // Ajout des modèles récupérés à la liste
                $.each(response, function(_index, modelData) {
                    var optionText = modelData.marque + ' ' + modelData.modele + ' (Couleur: ' + modelData.couleur + ', Année: ' + modelData.annee + ')';
                    $('#vehicle-model').append('<option value="' + modelData.modele + '">' + optionText + '</option>');
                });
            },
            error: function() {
                // Gestion des erreurs
                console.log('Une erreur s\'est produite lors de la récupération des modèles de véhicules.');
            }
        });
    });
});
