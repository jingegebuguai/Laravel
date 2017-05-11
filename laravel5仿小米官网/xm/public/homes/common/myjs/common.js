$(function(){
     //购物车划过效果
    ~function($){
        $('#J_miniCartTrigger').hover(function(){
            $(this).addClass('topbar-cart-active');
            $('#J_miniCartMenu').stop().slideDown(200,function(){
                //触发ajax发送请求获取购物车数据

            });
        },function(){
            $(this).removeClass('topbar-cart-active');
            $('#J_miniCartMenu').stop().slideUp(200);
        });
    }($);
   

    //网站导航鼠标划过显示
    ~function($){
       //获取导航
        var j_menu = $('#J_navMenu');
        var cont = j_menu.find('.container');
        //记录网站导航划过定时器
        var timer = null;
        $('.J_navMainList').on('mouseenter','.nav-item',function(){

            var self = $(this),obj = null;

            //判断是否已经触发过鼠标移入事件
            $('.J_navMainList').data('toggled',!0);
            //添加划过的样式
            self.addClass('nav-item-active');
            if(self.find('.children-list').length){
               obj = self.find('.children-list').clone();
                //显示主图
                obj.find('img').each(function(){
                    $(this).attr('src',$(this).attr('data-src'));
                }) ;
                cont.html(obj);                    
                timer = setTimeout(function(){
                    j_menu.stop(!0, !1).slideDown(200);
                },200)
            }else{
                j_menu.stop(!0, !1).slideUp(200);
            }

        }).on('mouseleave','.nav-item',function(){
            timer && (clearTimeout(timer),timer = null )
            var self = $(this);
            //移出划过样式
            self.removeClass('nav-item-active');
            timer = setTimeout(function(){
                j_menu.slideUp(200);
            },200)
        });

        j_menu.on({
            mouseenter: function() {
                timer && (clearTimeout(timer),timer = null );
            },
            mouseleave: function() {
                timer = setTimeout(function() {
                    j_menu.slideUp()
                }
                , 200)
            }
        })
    }($);
 

    //搜索框
    ~function($){
        var $search,$form,$list,$result,$cont,$words;
        $search = $('#search');
        $form = $('#J_searchForm');
        $words = $form.find('.search-hot-words');
        // if($form.length){
        //     $list = $('<div id="J_keywordList" class="keyword-list hide"><ul class="result-list"></ul></div>');
        //     $cont = $list.find('>ul');
        //     $list.appendTo($form);
        // }
        $search.on({
            click:function(){
                $form.addClass('search-form-focus');
                // if(!$form.data('oneClick')){
                //     getResultList($cont);
                // }
                $form.data('oneClick',true);
                $list.removeClass('hide'),$words.addClass('hide');

            },
            blur:function(){
                $form.removeClass('search-form-focus');
                $list.addClass('hide'),$words.removeClass('hide');
            }
        });

        // function getResultList($cont){
        //     var arr = [1,2,3,4,5,6];
        //     var str = '';
        //     for(var i=0;i<arr.length;i++){
        //         str += '<li data-key="小米手机5"><a href="#">小米手机5<span class="result">约有11件</span></a></li>';
        //         console.log(i)
        //     }
        //     $cont.html(str);
        // }
    }($);
    
    //分类导航
    ~function($,cate){
        function dealCateNavHtml(arr){
            
            if(arr.length){
                var temp = '<div class="site-category"> <ul id="J_categoryList" class="site-category-list clearfix">';
                for(var i=0;i<arr.length;i++){
                    temp+= '<li class="category-item">';
                        temp+= '<a class="title" href="/list?id='+arr[i]['data']['id']+'">';
                            temp+=arr[i]['data']['title']+' <i class="iconfont"></i>';
                        temp+= '</a>';
                        temp+= '<div class="children clearfix children-col-2"  style="width:'+265*Math.ceil(arr[i]['child'].length/7)+'px;">';
                            temp+= '<ul class="children-list children-list-col children-col-1">';
                                for(var j=0;j<arr[i]['child'].length;j++){
                                    temp+= '<li class="star-goods">';
                                        temp+= '<a class="link" href="/detail?id='+arr[i]['child'][j]["id"]+'">';
                                            temp+= '<img class="thumb" src="'+arr[i]['child'][j]["img"]+'" width="40" height="40" alt="">';
                                            temp+= '<span class="text">'+arr[i]['child'][j]["title"]+'</span>';
                                        temp+= '</a>';
                                        // temp+= '<a class="btn btn-line-primary btn-small btn-buy" href="'+arr['child'][j]["id"]+'" data-stat-id="79cf129bec5862f2">选购</a>',
                                    temp+= '</li>';
                                    if(j%6==0&&j!=0){
                                        temp+= '</ul><ul class="children-list children-list-col children-col-1">';
                                    }
                                }
                            temp+= '</ul>';
                        temp+= '</div>';
                    temp+= '</li>';
                }
                temp+='</ul></div>';
                $('#J_navCategory').append(temp);
            }
        }
        dealCateNavHtml(cate);
        $('#J_categoryList').find('.category-item').on({
            mouseenter: function(){
                $(this).addClass('category-item-active');
            },
            mouseleave: function(){
                $(this).removeClass('category-item-active');
            }
        });
        //console.log($('#J_navCategory').find('.link-category').css('visibility'));
        //分类导航划过显示
        $('#J_navCategory').on({
            mouseenter:function(){

                if($(this).find('.link-category').css('visibility')!='hidden'){
                    $('.site-category').show();
                }
                
            },
            mouseleave:function(){
                
                if($(this).find('.link-category').css('visibility')!='hidden'){
                    $('.site-category').hide();
                }
            }
        })

    }($,cate);

    //点击播放视频
    ~function($){
        var $v = $('#J_modalVideo');
        $('.J_videoTrigger').on('click',function(e){
            e.preventDefault();
            var newTitle = $(this).attr('data-video-title');
            $v.find('.modal-hd').find('.title').html(newTitle).end().end().find('.modal-bd').html('<iframe width="880" height="536" src="'+$(this).data('video')+'" frameborder="0" allowfullscreen=""></iframe>');
            $v.fadeIn(200).addClass('in');
            $('<div class="modal-backdrop fade in" style="width:100%; height:100%"></div>').appendTo('body').off('click').on('click',function(){
                $v.find('.close').trigger('click');
            });
        })
        $v.find('.close').on('click',function(){
            $v.removeClass("in").fadeOut(200,function(){
                $('.modal-backdrop').remove();
                $v.find('iframe').attr('src','');
            });
            
        })
    }($);

    //生成网站主导航
    ~function($){
        //处理导航数据
        function dealNavData(navData){
            var str = '';
            for(var i=0;i<navData.length;i++){
                str +='<li class="nav-item">';
                    str +='<a class="link" href="javascript:void(0);">';
                            str +='<span class="text">'+navData[i].title+'</span>';
                            str +='<span class="arrow"></span>';
                        str +='</a>';
                        str +='<div class="item-children">';
                            str +='<div class="container">';
                                str +='<ul class="children-list clearfix">';
                                for(var j=0;j<navData[i]['info'].length;j++){
                                    str +='<li class="first">';
                                        str +='<div class="figure figure-thumb">';
                                            str +='<a href="/detail?id='+navData[i]['info'][j]['good_id']+'">';
                                                str +='<img src="'+navData[i]['info'][j]['img']+'" width="160" height="110">';
                                            str +='</a>';
                                        str +='</div>';
                                        str +='<div class="title">';
                                            str +='<a href="'+navData[i]['info'][j]['good_id']+'">'+navData[i]['info'][j]['title']+'</a>';
                                        str +='</div>';
                                        str +='<p class="price">'+navData[i]['info'][j]['price']+'</p>';
                                    str +='</li>';
                                }   
                                str +='</ul>';
                            str +='</div>';
                        str +='</div>';
                    str +='</li>';
            }
            $('.J_navMainList').append(str);
        }
        dealNavData(navData);
    }($,navData);
    

    //鼠标滑过显示个人中心菜单效果
    $('#J_userInfo').on('mouseenter','.user',function(){
        $(this).addClass('user-active');
        $(this).find('.user-menu').stop().slideDown(200);
    }).on('mouseleave','.user',function(){
        $(this).removeClass('user-active');
        $(this).find('.user-menu').stop().slideUp(200);
    })


    
});
