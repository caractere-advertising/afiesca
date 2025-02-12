import inView from "in-view";

$(document).ready(function () {
  //IN-VIEW
  if (document.querySelector(".from-left")) {
    document.querySelector(".from-left").classList.add("invisible");
  }
  if (document.querySelector(".from-right")) {
    document.querySelector(".from-right").classList.add("invisible");
  }
  if (document.querySelector(".from-top")) {
    document.querySelector(".from-top").classList.add("invisible");
  }
  if (document.querySelector(".from-bottom")) {
    document.querySelector(".from-bottom").classList.add("invisible");
  }

  function makeMagic(data, direction) {
    data.classList.remove("invisible");
    data.classList.add(direction);
  }

  function removeMagic(data, direction) {
    data.classList.add("invisible");
    data.classList.add(direction);
  }

  inView.offset(150);

  inView(".from-left").on("enter", (el) => {
    makeMagic(el, "fade-in-left");
  });

  inView(".from-right").on("enter", (el) => {
    makeMagic(el, "fade-in-right");
  });

  inView(".from-bottom").on("enter", (el) => {
    makeMagic(el, "fade-in-bottom");
  });

  inView(".from-top").on("enter", (el) => {
    makeMagic(el, "fade-in-top");
  });

  /* ANIMATION NUMBER */
  const counters = document.querySelectorAll(".animate-number");
  const speed = 100;

  inView(".grid_stats").on("enter", (e) => {
    counters.forEach((counter) => {
      const animate = () => {
        const value = +counter.dataset.number;
        const data = +counter.innerText;

        const time = value / speed;
        if (data < value) {
          counter.innerText = Math.ceil(data + time);

          if (value < 100) {
            setTimeout(animate, 40);
          } else {
            setTimeout(animate, 2);
          }
        } else {
          counter.innerTexte = value;
        }
      };

      animate();
    });
  });

  $(document).on("click", function (event) {
    if ($(event.target).hasClass("close")) {
      closePopup();
    }
  });

  function closePopup() {
    $(".container_popup").empty();
    $("#modal-chambre").hide();
  }

  var modal = document.getElementById('#modal_popup_front');

  // Fermeture de la popup lors du clic sur le bouton de fermeture
  $('#close_popup').on('click',function(event){
    $('#modal_popup_front').css("display","none");
  });

  // Fermeture de la popup lors du clic en dehors du contenu
  $(window).on('click', function(event) {
    if (event.target == modal) {
      modal.css("display","none");
    }
  });

  $(document).on('click', function(event) {
    if (!$(event.target).closest('.content_popup').length ) {
      console.log('close popup');
      modal.css("display","none");
    }
  });
});