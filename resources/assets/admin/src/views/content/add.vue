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
      name: 'Edit',
      components: {
      },
      data () {
        return {
          news: {},
          editor: null,
          //cate_id: 0,
          id: 0
        }
      },
      props:[
        'cate_id'
      ],
      computed: {
        headers () {
          return {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }
      },
      beforeMount () {
        console.log(this.cate_id)
        let cate_id = this.cate_id > 0 ? this.cate_id : 0
        if(cate_id===0){
            cate_id = parseInt(this.$route.query.cate_id)
            this.cate_id = cate_id
        }
        this.editor = new E('#content')
        this.editor.customConfig.uploadImgServer = '/manage/upload'
        this.editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024
        this.editor.customConfig.uploadImgParams = {
            _token: $('meta[name="csrf-token"]').attr('content')
        }
        this.editor.customConfig.uploadImgParamsWithUrl = true
        this.editor.customConfig.uploadFileName = 'upload'
        this.editor.create()
      },
      methods: {
        uploadSuccess: function (response, file, fileList) {
          if (response.status === 1000) {
            this.news.pic = response.path
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
          this.news.action = 'save'
          this.news.cate_id = this.cate_id
          this.news._token = $('meta[name="csrf-token"]').attr('content')
          $.ajax({
            type: 'post',
            dataType: 'json',
            data: this.news,
            url: 'http://' + document.location.host + '/manage/news'
          }).done((resp) => {
            if (resp.status === 1000) {
              $Msg.success(resp.msg)
            } else {
              $Msg.warning(resp.msg)
            }
          }).fail((resp) => {
            $Msg.error('获取信息失败：服务器错误')
          })
        },
        reset: function () {
          this.news.title = '';
          this.news.description = '';
          this.news.content = '';
          this.news.author = '';
          this.editor.txt.clear();
        },
        initEditor: function () {

        }
      }
    }
</script>
<style scoped>
    .content{
        background: #fff;
    }
</style>
