import {Component, OnInit, OnDestroy} from '@angular/core';
import {Jsonp, URLSearchParams} from "@angular/http";
import {ToutiaoApiService} from "../toutiaoApi.service";
import {ActivatedRoute} from "@angular/router";
@Component({
  selector:'article',
  template:`<div class="top"><div><a href="#" onclick="javascript:window.history.back();return false;"><img style="height: 40px;width: 40px" src="../../../images/back.png" onmouseover="this.src='../../../images/back_1.png'" onmouseout="this.src='../../../images/back.png'">
            </a></div><div class="avatar_source"><img style="width: 35px;height: 35px" src="{{avatar_url}}"><span style="margin-left: 10px">{{source}}</span></div><div><img [routerLink]="['/toutiao/all']" style="height:35px;width:35px;margin-right:10px" src="../../../images/wxb.png"></div></div><div style="height:80px"></div>
            <div class="article">
                <div class="title">{{title}}</div>
                <div class="center">
                    <div class="asp">
                        <div><img src="{{avatar_url}}"></div>
                        <div><p class="source">{{source}}</p><p class="publish_time">{{publish_time|date:'H:mm'}}</p></div>
                    </div>
                    <div class="guanzhu"><button>关注</button></div>
                </div>
                <div class="content" [innerHTML]="content" style="overflow: hidden">{{content}}</div>
            </div>
            <div *ngFor="let count of counts"><comments [group_id]="group_id" [item_id]="item_id" [count]="count"></comments></div>`,
  styleUrls:['article.component.css']
})
export class ArticleComponent implements OnInit,OnDestroy{
  counts:Array<number>=[0,1,2,3,4,5,6,7,8];
  url:string;
  data:any;
  content:string;
  title:string;
  source:string;
  publish_time:number;
  avatar_url:string;
  group_id:number;
  item_id:number;
  private sub_1:any;
  private sub_2:any;
  constructor(private jsonp:Jsonp, private _activatedRoute:ActivatedRoute){}
  ngOnInit(){
    this.sub_1=this._activatedRoute.params.subscribe(params=>this.group_id=params['group_id']);
    this.sub_2=this._activatedRoute.params.subscribe(params=>this.item_id=params['item_id']);
    this.url=this._activatedRoute.snapshot.params['url'];

    //获取文章内容数据
    let Url_1 = 'http://m.toutiao.com/'+'i'+this.url+'/info/';
    //let Url='http://m.toutiao.com/i6417278187348165121/info/';
    let params_1 = new URLSearchParams();
    params_1.set('action', 'opensearch');
    params_1.set('format', 'json');
    params_1.set('callback', 'JSONP_CALLBACK');
    return this.jsonp
      .get(Url_1, {search: params_1})
      .map(res=>res.json().data).subscribe(response=>(console.log(response),this.content=response.content,
        this.title=response.title,this.source=response.source,this.publish_time=response.publish_time,
        this.avatar_url=response.media_user.avatar_url
      ));
  }
  ngOnDestroy(){
    this.sub_1.unsubscribe();
    this.sub_2.unsubscribe();
  }
}
