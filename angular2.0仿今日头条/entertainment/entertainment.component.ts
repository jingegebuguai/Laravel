import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'entertainment',
  template: `<nav></nav><div style="height:87px"></div>
             <div *ngFor="let count of counts"><entertainment_data [count]="count"></entertainment_data></div>
             <footer></footer>`,
  styleUrls: ['entertainment.component.css']
})
export class EntertainmentComponent{
  constructor(){}
  private sub:any;
  type:string;
  counts:Array<number>=[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14];
}
