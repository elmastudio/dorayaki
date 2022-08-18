jQuery(document).ready(function($) {
    $('#colorpicker1').hide();
    $('#colorpicker1').farbtastic('#link-color');

    $('#link-color').click(function() {
        $('#colorpicker1').show();
    });

    $(document).mousedown(function() {
        $('#colorpicker1').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).hide();
        });
    });
});

jQuery(document).ready(function($) {
    $('#colorpicker3').hide();
    $('#colorpicker3').farbtastic('#linkhover-color');

    $('#linkhover-color').click(function() {
        $('#colorpicker3').show();
    });

    $(document).mousedown(function() {
        $('#colorpicker3').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).hide();
        });
    });
});


jQuery(document).ready(function($) {
    $('#colorpicker2').hide();
    $('#colorpicker2').farbtastic('#footerbg-color');

    $('#footerbg-color').click(function() {
        $('#colorpicker2').show();
    });

    $(document).mousedown(function() {
        $('#colorpicker2').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).hide();
        });
    });
});

jQuery(document).ready(function($) {
    $('#colorpicker4').hide();
    $('#colorpicker4').farbtastic('#headerwidgetbg-color');

    $('#headerwidgetbg-color').click(function() {
        $('#colorpicker4').show();
    });

    $(document).mousedown(function() {
        $('#colorpicker4').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).hide();
        });
    });
});

jQuery(document).ready(function($) {
    $('#colorpicker5').hide();
    $('#colorpicker5').farbtastic('#bg-color');

    $('#bg-color').click(function() {
        $('#colorpicker5').show();
    });

    $(document).mousedown(function() {
        $('#colorpicker5').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).hide();
        });
    });
});

jQuery(document).ready(function($) {
    $('#colorpicker6').hide();
    $('#colorpicker6').farbtastic('#boxesbg-color');

    $('#boxesbg-color').click(function() {
        $('#colorpicker6').show();
    });

    $(document).mousedown(function() {
        $('#colorpicker6').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).hide();
        });
    });
});

jQuery(document).ready(function($) {
    $('#colorpicker7').hide();
    $('#colorpicker7').farbtastic('#headerbg-color');

    $('#headerbg-color').click(function() {
        $('#colorpicker7').show();
    });

    $(document).mousedown(function() {
        $('#colorpicker7').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).hide();
        });
    });
});

jQuery(document).ready(function($) {
    $('#colorpicker8').hide();
    $('#colorpicker8').farbtastic('#slider-color');

    $('#slider-color').click(function() {
        $('#colorpicker8').show();
    });

    $(document).mousedown(function() {
        $('#colorpicker8').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).hide();
        });
    });
});