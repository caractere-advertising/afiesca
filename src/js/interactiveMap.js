
    // Hide all cards initially
    $('.result .card').hide();

    // Add click event handler to interactive map points
    $('#my-interactive-image').on('click', '.interactive-point', function() {
        // Hide all cards
        $('.result .card').hide();
        // Get the index of the clicked point
        var index = $(this).index();
        // Show the corresponding card
        $('.result .card').eq(index).show();
    });
