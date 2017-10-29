webpackJsonp([18],{660:function(t,e,s){s(771);var a=s(35)(s(721),s(822),null,null);a.options.__file="D:\\web-proj\\laravel_cms\\resources\\assets\\admin\\src\\views\\my_components\\file-upload\\file-upload.vue",a.esModule&&Object.keys(a.esModule).some(function(t){return"default"!==t&&"__esModule"!==t})&&console.error("named exports are not supported in *.vue files."),a.options.functional&&console.error("[vue-loader] file-upload.vue: functional components are not supported with templates, they should use render functions."),t.exports=a.exports},721:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={data:function(){return{defaultList:[{name:"a42bdcc1178e62b4694c830f028db5c0",url:"https://o5wwk8baw.qnssl.com/a42bdcc1178e62b4694c830f028db5c0/avatar"},{name:"bc7521e033abdd1e92222d733590f104",url:"https://o5wwk8baw.qnssl.com/bc7521e033abdd1e92222d733590f104/avatar"}],imgName:"",visible:!1,uploadList:[]}},methods:{handleFormatError:function(t){this.$Notice.warning({title:"文件格式不正确",desc:"文件 "+t.name+" 格式不正确，请选择图片文件。"})},handleBeforeUpload:function(t){this.$Notice.warning({title:"文件准备上传",desc:"文件 "+t.name+" 准备上传。"})},handleProgress:function(t,e){this.$Notice.info({title:"文件正在上传",desc:"文件 "+e.name+" 正在上传。"})},handleSuccess:function(t,e){this.$Notice.success({title:"文件上传成功",desc:"文件 "+e.name+" 上传成功。"})},handleError:function(t,e){this.$Notice.error({title:"文件上传成功",desc:"文件 "+e.name+" 上传失败。"})},handleView:function(t){this.imgName=t,this.visible=!0},handleRemove:function(t){var e=this.$refs.upload.fileList;this.$refs.upload.fileList.splice(e.indexOf(t),1)},handleSuccess2:function(t,e){e.url="https://o5wwk8baw.qnssl.com/7eb99afb9d5f317c912f08b5212fd69a/avatar",e.name="7eb99afb9d5f317c912f08b5212fd69a"},handleFormatError2:function(t){this.$Notice.warning({title:"文件格式不正确",desc:"文件 "+t.name+" 格式不正确，请上传 jpg 或 png 格式的图片。"})},handleMaxSize:function(t){this.$Notice.warning({title:"超出文件大小限制",desc:"文件 "+t.name+" 太大，不能超过 2M。"})},handleBeforeUpload2:function(){var t=this.uploadList.length<5;return t||this.$Notice.warning({title:"最多只能上传 5 张图片。"}),t}},mounted:function(){this.uploadList=this.$refs.upload.fileList}}},771:function(t,e){},822:function(t,e,s){t.exports={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[s("Row",[s("Col",{attrs:{span:"8"}},[s("Card",[s("p",{attrs:{slot:"title"},slot:"title"},[s("Icon",{attrs:{type:"ios-cloud-upload-outline"}}),t._v("\n                    基本上传功能\n                ")],1),t._v(" "),s("div",{staticClass:"height-120px"},[s("Row",{staticClass:"height-100",attrs:{type:"flex",justify:"center",align:"middle"}},[s("Upload",{attrs:{action:"//jsonplaceholder.typicode.com/posts/"}},[s("Button",{attrs:{type:"ghost",icon:"ios-cloud-upload-outline"}},[t._v("上传文件")])],1)],1)],1)])],1),t._v(" "),s("Col",{staticClass:"padding-left-10",attrs:{span:"8"}},[s("Card",[s("p",{attrs:{slot:"title"},slot:"title"},[s("Icon",{attrs:{type:"ios-copy-outline"}}),t._v("\n                    可多选的上传\n                ")],1),t._v(" "),s("div",{staticClass:"height-120px"},[s("Row",{staticClass:"height-100",attrs:{type:"flex",justify:"center",align:"middle"}},[s("Upload",{attrs:{multiple:"",action:"//jsonplaceholder.typicode.com/posts/"}},[s("span",[t._v("多选文件上传  ")]),t._v(" "),s("Button",{attrs:{type:"ghost",icon:"ios-cloud-upload-outline"}},[t._v("上传文件")])],1)],1)],1)])],1),t._v(" "),s("Col",{staticClass:"padding-left-10",attrs:{span:"8"}},[s("Card",[s("p",{attrs:{slot:"title"},slot:"title"},[s("Icon",{attrs:{type:"upload"}}),t._v("\n                    可限制文件类型\n                ")],1),t._v(" "),s("div",{staticClass:"height-120px"},[s("Row",{staticClass:"height-100",attrs:{type:"flex",justify:"center",align:"middle"}},[s("Upload",{attrs:{action:"//jsonplaceholder.typicode.com/posts/",format:["jpg","png","jpeg","gif","bmp","svg"],"on-format-error":t.handleFormatError}},[s("span",[t._v("选择图片上传  ")]),t._v(" "),s("Button",{attrs:{type:"ghost",icon:"ios-cloud-upload-outline"}},[t._v("上传文件")])],1)],1)],1)])],1)],1),t._v(" "),s("div",{staticClass:"margin-top-10"},[s("Col",{attrs:{span:"8"}},[s("div",[s("Card",[s("p",{attrs:{slot:"title"},slot:"title"},[s("Icon",{attrs:{type:"android-funnel"}}),t._v("\n                        可监听上传各个阶段\n                    ")],1),t._v(" "),s("div",{staticClass:"height-200px"},[s("Row",{staticClass:"height-100",attrs:{type:"flex",justify:"center",align:"middle"}},[s("div",{staticStyle:{display:"block",width:"100%","text-align":"center"}},[s("Upload",{attrs:{action:"//jsonplaceholder.typicode.com/posts/","on-format-error":t.handleFormatError,"before-upload":t.handleBeforeUpload,"on-progress":t.handleProgress,"on-success":t.handleSuccess,"on-error":t.handleError}},[s("span",[t._v("请选择文件  ")]),t._v(" "),s("Button",{attrs:{type:"ghost",icon:"ios-cloud-upload-outline"}},[t._v("上传文件")])],1)],1)])],1)])],1),t._v(" "),s("div",{staticClass:"margin-top-10"},[s("Card",[s("p",{attrs:{slot:"title"},slot:"title"},[s("Icon",{attrs:{type:"android-hand"}}),t._v("\n                        可拖拽上传\n                    ")],1),t._v(" "),s("div",{staticClass:"height-200px"},[s("Upload",{attrs:{multiple:"",type:"drag",action:"//jsonplaceholder.typicode.com/posts/"}},[s("div",{staticStyle:{padding:"60px 0",height:"200px"}},[s("Icon",{staticStyle:{color:"#3399ff"},attrs:{type:"ios-cloud-upload",size:"52"}}),t._v(" "),s("p",[t._v("点击或将文件拖拽到这里上传")])],1)])],1)])],1)]),t._v(" "),s("Col",{attrs:{span:"16"}},[s("div",{staticClass:"padding-left-10"},[s("Card",[s("p",{attrs:{slot:"title"},slot:"title"},[s("Icon",{attrs:{type:"ios-analytics"}}),t._v("\n                        综合实例\n                    ")],1),t._v(" "),s("div",{staticClass:"height-492px"},[s("Col",{attrs:{span:"8"}},[s("Card",[s("Upload",{ref:"upload",staticStyle:{display:"inline-block",width:"58px"},attrs:{"show-upload-list":!1,"default-file-list":t.defaultList,"on-success":t.handleSuccess2,format:["jpg","jpeg","png"],"max-size":2048,"on-format-error":t.handleFormatError2,"on-exceeded-size":t.handleMaxSize,"before-upload":t.handleBeforeUpload2,multiple:"",type:"drag",action:"//jsonplaceholder.typicode.com/posts/"}},[s("div",{staticStyle:{width:"58px",height:"58px","line-height":"58px"}},[s("Icon",{attrs:{type:"camera",size:"20"}})],1)]),t._v(" "),s("Modal",{attrs:{title:"查看图片"},model:{value:t.visible,callback:function(e){t.visible=e},expression:"visible"}},[t.visible?s("img",{staticStyle:{width:"100%"},attrs:{src:"https://o5wwk8baw.qnssl.com/"+t.imgName+"/large"}}):t._e()])],1)],1),t._v(" "),s("Col",{staticClass:"padding-left-10",attrs:{span:"16"}},[s("Card",[s("div",{staticClass:"height-460px"},t._l(t.uploadList,function(e){return s("div",{key:e.url,staticClass:"admin-upload-list"},["finished"===e.status?[s("img",{attrs:{src:e.url}}),t._v(" "),s("div",{staticClass:"admin-upload-list-cover"},[s("Icon",{attrs:{type:"ios-eye-outline"},nativeOn:{click:function(s){t.handleView(e.name)}}}),t._v(" "),s("Icon",{attrs:{type:"ios-trash-outline"},nativeOn:{click:function(s){t.handleRemove(e)}}})],1)]:[e.showProgress?s("Progress",{attrs:{percent:e.percentage,"hide-info":""}}):t._e()]],2)}))])],1)],1)])],1)])],1)],1)},staticRenderFns:[]},t.exports.render._withStripped=!0}});