$(function(){
	/*收藏夹功能 start*/
	$("#favorite_wb").click(function() {
		var h = "http://"+location.hostname;
		var j = location.title;
		try {
			window.external.addFavorite(h, j);
		} catch (i) {
			try {
				window.sidebar.addPanel(j, h, "");
			} catch (i) {
				alert("对不起，您的浏览器不支持此操作！\n请您使用菜单栏或Ctrl+D收藏丽子。");
			}
     	}
	})
	/*收藏夹功能 end*/
	/*顶部下拉 strat*/
	$(".J_userInfo").on("mouseenter",".user",function(){
		$('.user-menu').slideDown(200);
		$(this).addClass("user-active");
	}).on("mouseleave",".user",function(){
		$('.user-menu').slideUp(200);
		$(this).removeClass("user-active");
	})
	/*顶部下拉 end*/

	/*购物车弹出 strat*/
	$("#ECS_CARTINFO").on("mouseenter",function(){
		$(this).addClass("topbar-cart-active")
		$(this).find(".cart-menu").slideDown();
	}).on("mouseleave",function(){
		$(this).removeClass("topbar-cart-active");
		$(this).find(".cart-menu").stop().slideUp(300,function(){
			$(".cart-section").removeClass("cart-section-on")
		});
	})
	/*购物车弹出 end*/
	
	/*搜索框效果*/
	$(".header-search .search-text").focus(function(){
		$("#searchForm").addClass("search-form-focus");
	}).blur(function(){
		if($(this).val().length==0){
			$("#searchForm").removeClass("search-form-focus");
		}
	});
	
	/*分类树导航鼠标移入效果*/
	$("#site-category-list").on("mouseenter",".category-item",function(){
		$(this).addClass("category-item-current");
	}).on("mouseleave",".category-item",function(){
		$(this).removeClass("category-item-current");
	});
	
	/*分类树子菜单数目对6取余，重置子菜单宽度*/
	$("#site-category-list .category-item").each(function(index, element) {
        var childnum=$(this).find(".children-list li").length;
		var col=Math.ceil(childnum/6);
		if(col>1){
			$(this).find(".children").addClass("children-col-"+col);	
		}
    });
	
	
	/*分类树导航鼠标移入效果 start*/	
	$(".nav-category-section").on("mouseenter",".nav-category-item",function(){
		$(this).addClass("current")
	}).on("mouseleave",".nav-category-item",function(){
		$(this).removeClass("current")
	})
	
	$nav_num = $("ul.children-list").find('li');
	if($nav_num.length>8){
		$('.nav-category-children').addClass('nav-category-children-col-2')
	}else{
		$('.nav-category-children').removeClass('nav-category-children-col-2')
	}
	/*分类导航鼠标移入效果 end*/	
	
	/*首页导航分类树效果*/
	$(".nav-category").mouseenter(function(){
		$(this).find(".category-hidden").show();
	}).mouseleave(function(){
		$(this).find(".category-hidden").hide();
	});
	
	/*首页导航下拉子菜单*/
	var t1;
	var t2;
	var t3;
	//鼠标经过导航
	$(".header-nav li.nav-item").mouseenter(function(){
		clearTimeout(t3);
		clearTimeout(t2);
		$(this).addClass("nav-item-active");
		var nav_list=$(this).find(".item-children .children-list");
		if(!$("#J_navMenu").hasClass("header-nav-menu-active")){
			$("#J_navMenu").addClass("header-nav-menu-active");
		}
		$("#J_navMenu").find(".container").html(nav_list.clone());//复制ul
		t1=setTimeout(function(){
			$("#J_navMenu").slideDown(200);//子菜单显示
		},200);
	});
	//鼠标离开导航
	$(".header-nav li.nav-item").mouseleave(function(){
		clearTimeout(t1);
		$(this).removeClass("nav-item-active");
		t2=setTimeout(function(){
			$("#J_navMenu").slideUp(200);//子菜单隐藏
		},200);
	});
	//鼠标经过子菜单
	$("#J_navMenu").mouseenter(function(){
		clearTimeout(t2);
	});
	//鼠标离开子菜单
	$("#J_navMenu").mouseleave(function(){
		t3=setTimeout(function(){
			$("#J_navMenu").slideUp(200);//子菜单隐藏
		},200);
	});
	
	
	
	
	/*首页底部视频*/
	$("#video .video-list a").click(function(){
		var wh=$(window).height();
		var url=$(this).attr("data-video");
		var title=$(this).parents(".video-item").find("h3.title a").html();
		var bgclass="modal-backdrop fade in";
		var bg=$("<div class='"+bgclass+"' style='width:100%; height:"+wh+"px;'></div>");
		bg.appendTo($("body"));
		$("#J_modalVideo h3.title").html(title);
		$("#J_modalVideo iframe").attr("src",url);
		$("#J_modalVideo").show().css({opacity:0}).animate({opacity:1}).addClass("in");
	});
	$("#J_modalVideo a.close").click(function(){
		$("#J_modalVideo").removeClass("in");
		$("#J_modalVideo").css({opacity:0});
		var f=setTimeout(function(){
			  $("#J_modalVideo").hide()
			  $(".modal-backdrop").fadeOut(300,function(){$(this).remove()});
			},300);
		
	});
	
	
	/*列表页 属性图片 幻灯片*/
	$(".J_attrImg").slide({
		mainCell:".J_imgList",
		autoPage:true,
		effect:"left",
		autoPlay:false,
		vis:5,
		scroll:5,
		trigger:"click",
		pnLoop:false
	});
	
	
	//登录注册页
	
	
});

