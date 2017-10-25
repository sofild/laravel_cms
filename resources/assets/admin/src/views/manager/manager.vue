<style lang="less">
    @import '../../styles/common.less';
    @import './components/table.less';
</style>

<template>
    <div>
        <Row class="margin-top-10">
            <Col span="24">
                <Card>
                    <p slot="title">
                        <Icon type="ios-keypad"></Icon>
                         单元行和单元格两种方式编辑(始终显示编辑单元格按钮)
                    </p>
                    <div class="edittable-table-height-con">
                        <editable-table refs="table3" :editIncell="true" :columns-list="editInlineAndCellColumn" :table-data="editInlineAndCellData" :saveEdit="saveEditInlineIncell" :deleteRow="deleteRowInlineIncell"></editable-table>
                    </div>
                </Card>
            </Col>
        </Row>
    </div>
</template>

<script>
import EditableTable from './components/editableTable.vue';
export default {
    components: {
        EditableTable
    },
    data () {
        return {
            editInlineAndCellColumn: [
               {
                   title: '姓名',
                   align: 'center',
                   key: 'username',
               },
               {
                   title: '密码',
                   align: 'center',
                   key: 'password'
                   width: 150,
                   editable: true
               },
               {
                   title: '手机',
                   align: 'center',
                   key: 'telphone',
                   width: 150,
                   editable: true
               },
               {
                   title: '职务',
                   align: 'center',
                   key: 'job',
                   width: 150,
                   editable: true
               },
               {
                  title: '系统角色',
                  align: 'center',
                  key: 'grade',
               },
               {
                   title: '操作',
                   align: 'center',
                   width: 190,
                   key: 'handle',
                   handle: ['edit', 'delete']
               }
            ],
            editInlineAndCellData: []
        };
    },
    methods: {
        getData () {
            $.ajax({
                type: 'get',
                dataType: 'json',
                data: {'action': 'get_list'},
                url: 'http://' + document.location.host + '/manage/manager'
            }).done((resp) => {
                if (resp.status === 1000) {
                    this.editInlineAndCellData = resp.info
                } else {
                    this.$Message.error(resp.msg)
                }
            }).fail((resp) => {
                this.$router.push({name:'error_500'})
            })
        },
        handleNetConnect (state) {
            this.breakConnect = state;
        },
        handleLowSpeed (state) {
            this.lowNetSpeed = state;
        },
        saveEditInlineIncell (index, success, fail) {
            let data = this.editInlineAndCellData[index]
            data.action = 'save'
            $.ajax({
                type: 'get',
                dataType: 'json',
                data: data,
                url: 'http://' + document.location.host + '/manage/manager'
            }).done((resp) => {
                if (resp.status === 1000) {
                    fail(() => {
                        this.$Message.error(resp.msg);
                    });
                } else {
                    success(() => {
                        this.$Message.success('保存成功');
                    });
                }
            }).fail((resp) => {
                this.$router.push({name:'error_500'})
            })
        },
        deleteRowInlineIncell (index, success, fail) {
            let data = this.editInlineAndCellData[index]
            let id = data.id
            $.ajax({
                type: 'get',
                dataType: 'json',
                data: {action: 'del', id: id},
                url: 'http://' + document.location.host + '/manage/manager'
            }).done((resp) => {
                if (resp.status === 1000) {
                    fail(() => {
                        this.$Message.error(resp.msg);
                    });
                } else {
                    success(() => {
                        this.$Message.success('删除成功');
                        this.editInlineAndCellData.splice(index, 1);
                    });
                }
            }).fail((resp) => {
                this.$router.push({name:'error_500'})
            })
        }
    },
    created () {
        this.getData();
    }
};
</script>
