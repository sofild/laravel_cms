<template>
    <div class="layout-content">
        <Row>
            <div class="fb">
                <Button type="info" @click="add">添加</Button>
            </div>
        </Row>
        <Row>
            <template>
                <Table :columns="columns" :data="data"></Table>
            </template>
        </Row>
    </div>
</template>
<script>
    import $ from 'jquery'
    import $Modal from 'iview/src/components/modal'
    export default {
      name: 'List',
      components: {
      },
      data () {
        return {
          columns: [
            {
              title: '姓名',
              key: 'username'
            },
            {
              title: '头像',
              key: 'avatar',
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
                          src: params.row.avatar, style: 'width: 40px;height: 40px;border-radius: 2px;'
                        },
                        style: {
                        },
                      }),
                  ]);
              }
            },
            {
              title: '手机',
              key: 'telphone'
            },
            {
              title: '岗位',
              key: 'job'
            },
            {
              title: '添加时间',
              key: 'addtime'
            },
            {
              title: '最近登录时间',
              key: 'logintime'
            },
            {
              title: '最近登录IP',
              key: 'loginip'
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
                  }, '修改'),
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
          data: []
        }
      },
      beforeMount () {
         this.getList()
      },
      methods: {
        getList: function () {
          this.$Loading.start();
          $.ajax({
            type: 'get',
            dataType: 'json',
            data: {'action': 'get_list'},
            url: 'http://' + document.location.host + '/manage/manager'
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
        edit: function (index) {
          var id = this.data[index]['id']
          this.$router.push({
              name: 'manager_edit',
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
              url: 'http://' + document.location.host + '/manage/manager'
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
        add: function () {
            this.$router.push({
                name:'manager_add',
            })
        }
      }
    }
</script>
<style scoped>
 .fb{text-align:left; margin-bottom:10px;}
</style>
