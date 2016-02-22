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
            //forEach(jsondata, function(key, value){console.log(key + ': ' + value)})
            alert(1);
            var arr = JSON.stringify(jsondata);
            for(var k in jsondata) {
                $('.results').append(
                    '<li key=\"' + JSON.stringify(jsondata[k].id) + '\"> ' +
                    JSON.stringify(jsondata[k].name) +
                    '<br>' +
                    JSON.stringify(jsondata[k].comment) + '</li>'
                );
            }
        }
    });

    function forEach(data, callback){
        for(var key in data){
            if(data.hasOwnProperty(key)){

                for(var key2 in data[key]){
                    if(data[key].hasOwnProperty(key2)){
                        var l2 = {key2: JSON.stringify((data[key][key2]))};

                        for(var key3 in data[key][key2]){
                            if(data[key][key2].hasOwnProperty(key3) && data[key][key2] !== null && typeof data[key][key2] === 'object'){
                                callback(key3, data[key][key2][key3]);
                            }
                        }
                    }
                }
            }
        }
    }

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


