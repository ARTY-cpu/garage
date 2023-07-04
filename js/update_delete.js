function modifyRow(id) {
    // Récupérer les valeurs actuelles de la ligne
    var voiture = document.getElementById('voiture_id_' + id).value;
    var date_reservation = document.getElementById('date_reservation_id_' + id).value;

    // Créer un formulaire pour la modification
    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', '../php/update.php');

    // Ajouter un champ caché pour stocker l'identifiant
    var idField = document.createElement('input');
    idField.setAttribute('type', 'hidden');
    idField.setAttribute('name', 'id');
    idField.setAttribute('value', id);
    form.appendChild(idField);

    // Requête AJAX pour récupérer les véhicules disponibles
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var vehicles = JSON.parse(xhr.responseText);
            
            // Ajouter une combobox pour la modification de la voiture
            var voitureField = document.createElement('select');
            voitureField.setAttribute('name', 'voiture');
            
            // Ajouter les options de véhicules disponibles
            for (var i = 0; i < vehicles.length; i++) {
                var option = document.createElement('option');
                option.setAttribute('value', vehicles[i].id);
                option.innerHTML = vehicles[i].marque + ' ' + vehicles[i].modele + ' ' + vehicles[i].couleur ;
                
                // Définir l'option correspondant à la voiture actuelle comme sélectionnée
                if (vehicles[i].nom === voiture) {
                    option.setAttribute('selected', 'selected');
                }
                
                voitureField.appendChild(option);
            }
            
            form.appendChild(voitureField);
            
            // Ajouter un champ pour la modification de la date de réservation
            var dateField = document.createElement('input');
            dateField.setAttribute('type', 'date');
            dateField.setAttribute('name', 'date_reservation');
            dateField.setAttribute('value', date_reservation);
            form.appendChild(dateField);

            // Ajouter un bouton de soumission
            var submitButton = document.createElement('input');
            submitButton.setAttribute('type', 'submit');
            submitButton.setAttribute('value', 'Modifier');
            form.appendChild(submitButton);

            // Ajouter le formulaire à la page
            document.body.appendChild(form);
        }
    };

    xhr.open('GET', '../php/get_available_vehicles.php', true);
    xhr.send();

}

function deleteRow(id) {
    // Demander une confirmation à l'utilisateur
    var confirmation = confirm("Voulez-vous vraiment supprimer cette ligne ?");

    // Si l'utilisateur a confirmé
    if (confirmation) {
        // Créer un formulaire pour la suppression
        var form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('action', '../php/delete.php');

        // Ajouter un champ caché pour stocker l'identifiant
        var idField = document.createElement('input');
        idField.setAttribute('type', 'hidden');
        idField.setAttribute('name', 'id');
        idField.setAttribute('value', id);
        form.appendChild(idField);

        // Ajouter le formulaire à la page et le soumettre
        document.body.appendChild(form);
        form.submit();
    }
}