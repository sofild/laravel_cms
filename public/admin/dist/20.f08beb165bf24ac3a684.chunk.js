webpackJsonp([20],{648:function(e,t,s){s(749);var a=s(33)(s(693),s(798),null,null);a.options.__file="D:\\web-proj\\laravel_cms\\resources\\assets\\admin\\src\\views\\form\\article-publish\\preview.vue",a.esModule&&Object.keys(a.esModule).some(function(e){return"default"!==e&&"__esModule"!==e})&&console.error("named exports are not supported in *.vue files."),a.options.functional&&console.error("[vue-loader] preview.vue: functional components are not supported with templates, they should use render functions."),e.exports=a.exports},693:function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={data:function(){return{articleTitle:"",tagsList:"",classificationSelected:[],content:"",publishTime:""}},mounted:function(){this.articleTitle=localStorage.articleTitle,this.tagsList=localStorage.tagsList?JSON.parse(localStorage.tagsList):[],this.classificationSelected=localStorage.classificationSelected?JSON.parse(localStorage.classificationSelected):[],this.content=localStorage.content,this.publishTime=localStorage.publishTime}}},749:function(e,t){},798:function(e,t,s){e.exports={render:function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"preview-main"},[s("div",{staticClass:"preview-header"},[s("Menu",{attrs:{mode:"horizontal",theme:"dark","active-name":"1"}},[s("div",{staticClass:"preview-header-nav"},[s("MenuItem",{attrs:{name:"1"}},[s("Icon",{attrs:{type:"ios-navigate"}}),e._v("\n                    导航一\n                ")],1),e._v(" "),s("MenuItem",{attrs:{name:"2"}},[s("Icon",{attrs:{type:"ios-keypad"}}),e._v("\n                    导航二\n                ")],1),e._v(" "),s("MenuItem",{attrs:{name:"3"}},[s("Icon",{attrs:{type:"ios-analytics"}}),e._v("\n                    导航三\n                ")],1),e._v(" "),s("MenuItem",{attrs:{name:"4"}},[s("Icon",{attrs:{type:"ios-paper"}}),e._v("\n                    导航四\n                ")],1)],1)])],1),e._v(" "),s("Row",{staticClass:"margin-top-20"},[s("Col",{attrs:{span:"12",offset:"5"}},[s("div",[s("Card",[s("h1",[e._v(e._s(e.articleTitle))]),e._v(" "),s("p",{staticClass:"preview-publish-time"},[s("Icon",{attrs:{type:"android-alarm-clock"}}),e._v(" 发布时间："+e._s(e.publishTime))],1),e._v(" "),s("div",{staticClass:"preview-tags-con"},[s("b",{staticClass:"preview-tip"},[s("Icon",{attrs:{type:"ios-pricetags-outline"}}),e._v(" 标签：")],1),e._l(e.tagsList,function(t){return s("Tag",{key:t,attrs:{type:"border",color:"blue"}},[e._v(e._s(t))])})],2),e._v(" "),s("div",{staticClass:"preview-content-con",domProps:{innerHTML:e._s(e.content)}}),e._v(" "),s("div",{staticClass:"preview-classifition-con"},[s("b",{staticClass:"preview-tip"},[s("Icon",{attrs:{type:"navicon-round"}}),e._v(" 目录：")],1),e._v(" "),e._l(e.classificationSelected,function(t){return s("a",{key:t,staticClass:"preview-classifition-item"},[s("Icon",{attrs:{type:"android-folder-open"}}),e._v("\n                            "+e._s(t)+"\n                        ")],1)})],2)])],1)]),e._v(" "),s("Col",{staticClass:"padding-left-10",attrs:{span:"4"}},[s("div",[s("Card",[s("p",{attrs:{slot:"title"},slot:"title"},[s("Icon",{attrs:{type:"paper-airplane"}}),e._v("\n                        热门文章\n                    ")],1),e._v(" "),s("div",{staticClass:"preview-placeholderCon"},[s("div",{staticClass:"preview-placeholder"}),e._v(" "),s("div",{staticClass:"preview-placeholder"}),e._v(" "),s("div",{staticClass:"preview-placeholder"}),e._v(" "),s("div",{staticClass:"preview-placeholder"})])])],1),e._v(" "),s("div",{staticClass:"margin-top-10"},[s("Card",[s("p",{attrs:{slot:"title"},slot:"title"},[s("Icon",{attrs:{type:"paper-airplane"}}),e._v("\n                        最新文章\n                    ")],1),e._v(" "),s("div",{staticClass:"preview-placeholderCon"},[s("div",{staticClass:"preview-placeholder"}),e._v(" "),s("div",{staticClass:"preview-placeholder"}),e._v(" "),s("div",{staticClass:"preview-placeholder"}),e._v(" "),s("div",{staticClass:"preview-placeholder"})])])],1)])],1)],1)},staticRenderFns:[]},e.exports.render._withStripped=!0}});