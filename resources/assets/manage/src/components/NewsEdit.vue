<template>
    <div class="layout-content">
        <Form :model="formRight" label-position="right" :label-width="100">
            <FormItem label="标题">
                <Input v-model="news.title"></Input>
            </FormItem>
            <FormItem label="代表图">
                <Upload action="/manage/upload" name="upload" :headers="headers" :on-success="uploadSuccess" :format="['jpg','jpeg','png']" :max-size="2048">
                    <Button type="ghost" icon="ios-cloud-upload-outline">上传图片</Button>
                </Upload>
            </FormItem>
            <FormItem label="描述">
                <Input v-model="news.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
            </FormItem>
            <FormItem label="内容">
                <div id="content"></div>
            </FormItem>
            <FormItem label="作者">
                <Input v-model="news.author"></Input>
            </FormItem>
            <FormItem>
                <Button type="primary" @click="save()">提交</Button>
                <Button type="ghost" @click="reset()" style="margin-left: 8px">重置</Button>
            </FormItem>
        </Form>
    </div>
</template>
<script>
    import $ from 'jquery'
    import E from 'wangeditor'
    import $Msg from 'iview/src/components/message'
    export default {
      name: 'NewsEdit',
      components: {
      },
      data () {
        return {
          news: {},
          editor: null
        }
      },
      computed: {
        headers () {
          return {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }
      },
      beforeMount () {
        let path = this.$route.path
        let pathInfo = path.split('/')
        let id = parseInt(pathInfo[2])
        if (id > 0) {
          this.news = this.getNew(id)
        }
      },
      mounted () {
        this.editor = new E('#content')
        this.editor.create()
        this.editor.txt.html(this.news.content)
      },
      methods: {
        getNew: function (id) {
          $.ajax({
            type: 'post',
            dataType: 'json',
            data: {'action': 'get_new', id: id},
            url: 'http://' + document.location.host + '/manage/news'
          }).done((resp) => {
            if (resp.err === 0) {
              this.news = resp.info
            } else {
              $Msg.warning(resp.msg)
            }
          }).fail((resp) => {
            $Msg.error('获取信息失败：服务器错误')
          })
        },
        uploadSuccess: function (response, file, fileList) {
          if (response.status === 1000) {
            this.data.pic = response.path
          } else {
            $Msg.error(response.msg)
          }
        },
        save: function () {
          this.data.content = this.editor.txt.html()
          if (!this.data.title) {
            $Msg.error('请填写标题！')
            return
          }
          this.data.action = 'save'
          this.data._token = $('meta[name="csrf-token"]').attr('content')
          $.ajax({
            type: 'post',
            dataType: 'json',
            data: this.data,
            url: 'http://' + document.location.host + '/manage/news'
          }).done((resp) => {
            if (resp.err === 0) {
              $Msg.success(resp.msg)
            } else {
              $Msg.warning(resp.msg)
            }
          }).fail((resp) => {
            $Msg.error('获取信息失败：服务器错误')
          })
        },
        reset: function () {

        }
      }
    }
</script>
