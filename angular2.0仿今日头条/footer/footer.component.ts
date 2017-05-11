import {Component, OnInit} from '@angular/core';
@Component({
  selector: 'footer',
  template: `<div class="footer">
  <a href="#"><div class="wxb"><img src='../../../images/wxb.png' onmouseover="this.src='../../../images/wxb_1.png'" onmouseout="this.src='../../../images/wxb.png'"><p>首页</p></div></a>
  <a href="#"><div class="refresh"><img src="../../../images/refresh.png" onmouseover="this.src='../../../images/refresh_1.png'" onmouseout="this.src='../../../images/refresh.png'"/><p>刷新</p></div></a>
  <a href="#"><div class="favorite"><img src="../../../images/favorite_1.png" onmouseover="this.src='../../../images/favorite.png'" onmouseout="this.src='../../../images/favorite_1.png'"/><p>收藏</p></div></a>
  <a href="#"><div class="account"><img src="../../../images/account_1.png"onmouseover="this.src='../../../images/account.png'"onmouseout="this.src='../../../images/account_1.png'"/><p>登陆</p></div></a>
</div>`,
  styleUrls: ['footer.component.css']
})
export class FooterComponent implements OnInit{
  ngOnInit(){

  }
}
