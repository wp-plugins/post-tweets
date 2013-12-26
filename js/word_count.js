jQuery(document).ready(function ($) {
    var $counterText = $('<div class="character-counter" />');
 
    // Get the textarea field
    $('#tweet_desc')
 
    // Add the counter after it
    .after($counterText)
    
    // Bind the counter function on keyup and blur events
    .bind('keyup blur', function () {
        // Count the characters and set the counter text
        $counterText.text($(this).val().length + '/140 characters');
    })
    
    // Trigger the counter on first load
    .keyup();
});
 