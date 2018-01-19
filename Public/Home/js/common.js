$(function(){
    //头部鼠标悬停效果
    $('.app').hover(function(){
        $(this).css({
            background:'#333',
            color:'#fff',
        }).find('.list').show();
    },function(){
        $(this).css({
            background:'none',
            color:'#fff',
        }).find('.list').hide();
    });

    //error
    $('#error').dialog({
        width : 190,
        height : 40,
        closeOnEscape : false,
        modal : false,
        resizable : false,
        draggable : false,
        autoOpen : false,
    }).parent().find('.ui-widget-header').hide();

    //loading
    $('#loading').dialog({
        width : 190,
        height : 40,
        closeOnEscape : false,
        modal : true,
        resizable : false,
        draggable : false,
        autoOpen : false,
    }).parent().find('.ui-widget-header').hide();


});