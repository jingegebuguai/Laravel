import {NgModule, ModuleWithProviders}            from '@angular/core';
import { BrowserModule }       from '@angular/platform-browser';
import {ReactiveFormsModule} from '@angular/forms';
import { AppComponent }   from './app.component';
import {RouterModule} from "@angular/router";
import {NavComponent} from './nav';
import {HttpModule, JsonpModule} from "@angular/http";
import {rootRouterConfig} from "./app.routes";
import {NewItem1Component} from "./entertainment/new_item1.component";
import {EntertainmentComponent} from "./entertainment/entertainment.component";
import {EntertainmentDataComponent} from "./entertainment/entertainment_data.component";
import {ToutiaoApiService} from "./toutiaoApi.service";
import {FooterComponent} from "./footer/footer.component";
import {ArticleComponent} from "./article/article.component";
import {AllComponent} from "./all/all.component";
import {AllDataComponent} from "./all/all_data.component";
import {JokeDataComponent} from "./joke/joke_data.component";
import {JokeComponent} from "./joke/joke.component";
import {CommentsComponent} from "./article/comments.component";
import {ChannelComponent} from "./channel/channel.component";
import {ShareService} from "./share.service";
import {SearchComponent} from "./search/search.component";


let rootRouterModule:ModuleWithProviders=RouterModule.forRoot(rootRouterConfig);
@NgModule({
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    HttpModule,
    rootRouterModule,
    JsonpModule,
  ],
  providers:[ToutiaoApiService,ShareService],
  declarations: [
    AppComponent,
    NavComponent,
    NewItem1Component,
    EntertainmentDataComponent,
    EntertainmentComponent,
    FooterComponent,
    ArticleComponent,
    AllComponent,
    AllDataComponent,
    JokeDataComponent,
    JokeComponent,
    CommentsComponent,
    ChannelComponent,
    SearchComponent
  ],


  bootstrap: [ AppComponent ]
})
export class AppModule { }
