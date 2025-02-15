$(document).ready(function () {
    // Listen for keyup event on the search bar
    $('#searchBar').on('keyup', function () {
        var searchQuery = $(this).val(); // Get the value from the search bar

        // Send AJAX request to fetch filtered results
        $.ajax({
            url: 'index.php', // URL of the PHP page that handles the request
            type: 'GET',
            data: {
                search: searchQuery // Pass the search query as GET parameter
            },
            success: function (response) {
                // Parse the response and update the results
                var newContent = $(response).find('#appResults').html(); // Get the filtered apps
                $('#appResults').html(newContent); // Replace the current app list with the filtered apps
            }
        });
    });

    // Function to show the install popup
    function install(icon, name, downloadUrl) {
        $('#app_icon').attr('src', icon);
        $('#app_name').text(name);
        $('#app-caption-title').text(name);
        $('#install_btn').attr('href', downloadUrl);
        $('#install').show(); // Show the modal
    }

    // Close the popup
    $('#close').on('click', function () {
        $('#install').hide();
    });

    // Expose the install function to the global scope
    window.install = install;
});
