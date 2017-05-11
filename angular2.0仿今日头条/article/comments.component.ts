import {Component, OnInit, Input} from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {Jsonp, URLSearchParams} from "@angular/http";
import {forEach} from "@angular/router/src/utils/collection";

@Component({
  selector: 'comments',
  template: `<div class="comments">
            <div *ngIf="avatar_url!=null" class="left"><img src="{{avatar_url}}"></div>
            <div *ngIf="avatar_url==null" class="left"><img src="../../../images/no-pic.jpg"></div>
            <div class="right"><div class="name_digg"><span style="color:skyblue">{{name}}</span>
            <div class="digg"><img  style="width:20px;height:20px" src="{{src}}">{{digg_count}}</div></div>
            <div class="text">{{text}}</div><div class="time_reply"><span id="create_time">1小时前·</span>
            <span class="reply_count">{{reply_count}}回复</span></div>
            </div></div>
            `,
  styleUrls: ['comments.component.css']
})

export class CommentsComponent implements OnInit {
  @Input() group_id: number;
  @Input() item_id: number;
  @Input() count:number;

  constructor(private jsonp: Jsonp, private _activatedRoute: ActivatedRoute) {}
  text: string;
  digg_count: number;//点赞数
  avatar_url: string;//用户头像
  name: string;//用户名
  reply_count: number;//回复量
  create_time: string;//发布时间
  src:string='../../../images/good.png';
  ngOnInit() {

    let Url = 'http://toutiao.com/api/comment/list/?group_id='+this.group_id+'&item_id='+this.item_id+'&offset=0&count=10';
    //let Url = 'http://www.toutiao.com/api/comment/list/?group_id=6417953335403757825&item_id=6417955671328686594&offset=0&count=10';
    let params = new URLSearchParams();
    params.set('action', 'opensearch');
    params.set('format', 'json');
    params.set('callback', 'JSONP_CALLBACK');
    return this.jsonp
      .get(Url, {search: params})
      .map(res => res.json().data.comments[this.count])
      .subscribe(response => (console.log(response),this.text=response.text,this.digg_count=response.digg_count,
        this.reply_count=response.reply_count,this.create_time=response.create_time,this.name=response.user.name,
        this.avatar_url=response.user.avatar_url));

    /**
     *
     * @param event
     * @returns {boolean}

     hasData(event: number) {
    this.length_0 = this.dongtai_id.length;
    let i = 0;
    for (; i < this.length_0; i++) {
      if (this.dongtai_id[i] != event) {
        i++;
      }
      else if (this.dongtai_id[i] == event) {
        return false;
      }
    }
    if (i == this.length_0)
      return true;
  }*/
  }
}
