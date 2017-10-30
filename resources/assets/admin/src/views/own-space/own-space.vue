<style lang="less">
    @import './own-space.less';
</style>

<template>
    <div>
        <Card>
            <p slot="title">
                <Icon type="person"></Icon>
                个人信息
            </p>
            <div>
                <Form 
                    ref="userForm"
                    :model="userForm" 
                    :label-width="100" 
                    label-position="right"
                    :rules="inforValidate"
                >
                    <FormItem label="用户姓名：" prop="name">
                        <div style="display:inline-block;width:300px;">
                            <Input v-model="userForm.name" ></Input>
                        </div>
                    </FormItem>
                    <FormItem label="用户手机：" prop="cellphone" >
                        <div style="display:inline-block;width:204px;">
                            <Input v-model="userForm.cellphone"></Input>
                        </div>
                    </FormItem>
                    <FormItem label="头像">
                        <Upload action="/manage/upload" name="upload" :headers="headers" :on-success="uploadSuccess" :format="['jpg','jpeg','png']" :max-size="2048">
                            <Button type="ghost" icon="ios-cloud-upload-outline">上传图片</Button>
                        </Upload>
                        <div class="demo-upload-list" v-if="manager.hasAvatar===1"><img :src="manager.avatar" style="vertical-align: top; height: 100px;" /> <div class="demo-upload-list-cover"></div></div>
                    </FormItem>
                    <FormItem label="岗位：">
                        <span>{{ userForm.job }}</span>
                    </FormItem>
                    <FormItem label="系统角色：">
                        <span>{{ userForm.gradeName }}</span>
                    </FormItem>
                    <FormItem label="登录密码：">
                        <Button type="text" size="small" @click="showEditPassword">修改密码</Button>
                    </FormItem>
                    <div>
                        <Button type="text" style="width: 100px;" @click="cancelEditUserInfor">取消</Button>
                        <Button type="primary" style="width: 100px;" :loading="save_loading" @click="saveEdit">保存</Button>
                    </div>
                </Form>
            </div>
        </Card>
        <Modal v-model="editPasswordModal" :closable='false' :mask-closable=false :width="500">
            <h3 slot="header" style="color:#2D8CF0">修改密码</h3>
            <Form ref="editPasswordForm" :model="editPasswordForm" :label-width="100" label-position="right" :rules="passwordValidate">
                <FormItem label="原密码" prop="oldPass" :error="oldPassError">
                    <Input v-model="editPasswordForm.oldPass" placeholder="请输入现在使用的密码" ></Input>
                </FormItem>
                <FormItem label="新密码" prop="newPass">
                    <Input v-model="editPasswordForm.newPass" placeholder="请输入新密码，至少6位字符" ></Input>
                </FormItem>
                <FormItem label="确认新密码" prop="rePass">
                    <Input v-model="editPasswordForm.rePass" placeholder="请再次输入新密码" ></Input>
                </FormItem>
            </Form>
            <div slot="footer">
                <Button type="text" @click="cancelEditPass">取消</Button>
                <Button type="primary" :loading="savePassLoading" @click="saveEditPass">保存</Button>
            </div>
        </Modal>
    </div>
</template>

