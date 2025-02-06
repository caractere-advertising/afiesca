$("#searchbar").keyup(function (e) {
  e.preventDefault();

  var value = $("#searchbar").val();

  if (value != "" && value.length >= 3) {
    $.ajax({
      type: "POST",
      datatype: "json",
      url: "https://afi-esca.be/wgk2bwa8hk9ogzt/admin-ajax.php",
      data: {
        action: "searchbar",
        q: value,
      },
      error: function () {
        console.log("Error");
      },
      success: function (response) {
        console.log(response);

        if (response.success) {
          var data = response.data;

          if (data.length > 0) {
            var html = "";

            for (var i = 0; i < data.length; i++) {
              var resultList = data[i];
              html +=
                "<a href='" +
                resultList.permalink +
                "'>" +
                resultList.post_title +
                "</a>";
            }
          } else {
            html = "<p>Aucun résultat trouvé</p>";
          }

          $("#displayResult").html(html);
          $("#displayResult").show(); // Afficher la div displayResult
        } else {
          console.log("Erreur lors de la recherche : " + response.data);
          var html = "<p>" + response.data + "</p>";
          $("#displayResult").html(html);
          $("#displayResult").show(); // Afficher la div displayResult
        }
      },
    });
  } else {
    $("#displayResult").hide(); // Masquer la div displayResult si la longueur de value est égale à zéro
  }
});

// Cacher displayResult lors d'un clic en dehors
$(document).mouseup(function (e) {
  var container = $("#displayResult");
  if (!container.is(e.target) && container.has(e.target).length === 0) {
    container.hide();
  }
});
