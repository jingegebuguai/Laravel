import {Component, OnInit, Injectable, Input, OnDestroy} from '@angular/core';
import {JsonpModule} from "@angular/http";
import 'rxjs/add/operator/map';
import {ToutiaoApiService} from "app/toutiaoApi.service";
import {ActivatedRoute} from "@angular/router";
@Component({
  selector:'entertainment_data',
  styleUrls:['entertainment_data.component.css'],
  template:`
  <div *ngIf="image_length>0" class="hot">
    <a id="images" [routerLink]="['/article',urlSlice(),display_urlSlice(),urlSlice()]">
      <div class="title">
        <span>{{title}}</span>
      </div>
      <div class="images">
        <img src="{{image_list[0].url}}">
        <img src="{{image_list[1].url}}"/>
        <img src="{{image_list[2].url}}"/>
      </div>
      <div>
        <span class="source">{{source}}</span>
        <span class="comments">{{comments}}评论</span>
        <span class="time">{{datetime}}</span>
      </div>
    </a>
  </div>
  <div *ngIf="image_length==0&&(middle_image_1||middle_image_2)" class="hot2">
    <a id="large_image" [routerLink]="['/article',urlSlice(),display_urlSlice(),urlSlice()]">
      <div class="left">
        <div class="title">
          <span>{{title}}</span>
        </div>
        <div style="position:absolute;bottom:10px;">
          <span class="source_1">{{source}}</span>
          <span class="comments_1">{{comments}}</span>
        </div>
      </div>
      <div class="large_image" *ngIf="middle_image_2!=null">
        <img src="{{middle_image_2}}"/>
      </div>
      <div class="large_image" *ngIf="middle_image_2==null">
        <img src="{{middle_image_1}}" />
      </div>
    </a>
  </div>
  <!--div *ngIf="image_list.length!==0&&large_image!==null" class="hot2">
    <a id="large_image" href="#">
      <div class="left">
        <div class="title">
          <span>{{title}}</span>
        </div>
        <div style="position:absolute;bottom:10px">
          <span class="source_1">{{source}}</span>
          <span class="comments_1">{{commnets}}</span>
        </div>
      </div>
      <div class="large_image">
        <img src="{{large_image}}"/>
      </div>
    </a>
  </div-->

`,
  providers:[JsonpModule, ToutiaoApiService]
})

export class EntertainmentDataComponent implements OnInit{
  @Input() count:any;
  comments:number;//评论
  title:string;//标题
  image_list:any;
  middle_image_1:string;//中图
  middle_image_2:string;
  large_image:string;//大图
  source:string;//来源
  article_genre:string;//类型(video、article)
  datetime:string; //时间戳
  item_seo_url:string;//文章内容url
  data:any;
  seo_url:string;
  type:string;//新闻类型
  image_length:number;
  length:string;//
  display_url:string;//显示评论有关信息
  keywords:string;
  private sub:any;//设置订阅变量
  constructor(private toutiaoApiservice:ToutiaoApiService,private _activatedRoute:ActivatedRoute){}
  ngOnInit() {
    //获取url参数Observable
    /*this.sub=this._activatedRoute.params.subscribe(params=>{
     this.type=params['type'];
     });
     */
    /*通过快照snapshot获取url参数
     this.type = this._activatedRoute.snapshot.params['type'];
     */

    //获取娱乐新闻数据

    this.toutiaoApiservice.searchEntertainment().map(res => {
      if (res.json().data[4].article_genre == "gallery")
        return res.json().data[4];
      else if (res.json().data[6].article_genre == "article")
        return res.json().data[6];
    })
      .subscribe(response => (console.log(response), this.title = response.title, this.comments = response.comments_count,
        this.source = response.source, this.article_genre = response.article_genre, this.image_list = response.image_list,
        this.datetime = response.datetime, this.item_seo_url = response.item_seo_url, this.data = response, this.seo_url = response.seo_url,
        this.middle_image_1 = response.middle_image, this.middle_image_2 = response.middle_image.url, this.image_length = response.image_list.length,
        this.display_url = response.display_url,this.keywords=response.keywords))

  }

  /**
   * 获取url的id号
   * @returns {string}
   */
  urlSlice(){
      if(this.seo_url.length==22) {
        return this.seo_url.slice(2, this.seo_url.length - 1);
      }
      else if(this.item_seo_url.length==26){
        return this.item_seo_url.slice(6,this.item_seo_url.length-1)
      }
      else if(this.item_seo_url.length==27){
        return this.item_seo_url.slice(7,this.item_seo_url.length-1)
      }
      else if(this.item_seo_url.length>27){
        return this.item_seo_url.slice(6,24)
      }
  }

  display_urlSlice(){
    return this.display_url.slice(this.display_url.length-20,this.display_url.length-1);
  }

}
