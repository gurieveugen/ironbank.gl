$(document).ready(function(){
    var eventDir = 'common';
    var eventUrl = 'http://ircast.com.au/conferences/online/common/';
    var commonUrl = 'http://ircast.com.au/conferences/online/common/';

    var pres_frame = $('<iframe>', {
        id: 'pres_frame',
        width: '100%',
        height: '100%',
        scrolling: 'no',
        frameborder: '0'
    });

    var pres_dialog = $('<div>', {
        id: 'pres_dialog'
    });

    pres_dialog.css('display', 'none');
    pres_dialog.css('overflow', 'hidden');
    pres_dialog.append(pres_frame);

    $('body').append(pres_dialog);

    pres_dialog.dialog({
        title: '',
        modal: true,
        autoOpen: false,
        height: $(window).height() - 20,
        width: $(window).height() * 1.465
    });
    
    $('.launch_pres').click(function(){

        if ($(this).attr('event')) {
            eventDir = $(this).attr('event');
        }
        else if (eventDir) {
            eventDir = eventDir;
        }
        else {
            alert('ERROR: Link is missing mandatory event attribute');
            return false;
        }

        if ($(this).attr('pres_id')) {
            var presId = $(this).attr('pres_id');
        }
        else {
            alert('ERROR: Link is missing mandatory pres_id attribute');
            return false;
        }

        if ($(this).attr('access_code')) {
            var presAccessCode = $(this).attr('accesscode');
        }

        if ($(this).attr('titlebar')) {
            var presTitleBar = $(this).attr('titlebar');
        }

        // Note that callback=? is vital as it allows cross domain scripting
        var getjson = $.getJSON(eventUrl + "json.php?callback=?&object=event&id=" + eventDir);

        getjson.success(function(myevent) {
            // alert('getjson.success'); 

            /*
            $.each(result, function(i, field){
                alert(i + " " + field);
            });
            */
            var url = myevent['base_url'] + 'pres/' + presId + '/';
            if (presAccessCode) {
                url = url + '?accesscode=' + presAccessCode;
            }
            // alert(url);

            $('#pres_frame').attr('src', url);

            var pres_dialog = $('#pres_dialog');

            pres_dialog.dialog('option', 'title', myevent['event_name']);
            if (presTitleBar) {
                pres_dialog.dialog('option', 'title', presTitleBar);
            }

            pres_dialog.dialog('open');

            return false;
        });

        getjson.error(function() {
            alert('Sorry, event information for \'' + eventDir + '\' cannot be retrieved');
            return false;
        });

        /*
        getjson.complete(function() {
            alert('getjson.complete');
        });
        */

        return false;
    });

    $('.ui-dialog-titlebar-close').click(function(){
        $('#pres_frame').attr('src', 'about:blank');
    });
});
