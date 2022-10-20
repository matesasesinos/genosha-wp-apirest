(function($){
    $(document).ready(function() {
        console.log(btoa('apiRestGenoshav3:pyG6 9DM2 S0yx BPGy 4flq oiqX'))
        $('.api-help-title').on('click', function() {
            const content = $(this).parent().find('.api-help-content');
            content.toggle('fast');
        });
    });
    $(document).ready(function() {
        $('#api-generate-auth').on('click', function() {
            const key = $.trim($('#api-generate-key').val());
            if(key.length < 1) {
                alert('Debe proporcionar datos');
                return;
            }
            const keyGenerate = btoa(key);
            $('#api-auth').css('display','inline-block');
            $('#api-key-generate').text(keyGenerate);
            $('#api-key-generate-example').text(keyGenerate);
        });
    });
})(jQuery);