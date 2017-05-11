import {Routes, RouterModule} from "@angular/router";
import {NavComponent} from "./nav";
import {EntertainmentComponent} from "./entertainment/entertainment.component";
import {EntertainmentDataComponent} from "./entertainment/entertainment_data.component";
import {FooterComponent} from "./footer/footer.component";
import {ArticleComponent} from "./article/article.component";
import {AllComponent} from "./all/all.component";
import {JokeDataComponent} from "./joke/joke_data.component";
import {JokeComponent} from "./joke/joke.component";
import {CommentsComponent} from "./article/comments.component";
import {ChannelComponent} from "./channel/channel.component";
import {SearchComponent} from "./search/search.component";





export const rootRouterConfig: Routes=[
  {
    path: 'nav',
    component: NavComponent
  },
  {
    path: 'toutiao/entertainment',
    component: EntertainmentComponent
  },
  {
    path:'toutiao/all',
    component: AllComponent
  },
  {
    path: 'entertainment_data',
    component: EntertainmentDataComponent
  },
  {
    path: 'footer',
    component: FooterComponent
  },
  {
    path: 'article/:url/:group_id/:item_id',
    component: ArticleComponent
  },
  {
    path: 'joke_data',
    component:JokeDataComponent
  },
  {
    path: 'toutiao/joke',
    component:JokeComponent
  },
  {
    path: 'comments',
    component:CommentsComponent
  },
  {
    path: 'channel',
    component:ChannelComponent
  },
  {
    path: 'search',
    component:SearchComponent
  }
];
