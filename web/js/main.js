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
                    '<br><p>' +
                    JSON.stringify(jsondata[k].comment).replace("\"", "").replace("\"", "") + 
                    '</p><a class=\"edit\" onclick=\"$().edit(\''+JSON.stringify(jsondata[k].id).replace("\"", "").replace("\"", "")+'\')\">Edit</a>' +
                    '<a class=\"delete\" onclick=\"$().delete(\''+JSON.stringify(jsondata[k].id).replace("\"", "").replace("\"", "")+'\')\">Delete</a>' +
                    '<span class=\"starRating\"><input id=\"rating1\" type=\"radio\" name=\"rating\" value=\"1\" onclick=\"$().rate(\''+JSON.stringify(jsondata[k].id).replace("\"", "").replace("\"", "")+'\', 1)\"><label for=\"rating1\">1</label><input id=\"rating2\" type=\"radio\" name=\"rating\" value=\"2\" onclick=\"$().rate(\''+JSON.stringify(jsondata[k].id).replace("\"", "").replace("\"", "")+'\', 2)\"><label for=\"rating2\">2</label><input id=\"rating3\" type=\"radio\" name=\"rating\" value=\"3\" onclick=\"$().rate(\''+JSON.stringify(jsondata[k].id).replace("\"", "").replace("\"", "")+'\', 3)\"><label for=\"rating3\">3</label><input id=\"rating4\" type=\"radio\" name=\"rating\" value=\"4\" onclick=\"$().rate(\''+JSON.stringify(jsondata[k].id).replace("\"", "").replace("\"", "")+'\', 4)\"><label for=\"rating4\">4</label><input id=\"rating5\" type=\"radio\" name=\"rating\" value=\"5\" onclick=\"$().rate('+JSON.stringify(jsondata[k].id).replace("\"", "").replace("\"", "")+'\', 5)\"><label for=\"rating5\">5</label></span></li>'
                );
            }
        }
    });

    $.fn.edit = function (id) {
        var text = $("ul [key="+id+"] p").text();
        $("ul [key="+id+"] p").empty().append(
            '<input type=\"text\" name=\"edit\" id=\"edit\" value=\"'+text+'\" /><div class=\"editButton\">Ok</div>'
            );

        $('.editButton').click(function () {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/web/crud/update/',
                data: {
                    comment: $('ul [name="edit"]').val(),
                    ip: userip,
                    id: id,
                    domain: window.location.host
                },
                success: function(jsondata){
                    var formval = $('ul [name="edit"]').val();
                    $("ul [key="+id+"] p").empty().append(
                        formval
                    );
                }
            });
        });
    };

    $.fn.delete = function (id) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/web/crud/delete/',
            data: {
                id: id,
                ip: userip,
                domain: window.location.host
            },
            success: function(){
                $("[key="+id+"]").empty();
            }
        });
    };

    $.fn.rate = function (id, rating) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/web/crud/rate/',
            data: {
                id: id,
                rating: rating,
                ip: userip,
                domain: window.location.host
            },
            success: function(){
                //find by id and prepend 
            }
        });
    };


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
                    '<li key=' + jsondata.id + '> ' +
                    jsondata.fname +
                    ' ' +
                    jsondata.lname +
                    '<br>' +
                    jsondata.comment + 
                    '</p><a class=\"edit\" onclick=\"$().edit(\''+jsondata.id+'\')\">Edit</a>' +
                    '<a class=\"delete\" onclick=\"$().delete(\''+jsondata.id+'\')\">Delete</a></li>'
                );
                $('#fname').val(null);
                $('#lname').val(null);
                $('#comment').val(null);
            }
        });
    });

});