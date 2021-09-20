$(function(){
    const voteButton = $('.vote-button');
    const voteOptionContainer = $('.option-container');
    const voteOptionsContainer = $('.options-container');
    const voteOption = $('.vote-option');
    let currentOptionId = null;

    if(voteOptionsContainer.clientHeight > 600){
        voteOptionsContainer.addClass('options-container-overflow');
    }

    voteOption.on('change', function(){
        if($(this).is(':checked')){
            currentOptionId = $(this).attr('data-option-id');
        }
    });

    voteButton.on('click', function(){
        let data = {'option_id' : currentOptionId};
        voteButton.val('SUBMITING VOTE...');
        voteButton.addClass('processing');
        voteOptionContainer.addClass('processing');
        $.post('../actions/vote.php', data).done(function(result){
            voteButton.val('VOTE SUBMITTED');
            voteButton.addClass('disabled');
            voteOptionContainer.addClass('disabled');
        });
    });
});