import {Component, OnInit} from "@angular/core";

import {Jsonp, URLSearchParams} from "@angular/http";
@Component({
  selector: 'search',
  template: ``,
  styleUrls: ['search.component.css']
})
export class SearchComponent implements OnInit{
  title:string;
  text:string='游戏';
  constructor(private jsonp:Jsonp){}
  ngOnInit(){
    let Url = 'http://www.toutiao.com/search_content/?offset=0&format=json&keyword='+this.text+'&autoload=true&count=20&cur_tab=1';
    let params = new URLSearchParams();
    params.set('action', 'opensearch');
    params.set('format', 'json');
    params.set('callback', 'JSONP_CALLBACK');
    return this.jsonp
      .get(Url, {search: params})
      .map(res=>res.json())
      .subscribe(response=>console.log(response))
  }
}
