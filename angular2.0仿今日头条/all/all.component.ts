import {Component, OnInit} from '@angular/core';


@Component({
  selector: 'all',
  template: `<nav></nav><div style="height:87px"></div>
             <div *ngFor="let count of counts"><all_data></all_data></div>
             <footer></footer>`,
  styleUrls: ['all.component.css']
})
export class AllComponent implements OnInit{
  ngOnInit(){
  }
  counts:Array<number>=[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14];
}
