function modifyRow(id) {
    // Récupérer les valeurs actuelles de la ligne
    var voiture = document.getElementById('voiture-' + id).innerHTML;
    var date_reservation = document.getElementById('date_reservation-' + id).innerHTML;

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

    // Ajouter un champ pour la modification de la voiture
    var voitureField = document.createElement('input');
    voitureField.setAttribute('type', 'text');
    voitureField.setAttribute('name', 'voiture');
    voitureField.setAttribute('value', voiture);
    form.appendChild(voitureField);

    // Ajouter un champ pour la modification de la date de réservation
    var dateField = document.createElement('input');
    dateField.setAttribute('type', 'text');
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