$(function(){

    $(window).load(function () {
        allHeight();
    });


    //微博高度保持一致
    function allHeight() {
        if ($('.main_left').height() > 800) {
            $('.main_right').height($('.main_left').height() + 30);
            $('#main').height($('.main_left').height() + 30);
        }
    }
    //发布
    $('.weibo_button').button().click(function (e) {

        if ( $('.weibo_text').val().length == 0) {
            $('#error').html('请输入内容...').dialog('open');
            setTimeout(function () {
                $('#error').html('...').dialog('close');
                $('.weibo_text').focus();
            }, 1000);
        }else{
            if (weibo_num()) {
                $.ajax({
                    url : ThinkPHP['MODULE'] + '/Topic/publish',
                    type : 'POST',
                    data : {
                        content : $('.weibo_text').val(),
                    },
                    beforeSend : function () {
                        $('#loading').html('微博发布中...').dialog('open');
                    },
                    success : function (data, response, status) {
                        if(data){
                            $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px 65%').html('发布成功...');

                            var html = $('#ajax_html1').html();
                            if (html.indexOf('#内容#')) {
                                html = html.replace(/#内容#/g, $('.weibo_text').val());
                            }
                            setTimeout(function(){
                                $('.weibo_text').val('');
                                $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px 65%').html('...').dialog('close');
                                $('.weibo_content ul').after(html);
                                allHeight();
                            },500)
                        }

                    }
                })
            }
        }

    });

    //微博输入内容计算字个数
    $('.weibo_text').on('keyup', weibo_num);
    //微博输入内容得到交单计算字个数
    $('.weibo_text').on('focus', function () {
        setTimeout(function () {
            weibo_num();
        }, 50);
    });

    //140字检测
    function weibo_num() {
        var total = 280;
        var len = $('.weibo_text').val().length;
        var temp = 0;
        if (len > 0) {
            for (var i = 0; i < len; i++) {
                if ($('.weibo_text').val().charCodeAt(i) > 255) {
                    temp += 2;
                } else {
                    temp ++;
                }
            }
            var result = parseInt((total - temp)/2 - 0.5);
            if (result >= 0) {
                $('.weibo_num').html('您还可以输入<strong>' + result + '</strong>个字');
                return true;
            } else {
                $('.weibo_num').html('已经超过了<strong class="red">' + result + '</strong>个字');
                return false;
            }
        }
    }
    //上传
    $('#file').uploadify({
        swf:ThinkPHP['UPLOADIFY'] + '/uploadify.swf',
        uploader:ThinkPHP['UPLOADER'],
        fileTypeDesc : '图片类型',
        fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',
        onUploadSuccess : function (file, data, response) {
            alert(data);
        }
    });




    //得到总页码
    $.ajax({
        url : ThinkPHP['MODULE'] + '/Topic/ajaxCount',
        type : 'POST',
        data : {

        },
        success: function(data, response, status){
            window.count = parseInt(data);
        }
    });
    //滚动条拖动
    window.scrollFlag = true;
    window.first = 10;
    window.page = 1;
    $(window).scroll(function () {
        if (window.page < window.count) {

            $('#loadmore').html('加载更多 <img src="'+ThinkPHP['IMG']+'/loadmore.gif" alt="">');
            if (window.scrollFlag) {
                if ($(document).scrollTop() >= ($('#loadmore').offset().top + $('#loadmore').outerHeight() - $(window).height() - 20)) {
                    setTimeout(function(){
                        $.ajax({
                            url: ThinkPHP['MODULE'] + '/Topic/ajaxlist',
                            type: 'POST',
                            data: {
                                first: window.first,
                            },
                            success: function(data, response, status){
                                $('#loadmore').before(data);
                                allHeight();
                            }
                        });
                        window.scrollFlag = true;
                        window.first += 10;
                        window.page += 1;
                    }, 500);
                    window.scrollFlag = false;
                }
            }
        } else {
            $('#loadmore').html('没有更多数据');
        }
    });

    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        topDistance: '300', // Distance from top before showing element (px)
        topSpeed: 300, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        animationInSpeed: 200, // Animation in speed (ms)
        animationOutSpeed: 200, // Animation out speed (ms)
        scrollText: '', // Text for element
        activeOverlay: false, // Set CSS color to display scrollUp active
    });


})
