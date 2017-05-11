import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'joke',
  template: `<nav></nav><div style="height:87px"></div><div *ngFor="let count of counts">
             <joke_data [count]="count"></joke_data><div style="height:10px;background: whitesmoke"></div>
             </div><footer></footer>`,
})

export class JokeComponent implements OnInit{
  counts:Array<number>;
  type:string;
  constructor(private _activatedRouter:ActivatedRoute){
    this.counts=[0,1,2,3,4,5,6,7]
  }
  ngOnInit(){
    this.type=this._activatedRouter.snapshot.params['type']
  }
}
