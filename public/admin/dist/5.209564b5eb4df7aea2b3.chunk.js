webpackJsonp([5],{661:function(e,t,n){n(744);var i=n(33)(n(718),n(794),null,null);i.options.__file="D:\\web-proj\\laravel_cms\\resources\\assets\\admin\\src\\views\\tables\\editable-table.vue",i.esModule&&Object.keys(i.esModule).some(function(e){return"default"!==e&&"__esModule"!==e})&&console.error("named exports are not supported in *.vue files."),i.options.functional&&console.error("[vue-loader] editable-table.vue: functional components are not supported with templates, they should use render functions."),e.exports=i.exports},716:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i=n(54),l=function(e){return e&&e.__esModule?e:{default:e}}(i),a=function(e,t,n,i){return t("Button",{props:{type:n.editting?"success":n.saveFail?"error":"primary",loading:n.saving},style:{margin:"0 5px"},on:{click:function(){if(n.saveFail)n.saving=e.edittingStore[i].saving=!0,e.saveEdit(e.editIndex(i),e.successSave(n,e,i),e.failSave(n,e,i));else if(n.editting)n.saving=e.edittingStore[i].saving=!0,e.saveEdit(e.editIndex(i),e.successSave(n,e,i),e.failSave(n,e,i));else{if(n.edittingCell)for(var t in n.edittingCell)n.edittingCell[t]=!1,e.edittingStore[i].edittingCell[t]=!1;n.editting=e.edittingStore[i].editting=!0}e.thisTableData=JSON.parse((0,l.default)(e.edittingStore))}}},n.editting?"保存":n.saveFail?"重试":"编辑")},s=function(e,t,n,i){return t("Poptip",{props:{confirm:!0,title:"您确定要删除这条数据吗?",transfer:!0},on:{"on-ok":function(){n.isDeleting=!0,e.deleteRow(e.deleteIndex(i),e.successDel(e,i),e.failDel(e,i))}}},[t("Button",{style:{margin:"0 5px"},props:{type:"error",placement:"top",loading:n.isDeleting}},"删除")])},o=function(e,t,n){return e.hoverShow?t("div",{class:{"show-edit-btn":e.hoverShow}},[t("Button",{props:{type:"text",icon:"edit"},on:{click:function(t){e.edittingStore[n.index].edittingCell[n.column.key]=!0,e.thisTableData=JSON.parse((0,l.default)(e.edittingStore))}}})]):t("Button",{props:{type:"text",icon:"edit"},on:{click:function(t){e.edittingStore[n.index].edittingCell[n.column.key]=!0,e.thisTableData=JSON.parse((0,l.default)(e.edittingStore))}}})},r=function(e,t,n){return t("Button",{props:{type:"text",icon:"checkmark"},on:{click:function(t){e.edittingStore[n.index].edittingCell[n.column.key]=!1,e.thisTableData=JSON.parse((0,l.default)(e.edittingStore))}}})},d=function(e,t,n,i){return t("Input",{props:{type:"text",value:e.edittingStore[n.index][i.key]},on:{"on-change":function(t){var l=i.key;e.edittingStore[n.index][l]=t.target.value}}})};t.default={name:"EditableTable",props:{refs:String,columnsList:Array,tableData:Array,url:String,saveEdit:{type:Function,default:function(){return function(){}}},deleteRow:{type:Function,default:function(){return function(){}}},editIncell:{type:Boolean,default:!1},hoverShow:{type:Boolean,default:!1}},data:function(){return{columns:[],thisTableData:[],edittingStore:[]}},created:function(){this.init()},methods:{init:function(){var e=this,t=this,n=this.columnsList.filter(function(e){if(e.editable&&!0===e.editable)return e}),i=JSON.parse((0,l.default)(this.tableData)),c=[];c=i.map(function(t){e.$set(t,"editting",!1),e.$set(t,"saving",!1),e.$set(t,"saveFail",!1),e.$set(t,"isDeleting",!1);var i={};return n.forEach(function(e){i[e.key]=!1}),e.$set(t,"edittingCell",i),t}),this.thisTableData=c,this.edittingStore=JSON.parse((0,l.default)(this.thisTableData)),this.columnsList.forEach(function(n){n.editable&&(n.render=function(i,l){var a=e.thisTableData[l.index];return a.editting?i("Input",{props:{type:"text",value:a[n.key]},on:{"on-change":function(e){var n=l.column.key;t.edittingStore[l.index][n]=e.target.value}}}):e.editIncell?i("Row",{props:{type:"flex",align:"middle",justify:"center"}},[i("Col",{props:{span:"22"}},[a.edittingCell[l.column.key]?d(e,i,l,n):i("span",a[n.key])]),i("Col",{props:{span:"2"}},[a.edittingCell[l.column.key]?r(e,i,l):o(e,i,l)])]):i("span",a[n.key])}),n.handle&&(n.render=function(t,i){var l=e.thisTableData[i.index];return 2===n.handle.length?t("div",[a(e,t,l,i.index),s(e,t,l,i.index)]):1===n.handle.length?"edit"===n.handle[0]?t("div",[a(e,t,l,i.index)]):t("div",[s(e,t,l,i.index)]):void 0})})},editIndex:function(e){return function(){return e}()},successSave:function(e,t,n){return function(e){var i=t.edittingStore[n];i.editting=!1,i.saveFail=!1,i.saving=!1,t.thisTableData=JSON.parse((0,l.default)(t.edittingStore)),e()}},failSave:function(e,t,n){return function(e){var i=t.edittingStore[n];i.editting=!1,i.saveFail=!0,i.saving=!1,t.thisTableData=JSON.parse((0,l.default)(t.edittingStore)),e()}},deleteIndex:function(e){return function(){return e}()},successDel:function(e,t){return function(n){n();var i=e.edittingStore[t];e.edittingStore.splice(t,1),i.isDeleting=!1,e.thisTableData=JSON.parse((0,l.default)(e.edittingStore))}},failDel:function(e,t){return function(n){n(),e.edittingStore[t].isDeleting=!1,e.thisTableData=JSON.parse((0,l.default)(e.edittingStore))}}},watch:{tableData:function(e){this.init()}}}},718:function(e,t,n){"use strict";function i(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var l=n(792),a=i(l),s=n(724),o=i(s);t.default={components:{EditableTable:a.default},data:function(){return{columnsList:[],tableData:[],breakConnect:!1,lowNetSpeed:!1,editInlineColumns:[],editInlineData:[],editIncellColumns:[],editIncellData:[],editInlineAndCellColumn:[],editInlineAndCellData:[]}},methods:{getData:function(){this.columnsList=o.default.table1Columns,this.tableData=o.default.table1Data,this.editInlineColumns=o.default.editInlineColumns,this.editInlineData=o.default.editInlineData,this.editIncellColumns=o.default.editIncellColumns,this.editIncellData=o.default.editIncellData,this.editInlineAndCellColumn=o.default.editInlineAndCellColumn,this.editInlineAndCellData=o.default.editInlineAndCellData},handleNetConnect:function(e){this.breakConnect=e},handleLowSpeed:function(e){this.lowNetSpeed=e},saveEdit:function(e,t,n){var i=this,l=0;this.lowNetSpeed&&(l=1e3),setTimeout(function(){i.breakConnect?n(function(){i.$Message.error("服务器嫌弃你的网络，所以保存失败")}):t(function(){i.$Message.success("保存成功")})},l)},deleteRow:function(e,t,n){var i=this,l=0;this.lowNetSpeed&&(l=1e3),setTimeout(function(){i.breakConnect?n(function(){i.$Message.error("服务器嫌弃你的网络，所以删除失败")}):t(function(){i.$Message.success("删除数据成功~")})},l)},saveEditInline:function(e,t,n){var i=this,l=0;this.lowNetSpeed&&(l=1e3),setTimeout(function(){i.breakConnect?n(function(){i.$Message.error("服务器嫌弃你的网络，所以保存失败")}):t(function(){i.$Message.success("保存成功")})},l)},deleteRowInline:function(e,t,n){var i=this,l=0;this.lowNetSpeed&&(l=1e3),setTimeout(function(){i.breakConnect?n(function(){i.$Message.error("服务器嫌弃你的网络，所以删除失败")}):t(function(){i.$Message.success("删除数据成功~")})},l)},saveEditIncell:function(e,t,n){var i=this,l=0;this.lowNetSpeed&&(l=1e3),setTimeout(function(){i.breakConnect?n(function(){i.$Message.error("服务器嫌弃你的网络，所以保存失败")}):t(function(){i.$Message.success("保存成功")})},l)},deleteRowIncell:function(e,t,n){var i=this,l=0;this.lowNetSpeed&&(l=1e3),setTimeout(function(){i.breakConnect?n(function(){i.$Message.error("服务器嫌弃你的网络，所以删除失败")}):t(function(){i.$Message.success("删除数据成功~")})},l)},saveEditInlineIncell:function(e,t,n){var i=this,l=0;this.lowNetSpeed&&(l=1e3),setTimeout(function(){i.breakConnect?n(function(){i.$Message.error("服务器嫌弃你的网络，所以保存失败")}):t(function(){i.$Message.success("保存成功")})},l)},deleteRowInlineIncell:function(e,t,n){var i=this,l=0;this.lowNetSpeed&&(l=1e3),setTimeout(function(){i.breakConnect?n(function(){i.$Message.error("服务器嫌弃你的网络，所以删除失败")}):t(function(){i.$Message.success("删除数据成功~")})},l)}},created:function(){this.getData()}}},724:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i=t.table1Columns=[{title:"序号",type:"index",width:80,align:"center"},{title:"姓名",align:"center",key:"name",editable:!0},{title:"性别",align:"center",key:"sex"},{title:"岗位",align:"center",key:"work",editable:!0},{title:"操作",align:"center",width:120,key:"handle",handle:["delete"]}],l=t.table1Data=[{name:"Aresn",sex:"男",work:"前端开发"},{name:"Lison",sex:"男",work:"前端开发"},{name:"lisa",sex:"女",work:"程序员鼓励师"}],a=t.editInlineColumns=[{title:"序号",type:"index",width:80,align:"center"},{title:"姓名",align:"center",key:"name",width:90,editable:!0},{title:"性别",align:"center",key:"sex"},{title:"岗位",align:"center",key:"work",width:150,editable:!0},{title:"操作",align:"center",width:190,key:"handle",handle:["edit","delete"]}],s=t.editInlineData=[{name:"Aresn",sex:"男",work:"前端开发"},{name:"Lison",sex:"男",work:"前端开发"},{name:"lisa",sex:"女",work:"程序员鼓励师"}],o=t.editIncellColumns=[{title:"序号",type:"index",width:80,align:"center"},{title:"姓名",align:"center",key:"name",width:120,editable:!0},{title:"性别",align:"center",key:"sex"},{title:"岗位",align:"center",width:160,key:"work",editable:!0},{title:"操作",align:"center",width:120,key:"handle",handle:["delete"]}],r=t.editIncellData=[{name:"Aresn",sex:"男",work:"前端开发"},{name:"Lison",sex:"男",work:"前端开发"},{name:"lisa",sex:"女",work:"程序员鼓励师"}],d=t.editInlineAndCellColumn=[{title:"序号",type:"index",width:80,align:"center"},{title:"姓名",align:"center",key:"name",width:300,editable:!0},{title:"性别",align:"center",key:"sex"},{title:"岗位",align:"center",width:300,key:"work",editable:!0},{title:"操作",align:"center",width:200,key:"handle",handle:["edit","delete"]}],c=t.editInlineAndCellData=[{name:"Aresn",sex:"男",work:"前端开发"},{name:"Lison",sex:"男",work:"前端开发"},{name:"lisa",sex:"女",work:"程序员鼓励师"}],u={table1Columns:i,table1Data:l,editInlineColumns:a,editInlineData:s,editIncellColumns:o,editIncellData:r,editInlineAndCellColumn:d,editInlineAndCellData:c};t.default=u},744:function(e,t){},768:function(e,t){},792:function(e,t,n){n(768);var i=n(33)(n(716),n(828),null,null);i.options.__file="D:\\web-proj\\laravel_cms\\resources\\assets\\admin\\src\\views\\tables\\components\\editableTable.vue",i.esModule&&Object.keys(i.esModule).some(function(e){return"default"!==e&&"__esModule"!==e})&&console.error("named exports are not supported in *.vue files."),i.options.functional&&console.error("[vue-loader] editableTable.vue: functional components are not supported with templates, they should use render functions."),e.exports=i.exports},794:function(e,t,n){e.exports={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("Row",[n("Col",{attrs:{span:"6"}},[n("Card",[n("p",{attrs:{slot:"title"},slot:"title"},[n("Icon",{attrs:{type:"load-b"}}),e._v("\n                    不同场景效果测试\n                ")],1),e._v(" "),n("div",{staticClass:"edittable-test-con"},[n("p",[e._v("借助vue和iview对原生JS的强大支持，我们对iview的table组件进行了一个定制封装，实现了单元格的可编辑和可删除，您可以在此体验不同场景下编辑和删除功能的不同表现。")]),e._v(" "),n("div",{staticClass:"margin-top-10"},[n("span",{staticClass:"margin-right-10",staticStyle:{color:"#2d8cf0"}},[e._v("断开网络连接:")]),e._v(" "),n("i-switch",{on:{"on-change":e.handleNetConnect}},[n("span",{attrs:{slot:"open"},slot:"open"},[e._v("是")]),e._v(" "),n("span",{attrs:{slot:"close"},slot:"close"},[e._v("否")])])],1),e._v(" "),n("div",{staticClass:"margin-top-10"},[n("span",{staticClass:"margin-right-10",staticStyle:{color:"#2d8cf0"}},[e._v("开启网速限制:")]),e._v(" "),n("i-switch",{on:{"on-change":e.handleLowSpeed}},[n("span",{attrs:{slot:"open"},slot:"open"},[e._v("是")]),e._v(" "),n("span",{attrs:{slot:"close"},slot:"close"},[e._v("否")])])],1)])])],1),e._v(" "),n("Col",{staticClass:"padding-left-10",attrs:{span:"18"}},[n("Card",[n("div",{staticClass:"edittable-con-1"},[n("editable-table",{attrs:{refs:"table1","columns-list":e.columnsList,"table-data":e.tableData,saveEdit:e.saveEdit,deleteRow:e.deleteRow}})],1)])],1)],1),e._v(" "),n("Row",{staticClass:"margin-top-10"},[n("Col",{attrs:{span:"12"}},[n("Card",[n("p",{attrs:{slot:"title"},slot:"title"},[n("Icon",{attrs:{type:"android-remove"}}),e._v("\n                    可编辑单元行\n                ")],1),e._v(" "),n("div",{staticClass:"edittable-table-height-con"},[n("editable-table",{attrs:{refs:"table2","columns-list":e.editInlineColumns,"table-data":e.editInlineData,saveEdit:e.saveEditInline,deleteRow:e.deleteRowInline}})],1)])],1),e._v(" "),n("Col",{staticClass:"padding-left-10",attrs:{span:"12"}},[n("Card",[n("p",{attrs:{slot:"title"},slot:"title"},[n("Icon",{attrs:{type:"android-more-horizontal"}}),e._v("\n                    可编辑单元格(鼠标移入显示编辑单元格按钮)\n                ")],1),e._v(" "),n("div",{staticClass:"edittable-table-height-con"},[n("editable-table",{attrs:{refs:"table2","hover-show":!0,"edit-incell":!0,"columns-list":e.editIncellColumns,"table-data":e.editIncellData,saveEdit:e.saveEditIncell,deleteRow:e.deleteRowIncell}})],1)])],1)],1),e._v(" "),n("Row",{staticClass:"margin-top-10"},[n("Col",{attrs:{span:"24"}},[n("Card",[n("p",{attrs:{slot:"title"},slot:"title"},[n("Icon",{attrs:{type:"ios-keypad"}}),e._v("\n                     单元行和单元格两种方式编辑(始终显示编辑单元格按钮)\n                ")],1),e._v(" "),n("div",{staticClass:"edittable-table-height-con"},[n("editable-table",{attrs:{refs:"table3",editIncell:!0,"columns-list":e.editInlineAndCellColumn,"table-data":e.editInlineAndCellData,saveEdit:e.saveEditInlineIncell,deleteRow:e.deleteRowInlineIncell}})],1)])],1)],1)],1)},staticRenderFns:[]},e.exports.render._withStripped=!0},828:function(e,t,n){e.exports={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("Table",{ref:e.refs,attrs:{columns:e.columnsList,data:e.thisTableData,border:"","disabled-hover":""}})],1)},staticRenderFns:[]},e.exports.render._withStripped=!0}});