$(function(){
    const copyLinkButton = $('.copy-link-button');
    const voteLink = $('.vote-link');

    const popup = $('.popup');
    const popupMessage = $('.popup-message');

    copyLinkButton.on('click', function(){
        voteLink.select();
        document.execCommand('copy');
        showPopup('Link copied to clipboard.', 3000, 'update');
    });

    showPopup = function(message, duration, type){
        popupMessage.text(message);
        popup.addClass(type)
        popup.addClass('show');
        
        setTimeout(function(){
            popup.removeClass(type);
            popup.removeClass('show');
        }, duration);
    }
});