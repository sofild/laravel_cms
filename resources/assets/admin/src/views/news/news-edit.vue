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
                <div id="content" class="content"></div>
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
          editor: null,
          cate_id: 0,
          id: 0
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
        let cate_id = parseInt(pathInfo[3])
        console.log(cate_id)
        if (cate_id > 0) {
          this.cate_id = cate_id
          this.getNew(0, cate_id)
        }
      },
      methods: {
        getNew: function (id, cate_id) {
          $.ajax({
            type: 'get',
            dataType: 'json',
            data: {'action': 'get_new', id: id, cate_id: cate_id},
            url: 'http://' + document.location.host + '/manage/news'
          }).done((resp) => {
            console.log(resp)
            if (resp.status === 1000) {
              this.news = resp.info
              console.log(this.news)
              this.editor = new E('#content')
              this.editor.create()
              this.editor.txt.html(this.news.content)
            } else {
              $Msg.warning(resp.msg)
            }
          }).fail((resp) => {
            this.$router.push({name:'error_500'})
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
          if (!this.news.title) {
            $Msg.error('请填写标题！')
            return
          }
          this.news.content = this.editor.txt.html()
          console.log(this.news.content)
          this.news.action = 'save'
          this.news.cate_id = this.cate_id
          this.news._token = $('meta[name="csrf-token"]').attr('content')
          console.log(this.cate_id, this.news._token)
          $.ajax({
            type: 'post',
            dataType: 'json',
            data: this.news,
            url: 'http://' + document.location.host + '/manage/news/save'
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
<style scoped>
    .content{
        background: #fff;
    }
</style>
