$("#searchbar").keyup(function (e) {
  e.preventDefault;

  var value = $("#searchbar").val();

  if (value != "" && value.length >= 3) {
    $.ajax({
      type: "POST",
      datatype: "json",
      url: "http://localhost:10028/wp-admin/admin-ajax.php",
      data: {
        action: "searchbar",
        q: value,
      },
      fail: function () {
        console.log("Error");
      },
      success: function (response) {
        console.log(response);

        if (response.success) {
          var data = response.data;

          if (data.length > 0) {
            //console.log(data.length);

            var html = "";

            for (var i = 0; i < data.length; i++) {
              var resultList = data[i];
              //console.log(resultList.post_title);
              html +=
                "<a href='" +
                resultList.permalink +
                "'>" +
                resultList.post_title +
                "</a>"; // Vous pouvez utiliser d'autres propriétés de l'objet item selon vos besoins
            }
          } else {
            html = "<p>Aucun résultat trouvé</p>";
          }

          $("#displayResult").html(html);
        } else {
          console.log("Erreur lors de la recherche : " + response.data);
        }
      },
    });
  }
});
