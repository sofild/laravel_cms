<template>
    <div class="layout-content">
        <Row>
            <div class="fr">
                <router-link to="/new/edit/0">
                    <Button type="info">发布文章</Button>
                </router-link>
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
    export default {
      name: 'NewsList',
      components: {

      },
      data () {
        return {
          columns: [
            {
              title: '姓名',
              key: 'name',
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
              title: '年龄',
              key: 'age'
            },
            {
              title: '地址',
              key: 'address'
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
                        this.show(params.index)
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
          data: [
            {
              name: '王小明',
              age: 18,
              address: '北京市朝阳区芍药居'
            },
            {
              name: '张小刚',
              age: 25,
              address: '北京市海淀区西二旗'
            },
            {
              name: '李小红',
              age: 31,
              address: '上海市浦东新区世纪大道'
            },
            {
              name: '周小伟',
              age: 27,
              address: '深圳市南山区深南大道'
            }
          ]
        }
      },
      methods: {
        show: function (index) {
          this.$Modal.info({
            title: '用户信息',
            content: `姓名：${this.data[index].name}<br>年龄：${this.data[index].age}<br>地址：${this.data[index].address}`
          })
        },
        remove: function (index) {
          this.data.splice(index, 1)
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
 .fr{text-align:right;}
</style>
