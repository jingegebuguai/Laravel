$(function(){
	/*更多按钮*/
	$(".filter-list-wrap .J_filterToggle").click(function(){
		$(this).parents(".filter-list-wrap").toggleClass("filter-list-wrap-toggled");
	});
	
	/*商品单品鼠标经过小图*/
	$("body").on("mouseenter",".thumb-list li",function(){
		var dataconfig=eval('(' + $(this).attr("data-config") + ')');
		$(this).parents(".goods-item").find(".figure-img img").attr("src",dataconfig.figure);
		$(this).addClass("active").siblings().removeClass("active");
	});
	$(".goods-item").mouseenter(function(){
		$(this).addClass("active");
	}).mouseleave(function(){
		$(this).removeClass("active");
	})
	
	/*组合搜索列表*/
	$(".filter-list").each(function(index, element) {
        var childnum=$(this).find("dd").length;
		var row=Math.ceil(childnum/6);
		if(row>1){
			$(this).parent().find(".more").show();
			$(this).find(".children").addClass("filter-list-row"+row);	
		}
    });
	
	
	
	/*为你推荐 轮播切换*/
	$("#J_renovateWrap").slide({
		titCell:".xm-pagers",
		mainCell:".xm-carousel-list",
		titOnClassName:"pager-active",
		autoPage:true,
		effect:"left",
		easing:"easeOutCirc",
		scroll:5,
		vis:5,
		trigger:"click"
	});
	
})