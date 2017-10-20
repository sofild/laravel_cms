import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import NewsList from '@/components/NewsList'
import NewsEdit from '@/components/NewsEdit'

Vue.use(Router)

export default new Router({
  routes: [
    { path: '/', name: 'Home', component: Home },
    { path: '/news/list/:id', name: 'NewsList', component: NewsList },
    { path: '/news/edit/:id', name: 'NewsEdit', component: NewsEdit }
  ]
})
