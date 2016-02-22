/**
 * Created by vane on 20.02.16.
 */
$(document).ready(function(){

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/web/crud/read/',
        data: {
            domain: window.location.host,
            ip: userip
        },
        success: function(jsondata){
            var arr = JSON.stringify(jsondata);
            for(var k in jsondata) {
                $('.results').append(
                    '<li key=' + JSON.stringify(jsondata[k].id) + '>' +
                    JSON.stringify(jsondata[k].name).replace("\"", "").replace("\"", "") +
                    '<br>' +
                    JSON.stringify(jsondata[k].comment).replace("\"", "").replace("\"", "") + '</li>'
                );
            }
        }
    });

    $('input#send-button').click(function () {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/web/crud/create/',
            data: {
                fname: $('#fname').val(),
                lname: $('#lname').val(),
                comment: $('#comment').val(),
                ip: userip,
                domain: window.location.host
            },
            success: function(jsondata){
                $('.results').append(
                    '<li> ' +
                    jsondata.fname +
                    ' ' +
                    jsondata.lname +
                    '<br>' +
                    jsondata.comment + '</li>'
                );
                $('#fname').val(null);
                $('#lname').val(null);
                $('#comment').val(null);
            }
        });
    });

});


