$(function(){
    var CheckboxLen = $('.J_itemCheckbox').length;
    //减少数量操作
    $('.J_minus').on('click',function(){
        var _this,item,$skuid,num,$num;
        _this = $(this);
        // if(_this.data('ck')){
        //     return;
        // }
        // _this.data('ck',!0);
        
        //获取所在行
        item = $(this).parents('.item-box');
        $skuid = $(this).siblings('input').attr('name');
        num = $(this).siblings('input').val()
        $num = parseInt(num);

        if(!$.isNumeric(num)){
            alert('请填写数字');
            return;
        }
         
        if($num>1){
            $num--;
            $(this).siblings('input').val($num)
        }else{
            return;
        }
        //发送一个ajax请求
        $.ajax({
            url:'/cart/addproduct',
            type:'GET',
            data:{id:$skuid,num:$num},
            dataType:"json",
            success: function(data){
                if(data.status==0){
                    changeATotal(item,data);
                    //更改总价
                    if(listItem.length == CheckboxLen){
                        changeAllTotal();
                    }
                }else{
                    alert(data.msg);
                }
                // _this.data('ck',!1);
            }

        });
    })
    //增加操作
    $('.J_plus').on('click',function(){
        var _this,item,$skuid,num,$num;
        _this = $(this);
        // if(_this.data('ck')){
        //     return;
        // }
        // _this.data('ck',!0);
      
        //获取所在行
        item = $(this).parents('.item-box');
        $skuid = $(this).siblings('input').attr('name');
        num = $(this).siblings('input').val()
        $num = parseInt(num);

        if(!$.isNumeric(num)){
            alert('请填写数字');
            return;
        }
         
        if($num>0){
            $num++;
            $(this).siblings('input').val($num)
        }else{
            return;
        }
        //发送一个ajax请求
        $.ajax({
            url:'/cart/addproduct',
            type:'GET',
            data:{id:$skuid,num:$num},
            dataType:"json",
            success: function(data){
                if(data.status==0){
                    changeATotal(item,data);                    
                    //更改总价
                    if(listItem.length == CheckboxLen){
                        changeAllTotal();
                    }
                }else{
                    alert(data.msg);
                }
                // _this.data('ck',!1);
            }

        });
    })
    //删除操作
    $('.J_delGoods').on('click',function(){
        var item,cartid,skuid;
        //获取所在行
        item = $(this).parents('.item-box');
        skuid = item.find('.J_cartGoods').data('sid');
        cartid = item.data('cid');
        $.ajax({
            url:'/cart/delcart',
            data:{id:cartid},
            dataType:'json',
            success:function(data){
                if(data.status==0){
                    item.slideUp(100,function(){
                        item.remove();
                        //初始化数据
                        CheckboxLen = $('.J_itemCheckbox').length;
                        $.each(listItem,function(i,v){
                            if(v==skuid){
                                listItem.splice(i,1);
                            }
                        })
                        changeAllTotal();
                    })
                }else{
                    alert(data.msg);
                }
            }

        });
    })
    //改变小计
    function changeATotal(item,data){
        item.find('.col-total').text(data.total+'元');
        item.find('.col-price').text(data.price+'元');
    }
    /** 
    * 改变总计
    */
    function changeAllTotal(){
        $.ajax({
            url:'/cart/all-total',
            data:{"listItem":listItem.join('__')},
            type:'GET',
            dataType:'json',
            success:function(data){
                if(data.status==0){
                    $('#J_cartTotalPrice').html(data.total);
                }else{
                    alert(data.msg);
                    $('#J_cartTotalPrice').html(0);
                }
            },
            beforeSend:function(){
                //格式化总价格
                $('#J_cartTotalPrice').html('<div style="width:20px;display:inline-block;"><div class="loader"></div></div>');
            }
        });

    }

    $('.J_itemCheckbox').on('click',function(){
              
        //改变全选状态

        $(this).toggleClass('icon-checkbox-selected');

        $('.J_itemCheckbox').each(function(i,v){
            var sid = $(v).parents('.J_cartGoods').data('sid');
            // console.log(i+'-'+i,sid,$.inArray(sid,listItem));
            if($(v).hasClass('icon-checkbox-selected')){
                ($.inArray(sid,listItem)<0)&&listItem.push(sid)
            }else{
                $.each(listItem,function(i,v){
                    if(v==sid){
                        listItem.splice(i,1);
                        //改变全选状态
                        $('#J_selectAll').removeClass('icon-checkbox-selected');
                    }
                })
            }
           
        })
        if(listItem.length == CheckboxLen){
            $('#J_selectAll').addClass('icon-checkbox-selected');
        }
        
    })
});