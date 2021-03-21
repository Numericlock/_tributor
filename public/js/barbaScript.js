import barba from '@barba/core';
import barbaPrefetch from '@barba/prefetch';

barba.use(barbaPrefetch);

// 同じurlの場合、ページ遷移をさせない
const eventDelete = e => {
  if (e.currentTarget.href === window.location.href) {
    e.preventDefault()
    e.stopPropagation()
    return
  }
}
const links = [...document.querySelectorAll("a[href]")];
links.forEach(link => {
  link.addEventListener(
    "click",
    e => {
      eventDelete(e);
    },
    false
  );
});

// 遷移時固有Class書き換え
barba.hooks.afterLeave((data) => {
  var nextHtml = data.next.html;
  var response = nextHtml.replace(/(<\/?)body( .+?)?>/gi, '$1notbody$2>', nextHtml)
  var bodyClasses = $(response).filter('notbody').attr('class')
  $('body').attr('class', bodyClasses);
});

// 画面遷移処理
let mask = document.querySelector(".mask");
barba.init({
  transitions: [
    {
      beforeEnter() {
        const scrollElem = document.scrollingElement || document.documentElement
        scrollElem.scrollTop = 0;
          //遷移後の処理追記
      },
      async leave() {
        mask.classList.add('active');
        await new Promise(resolve => {
          return setTimeout(resolve, 1000);
        });
      },
      afterEnter() {
        mask.classList.remove('active');
      }
    }
  ]
});