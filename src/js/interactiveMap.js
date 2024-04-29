var items = [
    {
        position: {
            left: 100, // Position x du premier emplacement
            top: 200   // Position y du premier emplacement
        },
        informations: "Informations sur le premier client"
    },
    {
        position: {
            left: 300, // Position x du deuxième emplacement
            top: 400   // Position y du deuxième emplacement
        },
        informations: "Informations sur le deuxième client"
    },
    // Ajoutez autant d'objets que nécessaire pour chaque emplacement
];

var options = {
    allowHtml: true,
    triggerEvent: 'click',
    shareBox: false,
};
    
// Plugin activation
$(document).ready(function() {
  $("#my-interactive-image").interactiveImage(items);

        // Gestionnaire d'événements pour afficher les informations du client
        $('#my-interactive-image').on('click', '.interactive-point', function() {
            var index = $(this).index();
            $('.result .card').eq(index).show();
        });

        // Cachez les informations du client lorsqu'on clique en dehors des marqueurs
        $('#map-container').on('click', function(event) {
            if (!$(event.target).closest('.interactive-point').length) {
                $('.result .card').hide();
            }
        });
});
