/**
 * Created by vane on 20.02.16.
 */
$(document).ready(function(){

    $('input#send-button').click(function () {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/web/main/test2/',
            data: {
                fname: $('#fname').val(),
                lname: $('#lname').val(),
                comment: $('#comment').val(),
                ip: userip
            },
            success: function(jsondata){
                $('.results').append(
                    '<li>First Name = ' +
                    jsondata.fname +
                    ', Last Name = ' +
                    jsondata.lname +
                    ', Comment = ' +
                    jsondata.comment +
                    ', User ip = ' +
                    jsondata.ip +
                    jsondata.realip + '</li>'
                );
                $('#fname').val(null);
                $('#lname').val(null);
                $('#comment').val(null);
                console.log('First Name = ' + jsondata.fname + ', Last Name = ' + jsondata.lname + ', Comment = ' + jsondata.comment + ', User ip = ' + userip);
            }
        });
    });

});