<script>
import Cookies from 'js-cookie';
export default {
    data () {
        const validePhone = (rule, value, callback) => {
            var re = /^1[0-9]{10}$/;
            if (!re.test(value)) {
                callback(new Error('请输入正确格式的手机号'));
            } else {
                callback();
            }
        };
        const valideRePassword = (rule, value, callback) => {
            if (value !== this.editPasswordForm.newPass) {
                callback(new Error('两次输入密码不一致'));
            } else {
                callback();
            }
        };
        return {
            userForm: {
                name: '',
                cellphone: '',
                job: '',
                gradeName: ''
            },
            uid: '',  // 登录用户的userId
            phoneHasChanged: false,  // 是否编辑了手机
            save_loading: false,
            identifyError: '',  // 验证码错误
            editPasswordModal: false, // 修改密码模态框显示
            savePassLoading: false,
            oldPassError: '',
            identifyCodeRight: false,  // 验证码是否正确
            hasGetIdentifyCode: false,  // 是否点了获取验证码
            checkIdentifyCodeLoading: false,
            inforValidate: {
                name: [
                    { required: true, message: '请输入姓名', trigger: 'blur' }
                ],
                cellphone: [
                    { required: true, message: '请输入手机号码' },
                    { validator: validePhone }
                ]
            },
            editPasswordForm: {
                oldPass: '',
                newPass: '',
                rePass: ''
            },
            passwordValidate: {
                oldPass: [
                    { required: true, message: '请输入原密码', trigger: 'blur' }
                ],
                newPass: [
                    { required: true, message: '请输入新密码', trigger: 'blur' },
                    { min: 6, message: '请至少输入6个字符', trigger: 'blur' },
                    { max: 32, message: '最多输入32个字符', trigger: 'blur' }
                ],
                rePass: [
                    { required: true, message: '请再次输入新密码', trigger: 'blur' },
                    { validator: valideRePassword, trigger: 'blur' }
                ]
            },
            initPhone: '',
            manager: {}
        };
    },

    methods: {
        getIdentifyCode () {
            this.hasGetIdentifyCode = true;
            this.$refs['userForm'].validate((valid) => {
                if (valid) {
                    this.canGetIdentifyCode = true;
                    let timeLast = 60;
                    let timer = setInterval(() => {
                        if (timeLast >= 0) {
                            this.gettingIdentifyCodeBtnContent = timeLast + '秒后重试';
                            timeLast -= 1;
                        } else {
                            clearInterval(timer);
                            this.gettingIdentifyCodeBtnContent = '获取验证码';
                            this.canGetIdentifyCode = false;
                        }
                    }, 1000);
                    this.inputCodeVisible = true;
                    // you can write ajax request here
                }
            });
        },
        showEditPassword () {
            this.editPasswordModal = true;
        },
        cancelEditUserInfor () {
            this.$store.commit('removeTag', 'ownspace_index');
            localStorage.pageOpenedList = JSON.stringify(this.$store.state.pageOpenedList);
            let lastPageName = '';
            if (this.$store.state.pageOpenedList.length > 1) {
                lastPageName = this.$store.state.pageOpenedList[1].name;
            } else {
                lastPageName = this.$store.state.pageOpenedList[0].name;
            }
            this.$router.push({
                name: lastPageName
            });
        },
        saveEdit () {
            this.$refs['userForm'].validate((valid) => {
                if (valid) {
                    this.saveInfoAjax();
                }
            });
        },
        cancelEditPass () {
            this.editPasswordModal = false;
        },
        saveEditPass () {
            this.$refs['editPasswordForm'].validate((valid) => {
                if (valid) {
                    let uid = this.uid;
                    this.savePassLoading = true;
                    $.ajax({
                        type: 'save_pass',
                        dataType: 'json',
                        data: {'action': 'save_info', id: uid, old_pass: this.editPasswordForm.oldPass, new_pass: this.editPasswordForm.newPass},
                        url: 'http://' + document.location.host + '/manage/manager'
                    }).done((resp) => {
                        if (resp.status === 1000) {
                          this.$Message.success('保存成功');
                        } else {
                          this.$Message.warning(resp.msg);
                        }
                        this.savePassLoading = false;
                    }).fail((resp) => {
                        this.$router.push({name:'error_500'})
                    })
                }
            });
        },
        cancelInputCodeBox () {
            this.inputCodeVisible = false;
            this.userForm.cellphone = this.initPhone;
        },
        submitCode () {
            let vm = this;
            vm.checkIdentifyCodeLoading = true;
            if (this.securityCode.length === 0) {
                this.$Message.error('请填写短信验证码');
            } else {
                setTimeout(() => {
                    this.$Message.success('验证码正确');
                    this.inputCodeVisible = false;
                    this.checkIdentifyCodeLoading = false;
                }, 1000);
            }
        },
        hasChangePhone () {
            this.phoneHasChanged = true;
            this.hasGetIdentifyCode = false;
            this.identifyCodeRight = false;
        },
        saveInfoAjax () {
            this.save_loading = true;
            let uid = this.uid;
            $.ajax({
                type: 'save_info',
                dataType: 'json',
                data: {'action': 'save_info', id: uid, username: this.userForm.name, telphone: this.userForm.cellphone, avatar: this.manager.avatar},
                url: 'http://' + document.location.host + '/manage/manager'
            }).done((resp) => {
                if (resp.status === 1000) {
                  this.$Message.success('保存成功');
                } else {
                  this.$Message.warning(resp.msg);
                }
                this.save_loading = false;
            }).fail((resp) => {
                this.$router.push({name:'error_500'})
            })
        },
        getInfo: function () {
          let uid = Cookies.get('uid');
          $.ajax({
            type: 'get',
            dataType: 'json',
            data: {'action': 'get_info', id: uid},
            url: 'http://' + document.location.host + '/manage/manager'
          }).done((resp) => {
            if (resp.status === 1000) {
              let info = resp.info;
              this.manager = resp.info;
              this.uid = info.id;
              this.userForm.name = info.username;
              this.userForm.cellphone = info.telphone;
              this.initPhone = info.telphone;
              this.userForm.job = info.job;
              this.userForm.gradeName = info.grade > 0 ? '管理员' : '超级管理员';
            } else {
              $Msg.warning(resp.msg)
            }
          }).fail((resp) => {
            this.$router.push({name:'error_500'})
          })
        },
        uploadSuccess: function (response, file, fileList) {
          if (response.errno === 0) {
            this.manager.avatar = response.data[0]
          } else {
            $Msg.error(response.msg)
          }
        },
    },
    beforeMount () {
        getInfo()
    },
    computed: {
        headers () {
          return {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }
    },
};
</script>
