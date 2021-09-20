$(function(){
    const newOptionButton = $('.add-new-option-button');
    const pollOptionsContainer = $('.poll-options-container');

    const newOption = `<div class="poll-option-container">
    <input type="text" name="option[]" class="poll-option" placeholder="Enter option..." required/>
    <button type="button" class="remove-button">Remove</button>
    </div>`;

    const minValue = 1;
    const maxValue = 7;

    const pollDays = $('.poll-days');
    const incrementButton = $('.increment-day-button');
    const decrementButton = $('.decrement-day-button');

    const removeButtonClass = '.remove-button';

    const popup = $('.popup');
    const popupMessage = $('.popup-message');

    newOptionButton.on('click', function(){
        pollOptionsContainer.append(newOption);
        pollOptionsContainer.animate({
            scrollTop: $(this).offset().top
        }, 400);
    });

    incrementButton.on('click', function(){
        if(pollDays.val() < maxValue){
            pollDays.val(parseInt(pollDays.val()) + 1);
        }
    });

    decrementButton.on('click', function(){
        if(pollDays.val() > minValue){
            pollDays.val(parseInt(pollDays.val()) - 1);
        }
    });

    $('body').on('click', removeButtonClass, function(){
        if(pollOptionsContainer.children().length > 2){
            $(this).closest('.poll-option-container').remove();
            pollOptionsContainer.animate({
                scrollTop: $(this).offset().top
            }, 400);
        }
        else{
            showPopup('You need at least 2 options for the poll.', 3000, 'error');
        }
    });

    showPopup = function(message, duration, type){
        popupMessage.text(message);
        popup.addClass(type);
        popup.addClass('show');
        setTimeout(function(){
            popup.removeClass(type);
            popup.removeClass('show');
        }, duration);
    }
});