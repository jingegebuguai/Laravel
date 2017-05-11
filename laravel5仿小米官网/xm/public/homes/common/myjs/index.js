jQuery(function(){
    //首页幻灯片效果
    $(".ui-wrapper").slide({
        //导航元素对象（鼠标的触发元素对象）
        titCell:'.ui-pager .ui-pager-item a',
        //切换元素的包裹层对象
        mainCell:'#J_homeSlider',
        //前一个
        prevCell:'.ui-prev',
        nextCell:'.ui-next',
        interTime:3600,
        autoPlay:true,
        titOnClassName:"active",
        effect:"fold",
        trigger:"click"
    });

    //小米明星单品
    $('.xm-plain-box').slide({
        prevCell:".box-hd .more .control-prev",
        nextCell:".box-hd .more .control-next",
        mainCell:".xm-carousel-list",
        autoPage:true,
        effect:"left",
        autoPlay:false,
        vis:5,
        scroll:5,
        trigger:"click",
        pnLoop:false
    });

    //产品划过效果
    $('.brick-item').hover(function(){
        $(this).addClass('brick-item-active');
    },function(){
        $(this).removeClass('brick-item-active');
    })    

    //tab切换
    $(".J_itemBox").slide({
        trigger:"click",
        titCell:'.tab-list li',
        titOnClassName:"tab-active",
        mainCell:'.tab-container',
    });


})