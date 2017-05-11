var addressBox = '<div class="address-edit-box">';
addressBox += '<div class="box-main">';
addressBox += '<div class="form-section">';
addressBox += '<label class="input-label" for="user_name" data-title="姓名">姓名</label>';
addressBox += '<input class="input-text J_addressInput" type="text" id="user_name" name="user_name" placeholder="收货人姓名">';
addressBox += '</div>';
addressBox += '<div class="form-section">';
addressBox += '<label class="input-label" for="user_phone" data-title="手机号">手机号</label>';
addressBox += '<input class="input-text J_addressInput" type="text" id="user_phone" name="user_phone" placeholder="11位手机号">';
addressBox += '</div>';
addressBox += '<div class="form-section form-select-2 clearfix">';


addressBox += '<div class="xm-select select-province">';
addressBox += '<div class="dropdown">';
addressBox += '<label class="iconfont" for="J_province"></label>';
addressBox += '<select name="province" id="J_province">';
addressBox += '<option value="0">省份/自治区</option>';
addressBox += '</select>';
addressBox += '</div>';
addressBox += '</div>';
addressBox += '<div class="xm-select select-city">';
addressBox += '<div class="dropdown">';
addressBox += '<label class="iconfont" for="J_city"></label>';
addressBox += '<select name="city" id="J_city" disabled="">';
addressBox += '<option value="0">城市/地区</option>';
addressBox += '</select>';
addressBox += '</div>';
addressBox += '</div>';
addressBox += '</div>';
addressBox += '<div class="form-section clearfix">';

