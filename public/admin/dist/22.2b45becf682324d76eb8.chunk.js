webpackJsonp([22],{640:function(e,t,r){r(668);var o=r(33)(r(664),r(673),null,null);o.options.__file="D:\\web-proj\\laravel_cms\\resources\\assets\\admin\\src\\views\\error_page\\401.vue",o.esModule&&Object.keys(o.esModule).some(function(e){return"default"!==e&&"__esModule"!==e})&&console.error("named exports are not supported in *.vue files."),o.options.functional&&console.error("[vue-loader] 401.vue: functional components are not supported with templates, they should use render functions."),e.exports=o.exports},664:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"Error401",methods:{backPage:function(){this.$router.go(-1)},goHome:function(){this.$router.push({name:"home_index"})}}}},668:function(e,t){},673:function(e,t,r){e.exports={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"error401"},[r("div",{staticClass:"error401-body-con"},[r("Card",[r("div",{staticClass:"error401-body-con-title"},[e._v("4"),r("span",{staticClass:"error401-0-span"},[r("Icon",{attrs:{type:"android-lock"}})],1),r("span",{staticClass:"error401-key-span"},[r("Icon",{attrs:{type:"key"}})],1)]),e._v(" "),r("p",{staticClass:"error401-body-con-message"},[e._v("You don't have permission")]),e._v(" "),r("div",{staticClass:"error401-btn-con"},[r("Button",{staticStyle:{width:"200px"},attrs:{size:"large",type:"text"},on:{click:e.goHome}},[e._v("返回首页")]),e._v(" "),r("Button",{staticStyle:{width:"200px","margin-left":"40px"},attrs:{size:"large",type:"primary"},on:{click:e.backPage}},[e._v("返回上一页")])],1)])],1)])},staticRenderFns:[]},e.exports.render._withStripped=!0}});