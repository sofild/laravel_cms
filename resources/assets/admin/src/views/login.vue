<style lang="less">
    @import './login.less';
</style>

<template>
    <div class="login" @keydown.enter="handleSubmit">
        <div class="login-con">
            <Card :bordered="false">
                <p slot="title">
                    <Icon type="log-in"></Icon>
                    欢迎登录
                </p>
                <div class="form-con">
                    <Form ref="loginForm" :model="form" :rules="rules">
                        <FormItem prop="userName">
                            <Input v-model="form.userName">
                                <span slot="prepend">
                                    <Icon :size="16" type="person"></Icon>
                                </span>
                            </Input>
                        </FormItem>
                        <FormItem prop="password">
                            <Input v-model="form.password">
                                <span slot="prepend">
                                    <Icon :size="14" type="locked"></Icon>
                                </span>
                            </Input>
                        </FormItem>
                        <FormItem>
                            <Button @click="handleSubmit" type="primary" long>登录</Button>
                        </FormItem>
                    </Form>
                    <p class="login-tip">请输入您的用户名和密码</p>
                </div>
            </Card>
        </div>
    </div>
</template>

<script>
import Cookies from 'js-cookie';
import $ from 'jquery'
import $Msg from 'iview/src/components/message'
export default {
    data () {
        return {
            form: {
                userName: '',
                password: ''
            },
            rules: {
                userName: [
                    { required: true, message: '账号不能为空', trigger: 'blur' }
                ],
                password: [
                    { required: true, message: '密码不能为空', trigger: 'blur' }
                ]
            }
        };
    },
    methods: {
        handleSubmit () {
            this.$refs.loginForm.validate((valid) => {
                if (valid) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data: {username:this.form.userName, password:this.form.password},
                        url: 'http://' + document.location.host + '/manage/login'
                    }).done( (resp) => {
                        if (resp) {
                            if(resp.status==1000){
                                this.successHandle(resp);
                                return true;
                            }else{
                                $Msg.error(resp.msg);
                                return false;
                            }
                        } else {
                            $Msg.error("登录失败，请重新操作！");
                        }
                    }).fail( (resp) => {
                        $Msg.error('服务器错误，请刷新页面重新操作！');
                    });
			    }
            });
        },
        successHandle (resp) {
            Cookies.set('uid', resp.uinfo.id);
            Cookies.set('user', this.form.userName);
            this.$store.commit('setAvator', resp.uinfo.avatar ? resp.uinfo.avatar : '/img/admin.jpg');
            Cookies.set('access', this.uinfo.access);
            this.$router.push({
                name: 'home_index'
            });
        }
    }
};
</script>

<style>

</style>
