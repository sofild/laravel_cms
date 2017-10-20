<template>
   <div class="layout">
     <Menu mode="horizontal" theme="dark" active-name="1">
       <div class="layout-logo"><a href="javascript:void(0);" @click.prevent="logout">退出登录</a></div>
       <div class="layout-nav">
         <MenuItem v-for="(m, key) in menus" @click.native="getMenu(m['sm_id'])">{{ m['sm_name'] }}</MenuItem>
       </div>
     </Menu>
     <div class="layout-breadcrumb">
       <Breadcrumb>
         <BreadcrumbItem>{{ breadcrumb }}</BreadcrumbItem>
       </Breadcrumb>
     </div>
     <div class="layout-content">
        <Row>
          <Col span="5">
          <Menu active-name="1-2" width="auto" :open-names="['1']">
            <Submenu v-for="(s, idx) in sub_menus[0]" :name="idx">
              <template slot="title">
                <Icon type="navicon-round"></Icon>
                {{ s.sme_title }}
              </template>
              <MenuItem v-for="(item, index) in sub_menus[s.sme_id]" :name="idx+'-'+index">
                <router-link :to="{path: '/news/list/'+item.sme_id}">{{item.sme_title.length > 45 ? item.sme_title.substring(0,40)+'...' : item.sme_title}}</router-link>
              </MenuItem>
            </Submenu>
          </Menu>
          </Col>
          <Col span="19">
            <router-view></router-view>
          </Col>
        </Row>
     </div>
   </div>
</template>

<script>
import $Msg from 'iview/src/components/message'
import $ from 'jquery'
import cache from 'js-cache'
import Home from './components/Home.vue'
import NewsList from './components/NewsList.vue'
export default {
  name: 'app',
  components: {
    Home,
    NewsList
  },
  data () {
    return {
      uinfo: window.DATA.uinfo,
      menus: window.DATA.menu,
      breadcrumb: '首页',
      sub_menus: [],
      template: 0
    }
  },
  beforeMount () {
    let sm = cache.get('sub_menus')
    console.log(sm)
    if (sm === [] || !sm) {
      this.$router.push('/')
      return
    }
    this.sub_menus = sm
  },
  methods: {
    getMenu: function (id) {
      this.sub_menus = this.menus[id]['child']
      cache.set('sub_menus', this.sub_menus, 60000)
      console.log(cache.get('sub_menus'))
    },
    logout: function () {
      $.ajax({
        type: 'post',
        dataType: 'json',
        data: {action: 'logout'},
        url: 'http://' + document.location.host
      }).done((resp) => {
        this.win = 1
        this.$emit('logout-return', this.win)
      }).fail((resp) => {
        $Msg.error('操作失败：服务器错误')
      })
    }
  }
}
</script>

<style>
.layout{
    border: 1px solid #d7dde4;
    background: #f5f7f9;
  }
  .layout-logo{
    width: 100px;
    height: 30px;
    background: #5b6270;
    border-radius: 3px;
    float: left;
    position: relative;
    top: 15px;
    left: 20px;
    line-height:30px;
    vertical-align: middle;
    color:#fff;
    padding-left:20px;
  }
  .layout-nav{
    width: 420px;
    margin: 0 auto;
  }
  .layout-assistant{
    width: 300px;
    margin: 0 auto;
    height: inherit;
  }
  .layout-breadcrumb{
    padding: 10px 15px 0;
  }
  .layout-content{
    min-height: 200px;
    margin: 15px;
    overflow: hidden;
    background: #fff;
    border-radius: 4px;
  }
  .layout-content-main{
    padding: 10px;
  }
  .layout-copy{
    text-align: center;
    padding: 10px 0 20px;
    color: #9ea7b4;
  }
  .height15{
    height:15px;
  }
</style>
