<template>
    <div class="layout-content">
        <Form :model="formRight" label-position="right" :label-width="100">
            <FormItem label="网站标题">
                <Input v-model="setting.title"></Input>
            </FormItem>
            <FormItem label="ICON图标">
                <Upload action="/manage/upload" name="upload" :headers="headers" :on-success="uploadSuccess" :format="['ico']" :max-size="512">
                    <Button type="ghost" icon="ios-cloud-upload-outline">上传ICON</Button>
                </Upload>
                <span v-if="hasIcon"><i class="ivu-icon ivu-icon-document"></i> {{ setting.icon }}</span>
            </FormItem>
            <FormItem label="网站描述">
                <Input v-model="setting.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
            </FormItem>
            <FormItem label="网站关键词">
                <Input v-model="setting.keywords"></Input>
            </FormItem>
            <FormItem label="统计代码" v-if="access===0">
                <Input v-model="setting.code"></Input>
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
    import $Msg from 'iview/src/components/message'
    import Cookies from 'js-cookie'
    export default {
      name: 'Edit',
      components: {
      },
      data () {
        return {
          setting: {
            title: "",
            icon: "",
            description: "",
            keywords: "",
            code:""
          },
          bak: {},
          access: 0,
          hasIcon: false
        }
      },
      computed: {
        headers () {
          return {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }
      },
      beforeMount () {
          this.access = Cookies.get("access")
          this.getSetting()
      },
      methods: {
        getSetting: function () {
          $.ajax({
            type: 'get',
            dataType: 'json',
            data: {'action': 'get'},
            url: 'http://' + document.location.host + '/manage/setting'
          }).done((resp) => {
            if (resp.status === 1000) {
              let setting = resp.info
              this.setting.title = setting.title
              this.setting.icon = setting.icon
              this.setting.description = setting.description
              this.setting.keywords = setting.keywords
              this.setting.code = setting.code
              this.bak = setting
              if(setting.icon) {
                this.hasIcon = true
              }
            } else {
              $Msg.warning(resp.msg)
            }
          }).fail((resp) => {
            this.$router.push({name:'error_500'})
          })
        },
        uploadSuccess: function (response, file, fileList) {
          if (response.errno === 0) {
            this.setting.icon = response.data[0]
            this.hasIcon = false
          } else {
            $Msg.error(response.msg)
          }
        },
        save: function () {
          this.setting.action = 'save'
          this.setting._token = $('meta[name="csrf-token"]').attr('content')
          $.ajax({
            type: 'post',
            dataType: 'json',
            data: this.setting,
            url: 'http://' + document.location.host + '/manage/setting'
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
          this.setting = this.bak
        },
      }
    }
</script>
<style scoped>
    .content{
        background: #fff;
    }
</style>
