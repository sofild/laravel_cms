webpackJsonp([4],{248:function(e,t,n){n(751);var s=n(34)(n(726),n(818),"data-v-6f3393f6",null);s.options.__file="D:\\web-proj\\laravel_cms\\resources\\assets\\admin\\src\\views\\news\\news-list.vue",s.esModule&&Object.keys(s.esModule).some(function(e){return"default"!==e&&"__esModule"!==e})&&console.error("named exports are not supported in *.vue files."),s.options.functional&&console.error("[vue-loader] news-list.vue: functional components are not supported with templates, they should use render functions."),e.exports=s.exports},726:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"NewsList",components:{},data:function(){var e=this;return{columns:[{title:"姓名",key:"name",render:function(e,t){return e("div",[e("Icon",{props:{type:"person"}}),e("strong",t.row.name)])}},{title:"年龄",key:"age"},{title:"地址",key:"address"},{title:"操作",key:"action",width:150,align:"center",render:function(t,n){return t("div",[t("Button",{props:{type:"primary",size:"small"},style:{marginRight:"5px"},on:{click:function(){e.show(n.index)}}},"编辑"),t("Button",{props:{type:"error",size:"small"},on:{click:function(){e.remove(n.index)}}},"删除")])}}],data:[{name:"王小明",age:18,address:"北京市朝阳区芍药居"},{name:"张小刚",age:25,address:"北京市海淀区西二旗"},{name:"李小红",age:31,address:"上海市浦东新区世纪大道"},{name:"周小伟",age:27,address:"深圳市南山区深南大道"}]}},methods:{show:function(e){this.$Modal.info({title:"用户信息",content:"姓名："+this.data[e].name+"<br>年龄："+this.data[e].age+"<br>地址："+this.data[e].address})},remove:function(e){this.data.splice(e,1)},release:function(e){var t={};t.id=e,t.template=2,this.$emit("go",t)}}}},751:function(e,t){},818:function(e,t,n){e.exports={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"layout-content"},[n("Row",[n("div",{staticClass:"fb"},[n("router-link",{attrs:{to:"/news/edit/0"}},[n("Button",{attrs:{type:"info"}},[e._v("发布文章")])],1)],1)]),e._v(" "),n("Row",[[n("Table",{attrs:{columns:e.columns,data:e.data}})]],2)],1)},staticRenderFns:[]},e.exports.render._withStripped=!0}});