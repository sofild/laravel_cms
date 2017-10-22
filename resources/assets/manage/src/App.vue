<template>
   <div class="layout">
     <Menu ref="mainMenu" mode="horizontal" theme="dark" :active-name="main_menu_id" @on-select="getMenu">
       <div class="layout-logo">后台管理</div>
       <div class="layout-nav">
         <MenuItem v-for="(m, key) in menus" :name="m['sm_id']">{{ m['sm_name'] }} - {{ m['sm_id'] }}</MenuItem>
       </div>
     </Menu>
     <div class="layout-breadcrumb">
       <Breadcrumb>
         <BreadcrumbItem href="" v-for="item in breadcrumb">{{ item }}</BreadcrumbItem>
       </Breadcrumb>
     </div>
     <div class="layout-content">
        <Row>
          <Col span="5" className="layout-menu">
          <Menu ref="leftMenu" :active-name="active_menu" :open-names="open_menu" width="auto" @on-select="changeMenu">
            <Submenu v-for="(s, index) in sub_menus[0]" :name="s.sme_id">
              <template slot="title">
                <Icon type="navicon-round"></Icon>
                {{ s.sme_title }} - {{ s.sme_id }}
              </template>
              <MenuItem v-for="(item, index) in sub_menus[s.sme_id]" :name="s.sme_id+'-'+item.sme_id">
                {{item.sme_title.length > 45 ? item.sme_title.substring(0,40)+'...' : item.sme_title}} - {{ s.sme_id }}-{{ item.sme_id }}
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
import cookie from 'js-cookie'
import Home from './components/Home.vue'
import NewsList from './components/NewsList.vue'
import NewsEdit from './components/NewsEdit.vue'
export default {
  name: 'app',
  components: {
    Home,
    NewsList,
    NewsEdit
  },
  data () {
    return {
      uinfo: window.DATA.uinfo,
      menus: window.DATA.menu,
      breadcrumb: ['首页'],
      sub_menus: [],
      open_menu: [],
      active_menu: 0,
      main_menu_id: [1]
    }
  },
  mounted () {
    // 主菜单ID
    let mm = cookie.get('main_menu_id')
    if (mm) {
      this.main_menu_id = [mm]
      this.$nextTick(() => {
        this.$refs.mainMenu.updateActiveName()
      })
      console.log(this.main_menu_id)
    }
    // 左侧菜单
    if (this.sub_menus.length > 0) {
      return
    }
    let sm = JSON.parse(cookie.get('sub_menus'))
    if (sm === [] || !sm) {
      this.$router.push('/')
      return
    }
    this.sub_menus = sm
    // 当前选中的菜单
    let cm = cookie.get('active_menu')
    if (cm) {
      this.active_menu = cm
    }
    // 打开的菜单
    let om = cookie.get('open_menu')
    if (om) {
      this.open_menu = [om]
    }
    this.$nextTick(() => {
      this.$refs.leftMenu.updateOpened()
      this.$refs.leftMenu.updateActiveName()
    })
    console.log(this.open_menu, this.active_menu)
    // 面包屑
    let breadcrumb = cookie.get('breadcrumb')
    if (breadcrumb) {
      this.breadcrumb = JSON.parse(breadcrumb)
    }
  },
  methods: {
    getMenu: function (id) {
      this.main_menu_id = id
      cookie.set('main_menu_id', id)
      this.sub_menus = this.menus[id]['child']
      cookie.set('sub_menus', JSON.stringify(this.sub_menus))
      this.breadcrumb = [this.menus[id]['sm_name']]
    },
    changeMenu: function (name) {
      if (name) {
        let names = name.split('-')
        let parentId = names[0]
        let active = names[1]
        let parentData = this.getMenuInfo(this.sub_menus[0], parentId)
        let data = this.getMenuInfo(this.sub_menus[parentId], active)
        if (data) {
          let path = data.sme_path
          this.$router.push(path)
          this.active_menu = name
          this.open_menu = [parentId]
          cookie.set('active_menu', this.active_menu)
          cookie.set('open_menu', parentId)
          let title1 = parentData.sme_title
          let title2 = data.sme_title
          if (this.breadcrumb.length > 1) {
            this.breadcrumb.splice(1)
          }
          this.breadcrumb.push(title1, title2)
          cookie.set('breadcrumb', JSON.stringify(this.breadcrumb))
        }
      }
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
    },
    getMenuInfo (data, id) {
      let info = {}
      for (var i in data) {
        if (parseInt(data[i].sme_id) === parseInt(id)) {
          return data[i]
        }
      }
      return info
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
  .layout-menu {
    min-height:500px;
  }
</style>
