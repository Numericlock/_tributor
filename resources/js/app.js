

//
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('header-component', HeaderComponent);
//Vue.component('navigator-component', NavigatorComponent);
//Vue.component('sidebar-component', SidebarComponent);
//Vue.component('timeline-component', timelineComponent);
//Vue.component('post-modal', PostModal);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from 'vue'
// ルーティングの定義をインポートする
import router from './router'
// ルートコンポーネントをインポートする
import App from './App.vue'

new Vue({
  el: '#app',
  router, // ルーティングの定義を読み込む
  components: { App }, // ルートコンポーネントの使用を宣言する
  template: '<App />' // ルートコンポーネントを描画する
})