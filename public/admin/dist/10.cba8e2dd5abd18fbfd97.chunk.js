webpackJsonp([10],{649:function(e,t,s){s(783);var a=s(34)(s(713),s(831),null,null);a.options.__file="D:\\web-proj\\laravel_cms\\resources\\assets\\admin\\src\\views\\argument-page\\order-info.vue",a.esModule&&Object.keys(a.esModule).some(function(e){return"default"!==e&&"__esModule"!==e})&&console.error("named exports are not supported in *.vue files."),a.options.functional&&console.error("[vue-loader] order-info.vue: functional components are not supported with templates, they should use render functions."),e.exports=a.exports},712:function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={props:{row:Object}}},713:function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=s(810),o=function(e){return e&&e.__esModule?e:{default:e}}(a);t.default={components:{expandRow:o.default},data:function(){return{showInfo:!1,order_col:[{title:"订单号",key:"order_id",align:"center"},{title:"买家",key:"buyer",align:"center"},{title:"地址",key:"addr",align:"center"},{title:"下单时间",key:"time",align:"center"},{title:"交易状态",key:"state",align:"center"}],order_data:[],columns10:[{type:"expand",width:50,render:function(e,t){return e(o.default,{props:{row:t.row}})}},{title:"姓名",key:"name"},{title:"年龄",key:"age"},{title:"地址",key:"address"}],data9:[{name:"王小明",age:18,address:"北京市朝阳区芍药居",job:"数据工程师",interest:"羽毛球",birthday:"1991-05-14",book:"乔布斯传",movie:"致命魔术",music:"I Cry"},{name:"张小刚",age:25,address:"北京市海淀区西二旗",job:"数据科学家",interest:"排球",birthday:"1989-03-18",book:"我的奋斗",movie:"罗马假日",music:"My Heart Will Go On"},{name:"李小红",age:30,address:"上海市浦东新区世纪大道",job:"数据产品经理",interest:"网球",birthday:"1992-01-31",book:"赢",movie:"乔布斯",music:"Don’t Cry"},{name:"周小伟",age:26,address:"深圳市南山区深南大道",job:"数据分析师",interest:"桌球，跑步",birthday:"1988-7-25",book:"红楼梦",movie:"倩女幽魂",music:"演员"}]}},methods:{init:function(){var e=parseInt(this.$route.path.substr(-1,1)),t="",s="",a="",o="";switch(e){case 1:t="Arasn",s="北京市东直门外大街39号院2号楼航空服务大厦",a="2017年10月20日 13：33：24",o="已付款";break;case 2:t="Lison",s="北京市东直门外大街39号院2号楼航空服务大厦",a="2017年10月21日 19：13：24",o="已付款";break;case 3:t="lili",s="TalkingData总部",a="2017年10月12日 10：39：24",o="待收货";break;case 4:t="lala",s="国家统计局",a="2017年8月20日 11：45：24",o="已收货"}var n={order_id:this.$route.params.order_id,buyer:t,addr:s,time:a,state:o};this.order_data=[n]}},mounted:function(){this.init()},watch:{$route:function(){this.init()}}}},783:function(e,t){},801:function(e,t){},810:function(e,t,s){s(801);var a=s(34)(s(712),s(861),null,null);a.options.__file="D:\\web-proj\\laravel_cms\\resources\\assets\\admin\\src\\views\\argument-page\\expandRow.vue",a.esModule&&Object.keys(a.esModule).some(function(e){return"default"!==e&&"__esModule"!==e})&&console.error("named exports are not supported in *.vue files."),a.options.functional&&console.error("[vue-loader] expandRow.vue: functional components are not supported with templates, they should use render functions."),e.exports=a.exports},831:function(e,t,s){e.exports={render:function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",[s("Row",[s("Card",[s("p",{attrs:{slot:"title"},slot:"title"},[s("Icon",{attrs:{type:"compose"}}),e._v("\n                订单详情\n            ")],1),e._v(" "),s("Table",{attrs:{columns:e.order_col,data:e.order_data}}),e._v(" "),s("Modal",{attrs:{width:"700",title:"订单信息"},model:{value:e.showInfo,callback:function(t){e.showInfo=t},expression:"showInfo"}},[s("Table",{attrs:{columns:e.order_col,data:e.order_data}})],1)],1)],1),e._v(" "),s("Row",{staticClass:"margin-top-10"},[s("Card",[s("Row",[s("p",{staticClass:"order-infor-page-p"},[e._v("虽然iview-admin支持打开带参数的页面，但是类似于这种需求，还是建议用iview的Modal或者使用表格直接在表格内展开数据")]),e._v(" "),s("p",[s("Button",{attrs:{type:"primary"},on:{click:function(t){e.showInfo=!0}}},[e._v("点击按钮弹出Modal")])],1)]),e._v(" "),s("div",{staticClass:"margin-top-10"},[s("p",{staticClass:"order-infor-page-p"},[e._v("iview官方示例"),s("a",{attrs:{href:"https://www.iviewui.com/components/table"}},[e._v("表格")])]),e._v(" "),s("Table",{attrs:{columns:e.columns10,data:e.data9}})],1)],1)],1)],1)},staticRenderFns:[]},e.exports.render._withStripped=!0},861:function(e,t,s){e.exports={render:function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",[s("Row",{staticClass:"expand-row"},[s("Col",{attrs:{span:"8"}},[s("span",{staticClass:"expand-key"},[e._v("职业：")]),e._v(" "),s("span",{staticClass:"expand-value"},[e._v(e._s(e.row.job))])]),e._v(" "),s("Col",{attrs:{span:"8"}},[s("span",{staticClass:"expand-key"},[e._v("兴趣：")]),e._v(" "),s("span",{staticClass:"expand-value"},[e._v(e._s(e.row.interest))])]),e._v(" "),s("Col",{attrs:{span:"8"}},[s("span",{staticClass:"expand-key"},[e._v("生日：")]),e._v(" "),s("span",{staticClass:"expand-value"},[e._v(e._s(e.row.birthday))])])],1),e._v(" "),s("Row",[s("Col",{attrs:{span:"8"}},[s("span",{staticClass:"expand-key"},[e._v("最喜欢的书：")]),e._v(" "),s("span",{staticClass:"expand-value"},[e._v("《"+e._s(e.row.book)+"》")])]),e._v(" "),s("Col",{attrs:{span:"8"}},[s("span",{staticClass:"expand-key"},[e._v("最喜欢的电影：")]),e._v(" "),s("span",{staticClass:"expand-value"},[e._v(e._s(e.row.movie))])]),e._v(" "),s("Col",{attrs:{span:"8"}},[s("span",{staticClass:"expand-key"},[e._v("最喜欢的音乐：")]),e._v(" "),s("span",{staticClass:"expand-value"},[e._v(e._s(e.row.music))])])],1)],1)},staticRenderFns:[]},e.exports.render._withStripped=!0}});