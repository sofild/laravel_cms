<template>
    <div class="layout-content">
        <Form :model="formRight" label-position="right" :label-width="100">
            <FormItem label="姓名">
                <Input v-model="manager.username"></Input>
            </FormItem>
            <FormItem label="密码">
                <Input v-model="manager.password"></Input>
            </FormItem>
            <FormItem label="头像">
                <Upload action="/manage/upload" name="upload" :headers="headers" :on-success="uploadSuccess" :format="['jpg','jpeg','png']" :max-size="2048">
                    <Button type="ghost" icon="ios-cloud-upload-outline">上传图片</Button>
                </Upload>
            </FormItem>
            <FormItem label="手机">
                <Input v-model="manager.telphone"></Input>
            </FormItem>
            <FormItem label="岗位">
                <Input v-model="manager.job"></Input>
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
    export default {
      name: 'Edit',
      components: {
      },
      data () {
        return {
          manager: {},
        }
      },
      computed: {
        headers () {
          return {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }
      },
      methods: {
        uploadSuccess: function (response, file, fileList) {
          if (response.errno === 0) {
            this.manager.avatar = response.data[0]
          } else {
            $Msg.error(response.msg)
          }
        },
        save: function () {
          if (!this.manager.username) {
            $Msg.error('请填写姓名！')
            return
          }
          if (!this.manager.password) {
              $Msg.error('请填写密码！')
              return
          }
          this.manager.id = 0
          this.manager.action = 'save_info'
          this.manager._token = $('meta[name="csrf-token"]').attr('content')
          $.ajax({
            type: 'post',
            dataType: 'json',
            data: this.manager,
            url: 'http://' + document.location.host + '/manage/manager'
          }).done((resp) => {
            if (resp.status === 1000) {
              $Msg.success(resp.msg)
              this.reset()
            } else {
              $Msg.warning(resp.msg)
            }
          }).fail((resp) => {
            $Msg.error('获取信息失败：服务器错误')
          })
        },
        reset: function () {
          this.manager = {}
        },
      }
    }
</script>
<style scoped>
    .content{
        background: #fff;
    }
</style>
