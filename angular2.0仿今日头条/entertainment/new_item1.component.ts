import {Component, OnInit, Input} from '@angular/core';
declare var $: any;
@Component({
  selector:'new_item1',
  template:``,
})
export class NewItem1Component implements OnInit{
  //@Input()
  //@Input() indexs:any=[];
  ngOnInit(){
    $.getJSON("http://toutiao.com/api/article/recent/?source=2&category=__all__&as=A105177907376A5&cp=5797C7865AD54E1&count=1&offset=0&_=1481986412&callback=?",
        function (data) {
          console.log(data);
          //api获取到数据
          var title;
          var images;
          var origin;
          var comments;
          var large_image;
          var time;
          var middle_image
          var url;
          var time;
             title = data.data[1].title;
             images = data.data[1].image_list;
             origin = data.data[1].media_name;
             comments = data.data[1].comments_count;
             time = data.data[1].create_time;
             large_image = data.data[1].large_image_list;
             middle_image = data.data[1].middle_image;
             url = data.data[1].article_url;
            var times = new Date(time);
            var h = times.getHours() + ':';
            var m = times.getMinutes() + ':';
            var s = times.getSeconds();
            var date = h + m + s;
            if (images.length > 0) {
              $('body').append("<div class='hot1'>" + "</div>");
              $('.hot1').append("<a id='images' href='#'>" + "</a>");
              $('a').html("<div class='article'>" + "</div>");
              $('.article').html("<span>" + title + "</span>");
              $('a').append("<div class='images'></div>");
              $('.images').html("<img src=" + images[0].url + ">" + "<img src=" + images[1].url + ">" + "<img src=" + images[2].url + ">");
              $('a').append("<div class='bottom'>" + "</div>");
              //$('.images').append();
              $('.bottom').html("<span class='origin'>" + origin + "</span>" + "<span class='comments'>" + comments + "</span>" + "<span class='time'>" + date + "</span>");
            }
            if (!(images.length > 0) && large_image) {
              var large_images = large_image[0].url;
              $('body').append("<div class='hot2'>" + "</div>");
              $('.hot2').html("<a id='large_image' href='#'>" + "</a>");
              $('a').html("<div class='left'>" + "div");
              $('.left').html("<div class='article'>" + "</div>");
              $('.article').html("<span>" + title + "</span>");
              $('.left').append("<div class='bottom'>" + "</div>");
              $('.bottom').html("<span class='origin'>" + origin + "</span>" + "<span class='comments'>" + comments + "</span>");
              $('a').append("<div class='large_image'>" + "<img src=" + large_images + ">" + "</div>");
            }
            if (!(images.length > 0) && large_image==null && middle_image) {
              var middle_images = middle_image.url;
              $('body').append("<div class='hot2'>" + "</div>");
              $('.hot2').html("<a id='large_image' href='#'>" + "</a>");
              $('a').html("<div class='left'>" + "div");
              $('.left').html("<div class='article'>" + "</div>");
              $('.article').html("<span>" + title + "</span>");
              $('.left').append("<div class='bottom'>" + "</div>");
              $('.bottom').html("<span class='origin'>" + origin + "</span>" + "<span class='comments'>" + comments + "</span>");
              $('a').append("<div class='large_image'>" + "<img src=" + middle_images + ">" + "</div>");
            }

            //样式
            $('.hot1').css({"background": "snow", "margin-left": "15px", "margin-right": "15px"});
            $('a').css({"text-decoration": "none", "list-style": "none", "color": "black"});
            $('#images').css({"display": "flex", "flex-direction": "column"});
            $('.article').css({
              "margin-top": "15px",
              "margin-left": "0",
              "margin-right": "0",
              "font-size": "20px",
              "font-family": "宋体"
            });
            $('.images').css({
              "display": "flex",
              "flex-direction": "row",
              "justify-content": "space-between",
              "align-items": "center"
            });
            $('img').css({"width": "32%", "max-height": "100px", "margin-top": "10px"});
            $('.origin').css({"float": "left", "margin-top": "10px", "margin-bottom": "10px"});
            $('.comments').css({
              "float": "left",
              "margin-top": "10px",
              "margin-left": "15px",
              "margin-bottom": "10px"
            });
            $('.time').css({
              "float": "right",
              "margin-top": "10px",
              "margin-bottom": "10px",
              "margin-right": "15px"
            });
            $('.hot2').css({"background": "snow", "margin-left": "15px", "margin-right": "15px"});
            $('.left').css({"width": "70%"});
            $('#large_image').css({"display": "flex", "flex-direction": "row"});
            $('.large_image').css({"width": "32%", "margin-left": "10px", "margin-bottom": "10px"});
            $('.large_image img').css({"float": "right", "width": "100%", "max-height": "100px"});
    });
  }
}
