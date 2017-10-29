<template>
    <div class="layout-content">
        <Row>
            <div class="fb">
                <Button type="info" @click="add_article">发布文章</Button>
            </div>
        </Row>
        <Row>
            <template>
                <Table :columns="columns" :data="data"></Table>
                <div class="page-tp10">
                    <Page :total="total" v-if="total>0" :on-change="changePage"></Page>
                </div>
            </template>
        </Row>
    </div>
</template>
<script>
    import $ from 'jquery'
    import $Modal from 'iview/src/components/modal'
    import util from '@/libs/util';
    export default {
      name: 'List',
      components: {
      },
      data () {
        return {
          columns: [
            {
              title: '标题',
              key: 'title'
            },
            {
              title: '图片',
              key: 'pic',
              render: (h, params) => {
                  return h('div', {
                    attrs: {
                      style: 'width: 40px;height: 40px;'
                    },
                  },
                  [h('img', {
                        props: {
                          type: 'primary',
                          size: 'small'
                        },
                        attrs: {
                          src: params.row.pic, style: 'width: 40px;height: 40px;border-radius: 2px;'
                        },
                        style: {
                        },
                      }),
                  ]);
              }
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
      props:[
         'cate_id'
      ],
      beforeMount () {
          let cate_id = this.cate_id > 0 ? this.cate_id : 0
          if (cate_id > 0) {
            this.getList(cate_id)
          }
      },
      methods: {
        getList: function (cate_id) {
          this.$Loading.start();
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
            this.$Loading.finish();
          }).fail((resp) => {
            this.$router.push({name:'error_500'})
            this.$Loading.error();
          })
        },
        changePage(page){
          this.page = page
          this.getList(this.cate_id)
        },
        edit: function (index) {
          var id = this.data[index]['id']
          this.$router.push({
              name: 'content_edit',
              query: {id: id}
          });
        },
        remove: function (index) {
          this.$Loading.start();
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
              this.$Loading.finish();
          }).fail((resp) => {
              this.$Message.error('获取信息失败：服务器错误')
              this.$Loading.error();
          })

        },
        release: function (id) {
          let data = {}
          data.id = id
          data.template = 2
          this.$emit('go', data)
        },
        add_article: function () {
            this.$router.push({
                name:'content_add',
                query: {cate_id: this.cate_id}
            })
        }
      }
    }
</script>
<style scoped>
 .fb{text-align:left; margin-bottom:10px;}
 .page-tp10{margin-top:10px;}
</style>