addressBox += '<div class="xm-select select-county">';
addressBox += '<div class="dropdown">';
addressBox += '<label class="iconfont" for="J_county"></label>';
addressBox += '<select name="county" id="J_county" disabled="">';
addressBox += '<option value="0">区/县</option>';
addressBox += '</select>';
addressBox += '</div>';
addressBox += '</div>';
addressBox += '<div class="xm-select select-area hide">';
addressBox += '<div class="dropdown">';
addressBox += '<label class="iconfont" for="J_area"></label>';
addressBox += '<select name="county" id="J_area" disabled="">';
addressBox += '<option value="0">配送区域</option>';
addressBox += '</select>';
addressBox += '</div>';
addressBox += '</div>';
addressBox += '</div>';
addressBox += '<div class="form-section">';
addressBox += '<label class="input-label" for="user_adress" data-title="详细地址">详细地址</label>';
addressBox += '<textarea class="input-text J_addressInput" type="text" id="user_adress" name="user_adress" placeholder="详细地址，路名或街道名称，门牌号"></textarea>';
addressBox += '</div>';
addressBox += '<div class="form-section">';
addressBox += '<label class="input-label" for="user_zipcode" data-title="邮政编码">邮政编码</label>';
addressBox += '<input class="input-text J_addressInput" type="text" id="user_zipcode" name="user_zipcode">';
addressBox += '</div>';
addressBox += '</div>';
addressBox += '<div class="form-confirm clearfix">';
addressBox += '<a href="javascript:void(0);" class="btn btn-primary" id="J_save" data-stat-id="12e61678358c83eb" >保存</a>';
addressBox += '<a href="javascript:void(0);" class="btn btn-gray" id="J_cancel" data-stat-id="51d8900b7a3585e5" >取消</a>';
addressBox += '</div>';
addressBox += '</div>';
//存储用户输入数据
var inpData = {};
!function($){

    function create(fn){
        $("#J_modalEditAddress").find(".modal-body").html(addressBox);
    }
    // c()
    $(function(){
        create();
    });
    $("#J_modalEditAddress").on('focus','.J_addressInput',function(){
        $(this).parents('.form-section').addClass('form-section-focus form-section-active');
        $(this).parents('.form-section').find('.msg').remove();

    }).on('blur','.J_addressInput',function(){
        var len = $.trim($(this).val());
        if(len){
            $(this).parents('.form-section').removeClass('form-section-focus');
            return;
        }
        $(this).parents('.form-section').removeClass('form-section-focus form-section-active');
    })
    $('#J_newAddress').on('click',function(){
        //第一次点击 添加市到选框中
        !$(this).data('init')&&(data_init(data),$(this).data('init',!0));
        //初始化数据信息
        inpData = {};
        //初始化地址信息
        init_address()
        $('<div class="modal-backdrop">').appendTo('body').addClass('fade in');
        $('#J_modalEditAddress').fadeIn(250,function(){
            $(this).addClass('in').removeClass('hide');

        }).css({
            top: $(this).offset().top - 10,
            left:$(this).offset().left - 33
        });
    });

    $('#J_modalEditAddress').on('click','#J_cancel',function(){
        $('.modal-backdrop').removeClass('fade in')
        $('#J_modalEditAddress').fadeOut(150,function(){
            $(this).removeClass('in').addClass('hide').removeAttr('aria-hidden');
            $('.modal-backdrop').remove();
        });
    })

    function data_init(data){
        var len,str;
        len = data.length;
        str = '';
        // str += '<option value="0">省份/自治区</option>';
        for(var i=0;i<len;i++){
            str += '<option pid="0" value="'+data[i].id+'">'+data[i].name+'</option>';
        }
        $('#J_province').append(str);
    }

    function data_init_city(data,index){
        // if(!index)return;
        var len,str;
        len = data[index]['child'].length;
        str = '';
        str += '<option value="0">城市/地区</option>';
        for(var i=0;i<len;i++){
            str += '<option pid="'+index+'" value="'+data[index]['child'][i].id+'">'+data[index]['child'][i].name+'</option>';
        }
        $('#J_city').empty().prop('disabled',!1).append(str);
    }
    function data_init_country(data,index,subindex){
        // if(!subindex)return;
        var len,str;
        len = data[index]['child'][subindex]['child'].length;
        str = '';
        str += '<option value="0">区/县</option>';
        for(var i=0;i<len;i++){
            str += '<option pid="0" value="'+data[index]['child'][subindex]['child'][i].id+'">'+data[index]['child'][subindex]['child'][i].name+'</option>';
        }
        $('#J_county').empty().prop('disabled',!1).append(str);
    }
    function init_address()
    {
        $('#J_county').empty().prop('disabled',!0).html('<option value="0">区/县</option>');
        $('#J_city').empty().prop('disabled',!0).html('<option value="0">城市/地区</option>');
        $(".J_addressInput").each(function(i,v) {
            $(v).val('');
            $(v).parents('.form-section').removeClass('form-section-error form-section-active form-section-focus')
        });
    }
    //省市选择
    $('#J_modalEditAddress').on('change','#J_province',function(){
        var index = $(this).find('option:selected').index()-1;
        if(index>-1){
            data_init_city(data,index);
            inpData.province = $(this).find('option:selected').text();
        }else{
            inpData.province = '';
        }
        // console.log(inpData);

    })
    //市选择
    $('#J_modalEditAddress').on('change','#J_city',function(){
        var index = $('#J_province').val()-1;
        var subindex = $(this).find('option:selected').index()-1;
        if(subindex>-1){
            data_init_country(data,index,subindex);
            inpData.city = $(this).find('option:selected').text();

        }else{
            inpData.city = '';
        }
        // console.log(inpData);
    })
    //区县选择
    $('#J_modalEditAddress').on('change','#J_county',function(){
        var index = $(this).find('option:selected').index()-1;
        if(index>-1){
            inpData.country = $(this).find('option:selected').text();
        }else{
            inpData.country = '';
        }
        // console.log(inpData);
    })



    function regInput(inp){
        if(!inp.length){ return; }
        var reg,name = inp.attr('name'),n,
            val = $.trim(inp.val());
        n = inpData;
        if(name == 'user_name'){
            reg = /^[a-zA-Z\u4e00-\u9fa5·]+$/;
            if(val.length<2||val.length>20){
                showerror(inp, ["收货人姓名，最少2个最多20个中文字"]);
                return !1;
            }
            if(!reg.test(val)){
                showerror(inp, ["收货人姓名不正确（只能是英文、汉字）"]);
                return !1;
            }
            n.uname = val;
        }else if ("user_phone" === name) {
            reg = /^1[0-9]{10}$/;
            if (!reg.test(val)){
                showerror(inp, ["请输入正确的手机号"]);
                return !1;
            }
            n.phone = val;
        } else if ("user_adress" === name) {
            val = val.replace(/</g, "").replace(/>/g, "").replace(/\//g, "").replace(/\\/g, "");
            reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            var d = /^\d+$/
                , o = /^[0-9a-zA-Z]+$/;
            if (val.length < 5 || val.length > 32){
                showerror(inp, ["详细地址长度不对，最小为 5 个字，最大32个字"]);
                return !1;
            }
            if (reg.test(val) || d.test(val) || o.test(val)){
                showerror(inp, ["详细地址不正确"]);
                return !1;
            }
            n.address = val;
        } else if ("user_zipcode" === name) {
            reg = /^\d{6}$/;
            if (!reg.test(val)){
                showerror(inp, ["邮编是6位数字"]);
                return !1;
            }
            n.zipcode = val
        }
        return !0
    }
    // $(".J_addressInput").trigger("error", ["邮编是6位数字"]);
    function showerror(inp,data){
        inp.parents('.form-section').addClass('form-section-focus form-section-active form-section-error');
        // if(!inp.siblings('.msg').length){
        //     inp.parents('.form-section').append('<p class="msg msg-error">'+data[0]+'</p>');
        // }else{
        //     inp.siblings('.msg').html(data[0]);
        // }
        inp.parents('.form-section').find('.msg').remove().end().append('<p class="msg msg-error">'+data[0]+'</p>');

    }


    $('#J_modalEditAddress').on('click','#J_save',function(){
        $(".J_addressInput").each(function() {
            return e = regInput($(this)),e ? void 0 : !1;
        });
        if(e&&inpData.province&&inpData.city&&inpData.country){
            $.ajax({
                url:'/address/add',
                data:inpData,
                dataType:'json',
                success:function(data){
                    if(data.status==0){
                        createAddress(inpData,data.msg)
                        $('#J_cancel').trigger('click');
                    }else{
                        alert(data.msg);
                    }

                }
            });
        }else if(!(inpData.province&&inpData.city&&inpData.country)){
            showerror($('#user_adress'), ["请选择省市区"]);
        }
    })

    //生成新的收货地址
    function createAddress(data,aid){
        var html = '';
        html += '<div class="address-item J_addressItem selected">';
        html += '<dl><dt><em class="uname">这些擦</em></dt>';
        html += '<dd class="utel">12312312312</dd>';
        html += '<dd class="uaddress"></dd></dl>';
        html += '<div class="actions">';
        html += '<!--<a href="javascript:void(0);" data-id="1" class="modify J_addressModify">修改</a>--><a href="javascript:void(0);" class="modify J_addressDel">删除</a>';
        html += '</div></div>';

        var $newAddress = $(html).insertAfter($('#J_newAddress'));

        $newAddress.data('address_id',aid);
        $newAddress.data('consignee',data.uname);
        $newAddress.data('tel',data.phone);
        $newAddress.data('province_name',data.province);
        $newAddress.data('city_name',data.city);
        $newAddress.data('district_name',data.country);
        $newAddress.data('address',data.address);
        $newAddress.find('.uname').html(data.uname);
        $newAddress.find('.utel').html(data.phone);
        $newAddress.find('.uaddress').html(data.province+' '+data.city+' '+data.country+' <br>'+data.address);

        $('#J_confirmAddress').html(data.uname+' '+data.phone+'<br>'+data.province+' '+data.city+' '+data.country+' <br>'+data.address);
    }



    /**
     * 删除用户指定的地址
     */
    $('.J_addressList ').on('click.del','.J_addressDel',function(){
        //获取地址id
        var aid,_self,parents;
        _self = $(this);
        parents = _self.parents('.J_addressItem');
        aid = parents.data('address_id');
        $.ajax({
            url:'/address/del',
            data:{id:aid},
            type:'GET',
            dataType:'json',
            success:function(data){
                if(data.status==0){
                    parents.fadeOut(200,function(){
                        parents.remove();
                    })
                }else{
                    alert(data.msg);
                }
            }
        });
    });



}(window.jQuery);
