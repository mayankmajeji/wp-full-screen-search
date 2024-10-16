// When the document is ready...
jQuery(document).ready(function ($) {
    console.log('Ready');
    // ... display the Full Screen search when:
    // 1. The user focuses on a search field, or
    // 2. The user clicks the Search button
    $('form[role=search] input, form[role=search] button').on('focus, click', function (event) {
        // Prevent the default action
        console.log('Hello');
        event.preventDefault();

        // Display the Full Screen Search
        $('#wpfss_form_wrapper').addClass('open');

        // Focus on the Full Screen Search Input Field
        $('#wpfss_form_wrapper input').focus();
    });

    // Hide the Full Screen search when the user clicks the close button
    $('#wpfss_form_wrapper button.close').on('click', function (event) {
        // Prevent the default event
        event.preventDefault();

        // Hide the Full Screen Search
        $('#wpfss_form_wrapper').removeClass('open');
    });

});