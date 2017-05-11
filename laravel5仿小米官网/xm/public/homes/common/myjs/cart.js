$(function(){
    var CheckboxLen = $('.J_itemCheckbox').length;

    //减少数量操作
    $('.J_minus').on('click',function(){
        changePrice(this,'minus');
     
    })
    //增加操作
    $('.J_plus').on('click',function(){
        changePrice(this,'plus');
    })
    //change
    $('.J_goodsNum').on('change keyup',function(){
        changePrice(this,'change');
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
            data:{id:cartid,'listItem':listItem},
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

                        changeAllTotal(data.alltotal);
                    })
                }else{
                    alert(data.msg);
                }
            }

        });
    })


    $('.J_itemCheckbox').on('click',function(){
              
        //改变全选状态

        $(this).toggleClass('icon-checkbox-selected');
        // console.log(this);
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
        $(this).parents('.J_cartGoods').find('.J_goodsNum').trigger('change');
        
    })
    //全选
    $('#J_selectAll').on('click',function(){
        $(this).toggleClass('icon-checkbox-selected');
        if($(this).hasClass('icon-checkbox-selected')){
            listItem = [];
            $('.J_goodsNum').each(function(i,v){
                $(v).parents('.item-table').find('.J_itemCheckbox').addClass('icon-checkbox-selected');
                listItem.push($(v).attr('name'));
            })
            //计算总价
            $('.J_goodsNum').eq(0).trigger('change');
        }else{
            $('.J_itemCheckbox').each(function(i,v){
                
                $(v).removeClass('icon-checkbox-selected');
                
            })
            //初始化
            listItem = [];
            $('#J_cartTotalPrice').html('0.0');
        }
        // console.log(listItem)
        
    });
    //改变小计
    function changeATotal(item,data){
        item.find('.col-total').text(data.total+'元');
        item.find('.col-price').text(data.price+'元');
    }
    /** 
    * 改变总计
    */
    function changeAllTotal(alltotal){
       $('#J_cartTotalPrice').html(alltotal);
    }

    //封装更改价格的函数
    function changePrice(obj,method){
        var _this,item,$skuid,num,$num;
        _this = $(obj);
        
        //获取所在行
        item = $(obj).parents('.item-box');
        $skuid = method=='change'?$(obj).attr('name'):$(obj).siblings('input').attr('name');
        num = method=='change'?$(obj).val():$(obj).siblings('input').val()
        $num = parseInt(num);

        if(!$.isNumeric($num)){
            alert('请填写数字');
            return;
        }
        switch(method){
            case 'minus':
                if($num>1){
                    $num--;
                    $(obj).siblings('input').val($num)
                }else{
                    return;
                }
            break;
            case 'plus':
                if($num>0){
                    $num++;
                    $(obj).siblings('input').val($num)
                }else{
                    return;
                }
            break;
            case 'change':
                if($num>0){
                    $(obj).siblings('input').val($num)
                }else{
                    return;
                }
            break;

        }
        

        //发送一个ajax请求
        $.ajax({
            url:'/cart/addproduct',
            type:'GET',
            data:{id:$skuid,num:$num,"listItem":listItem},
            dataType:"json",
            success: function(data){
                if(method!='minus'&&data.status==1){
                    item.find('.J_goodsNum').val(data.stock).trigger('change');

                }
                if(data.status==0){
                    !data.nofollow&&changeATotal(item,data);
                    //更改总价
                    $('#J_cartTotalPrice').html(data.alltotal);
                }else{
                    alert(data.msg);
                }
            },
            error:function(data){
                $('#J_cartTotalPrice').html(data.alltotal);
            },
            beforeSend:function(){
                if(item.find('J_itemCheckbox').hasClass('icon-checkbox-selected')){
                    //格式化总价格
                    $('#J_cartTotalPrice').html('<div style="width:20px;display:inline-block;"><div class="loader"></div></div>');
                }
                
            }

        });
    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //提交订单
    $('#J_goCheckout').on('click',function(){
        if($(this).hasClass('btn-disabled')){
            return;
        }
        if(!listItem.length){
            alert('未选择任何商品');
            return;
        }
        $.ajax({
            url:'/order/confirm',
            type:"POST",
            data:{listItem:listItem},
            dataType:'json',
            success:function(data){
                if(data.status ==0){
                    window.location.href = data.msg
                }else{
                    alert(data.msg);
                }
            }
        })
    })
});