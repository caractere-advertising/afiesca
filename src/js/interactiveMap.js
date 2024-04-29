// Fonction pour mettre à jour les positions des hotspots en fonction de la taille de l'image
function updateHotspotsPosition() {
    var imageWidth = $('#my-interactive-image').width();
    var imageHeight = $('#my-interactive-image').height();

    // Mettre à jour les positions des hotspots en fonction de la taille de l'image
    $('.hotspot').each(function() {
        var left = parseInt($(this).css('left'));
        var top = parseInt($(this).css('top'));

        // Convertir les positions en pourcentage
        var newLeft = (left / imageWidth) * 100 + '%';
        var newTop = (top / imageHeight) * 100 + '%';

        // Mettre à jour les positions des hotspots
        $(this).css({ 'left': newLeft, 'top': newTop });
    });
}

// Appeler la fonction de mise à jour des hotspots après le chargement de la page
$(document).ready(function() {
    updateHotspotsPosition();
});

// Appeler la fonction de mise à jour des hotspots lors du redimensionnement de la fenêtre
$(window).on('resize', function() {
    updateHotspotsPosition();
});
