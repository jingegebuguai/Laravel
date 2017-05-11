import {Component, OnInit, OnDestroy} from '@angular/core';
import {ShareService} from "../share.service";
import {ActivatedRoute} from "@angular/router";
import {subscribeOn} from "rxjs/operator/subscribeOn";

@Component({
  selector: 'nav',
  //templateUrl: 'nav.component.html',
  styleUrls:  ['nav.component.css'],
  template:`<div>
  <div class="header">
    <div class="top">
        <div ><img style="margin-left:15px" src="../../../images/email.png"></div>
        <div ><span>今日头条</span><img style="margin-top:5px" src="../../../images/refresh.png" onmouseover="this.src='../../../images/refresh_1.png'" onmouseout="this.src='../../../images/refresh.png'"></div>
        <div style="margin-right:15px"><img  src="../../../images/search.png" onmouseover="this.src='../../../images/search_1.png'" onmouseout="this.src='../../../images/search.png'"></div>
  </div>
    <div class="nav">
    <ul>
       <li *ngFor="let count of counts">
       <a [routerLink]="['/toutiao/'+lists[count]]" [queryParams]="{channel:channel,lists:lists}">{{channel[count]}}</a>
       </li>
       <li><a [routerLink]="['/channel']" [queryParams]="{channel:channel,lists:lists}">+</a></li>
     </ul>
  </div>
  </div>
</div>`
})
export class NavComponent implements OnInit, OnDestroy{
  channel:Array<string>;
  lists:Array<string>;
  counts:Array<number>=[0,1,2,3,4,5,6,7];
  private sub:any;
  constructor(private activatedRoute:ActivatedRoute){}
  ngOnInit(){

    //获取导航名数据
    this.sub=this.activatedRoute.queryParams.subscribe(
      params=> {
      this.channel=params['channel'];
      if(this.channel==['undefined']||this.channel==null) {
        this.channel = ['推荐', '热点', '国际', '娱乐', '美女', '段子'];
        console.log(this.channel);
      }
    });

    //获取导航url数据
    this.sub=this.activatedRoute.queryParams.subscribe(
      params=> {
        this.lists=params['lists'];
        if(this.lists==['undefined']||this.lists==null){
          this.lists=['all','hot','world','entertainment','beauty','joke'];
          console.log(this.lists);
        }
      }
    )}
  ngOnDestroy(){
    this.sub.unsubscribe();
  }
}
