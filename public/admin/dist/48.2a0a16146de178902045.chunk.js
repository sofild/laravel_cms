webpackJsonp([48],{652:function(e,t,r){r(842);var a=r(33)(r(762),r(896),null,null);a.options.__file="D:\\web-proj\\laravel_cms\\resources\\assets\\admin\\src\\views\\argument-page\\argument-page.vue",a.esModule&&Object.keys(a.esModule).some(function(e){return"default"!==e&&"__esModule"!==e})&&console.error("named exports are not supported in *.vue files."),a.options.functional&&console.error("[vue-loader] argument-page.vue: functional components are not supported with templates, they should use render functions."),e.exports=a.exports},762:function(e,t,r){"use strict";function a(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var n=r(42),o=a(n),s=r(55),i=a(s);t.default={data:function(){var e=this;return{orderColumns:[{type:"index",title:"序号",width:60},{title:"订单号",key:"order_id",align:"center"},{title:"用户",key:"user_name",width:160},{title:"详情",key:"show_more",width:160,align:"center",render:function(t,r){return t("Button",{props:{type:"text",size:"small"},on:{click:function(){var t={order_id:r.row.order_id};i.default.openNewPage(e,"order_info",t),e.$router.push({name:"order_info",params:t})}}},"了解详情")}}],orderData:[{order_id:"1000001",user_name:"Aresn"},{order_id:"1000002",user_name:"Lison"},{order_id:"1000003",user_name:"lili"},{order_id:"1000004",user_name:"lala"}]}},computed:{avatorImage:function(){return localStorage.avatorImgPath}},methods:{linkToOwnspace:function(){var e={username:o.default.get("user")};this.$router.push({name:"ownspace_with_name",params:e}),i.default.openNewPage(this,"ownspace_with_name",e)}}}},842:function(e,t){},896:function(e,t,r){e.exports={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("Row",{attrs:{gutter:10}},[r("Col",{attrs:{span:"12"}},[r("Card",[r("p",{attrs:{slot:"title"},slot:"title"},[r("Icon",{attrs:{type:"android-favorite-outline"}}),e._v("\n                    基础示例\n                ")],1),e._v(" "),r("Row",{staticClass:"argupage-open-argupage-row1",attrs:{type:"flex",justify:"center",align:"middle"}},[r("img",{staticClass:"avator-img",attrs:{src:e.avatorImage,alt:""},on:{click:e.linkToOwnspace}}),e._v(" "),r("b",[e._v("点击头像跳转到该用户个人中心")])])],1)],1),e._v(" "),r("Col",{attrs:{span:"12"}},[r("Card",[r("p",{attrs:{slot:"title"},slot:"title"},[r("Icon",{attrs:{type:"ios-list"}}),e._v("\n                    订单详情\n                ")],1),e._v(" "),r("Row",{staticClass:"argupage-open-argupage-row1",attrs:{type:"flex",justify:"center",align:"middle"}},[r("Table",{staticStyle:{width:"100%"},attrs:{columns:e.orderColumns,data:e.orderData}})],1)],1)],1)],1)],1)},staticRenderFns:[]},e.exports.render._withStripped=!0}});