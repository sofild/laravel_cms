<template>
    <div class="layout-content">
        <Row>
            <div class="fb">
                <router-link to="/news/edit/0">
                    <Button type="info">发布文章</Button>
                </router-link>
            </div>
        </Row>
        <Row>
            <template>
                <Table :columns="columns" :data="data"></Table>
                <Page :total="total" :on-change="changePage"></Page>
            </template>
        </Row>
    </div>
</template>
<script>
    import $Modal from 'iview/src/components/modal'
    export default {
      name: 'NewsList',
      components: {
      },
      data () {
        return {
          columns: [
            {
              title: '标题',
              key: 'title',
              render: (h, params) => {
                return h('div', [
                  h('Icon', {
                    props: {
                      type: 'person'
                    }
                  }),
                  h('strong', params.row.name)
                ])
              }
            },
            {
              title: '图片',
              key: 'pic'
            },
            {
              title: '描述',
              key: 'description'
            },
            {
              title: '添加时间',
              key: 'addtime'
            },
            {
              title: '操作',
              key: 'action',
              width: 150,
              align: 'center',
              render: (h, params) => {
                return h('div', [
                  h('Button', {
                    props: {
                      type: 'primary',
                      size: 'small'
                    },
                    style: {
                      marginRight: '5px'
                    },
                    on: {
                      click: () => {
                        this.edit(params.index)
                      }
                    }
                  }, '编辑'),
                  h('Button', {
                    props: {
                      type: 'error',
                      size: 'small'
                    },
                    on: {
                      click: () => {
                        this.remove(params.index)
                      }
                    }
                  }, '删除')
                ])
              }
            }
          ],
          data: [],
          page: 1,
          total: 0,
          cate_id: 0
        }
      },
      beforeMount () {
          let path = this.$route.path
          let pathInfo = path.split('/')
          let cate_id = parseInt(pathInfo[3])
          if (cate_id > 0) {
            this.cate_id = cate_id
            this.getList(cate_id)
          }
      },
      methods: {
        getList: function (cate_id) {
          $.ajax({
            type: 'get',
            dataType: 'json',
            data: {'action': 'get_list', cate_id: cate_id, page: this.page},
            url: 'http://' + document.location.host + '/manage/news'
          }).done((resp) => {
            if (resp.status === 1000) {
              this.data = resp.info
              this.total = resp.total
            } else {
              this.$Message.error(resp.msg)
            }
          }).fail((resp) => {
            this.$router.push({name:'error_500'})
          })
        },
        changePage(page){
          this.page = page
          this.getList(this.cate_id)
        },
        edit: function (index) {
          var id = this.data[index]['id']
          this.$router.push({
              name: 'news_edit',
              params: {id: id}
          });
        },
        remove: function (index) {
          let id = this.data[index]['id']
          $.ajax({
              type: 'get',
              dataType: 'json',
              data: {'action': 'del', id: id},
              url: 'http://' + document.location.host + '/manage/news'
          }).done((resp) => {
              if (resp.status === 1000) {
                this.$Message.success('删除成功！')
                this.data.splice(index, 1)
              } else {
                this.$Message.error(resp.msg)
              }
          }).fail((resp) => {
              this.$router.push({name:'error_500'})
          })

        },
        release: function (id) {
          let data = {}
          data.id = id
          data.template = 2
          this.$emit('go', data)
        }
      }
    }
</script>
<style scoped>
 .fb{text-align:left; margin-bottom:10px;}
</style>
