import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする

import HomeComponent from "./components/HomeComponent";
import ListsComponent from "./components/ListsComponent";
import timelineComponent from "./components/timelineComponent";
import PostModal from './components/postModal'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home.timeline',
            component: HomeComponent
        },
        {
            path: '/lists',
            name: 'lists.list',
            component: ListsComponent
        },
    ]
});

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router