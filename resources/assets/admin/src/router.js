import Main from './views/Main.vue';

// 不作为Main组件的子页面展示的页面单独写，如下
export const loginRouter = {
    path: '/login',
    name: 'login',
    meta: {
        title: 'Login - 登录'
    },
    component: resolve => { require(['./views/login.vue'], resolve); }
};

export const page404 = {
    path: '/*',
    name: 'error_404',
    meta: {
        title: '404-页面不存在'
    },
    component: resolve => { require(['./views/error_page/404.vue'], resolve); }
};

export const page401 = {
    path: '/401',
    meta: {
        title: '401-权限不足'
    },
    name: 'error_401',
    component: resolve => { require(['./views/error_page/401.vue'], resolve); }
};

export const page500 = {
    path: '/500',
    meta: {
        title: '500-服务端错误'
    },
    name: 'error_500',
    component: resolve => { require(['./views/error_page/500.vue'], resolve); }
};

export const preview = {
    path: '/preview',
    name: 'preview',
    component: resolve => { require(['./views/form/article-publish/preview.vue'], resolve); }
};

export const locking = {
    path: '/locking',
    name: 'locking',
    component: resolve => { require(['./views/main_components/locking-page.vue'], resolve); }
};

// 作为Main组件的子页面展示但是不在左侧菜单显示的路由写在otherRouter里
export const otherRouter = {
    path: '/',
    name: 'otherRouter',
    redirect: '/home',
    component: Main,
    children: [
        { path: 'home', title: '首页', name: 'home_index', component: resolve => { require(['./views/home/home.vue'], resolve); } },
        { path: 'ownspace', title: '个人中心', name: 'ownspace_index', component: resolve => { require(['./views/own-space/own-space.vue'], resolve); } },
        { path: 'ownspace/:username', title: '带参个人中心', name: 'ownspace_with_name', component: resolve => { require(['./views/own-space/own-space.vue'], resolve); } },  // 用于展示带参路由
        { path: 'order/:order_id', title: '订单详情', name: 'order_info', component: resolve => { require(['./views/argument-page/order-info.vue'], resolve); } },  // 用于展示带参路由
        { path: 'message', title: '消息中心', name: 'message_index', component: resolve => { require(['./views/message/message.vue'], resolve); } },
        { path: 'content/edit', title: '内容编辑', name: 'content_edit', component: resolve => { require(['./views/content/edit.vue'], resolve); } },
        { path: 'content/add', title: '内容添加', name: 'content_add', component: resolve => { require(['./views/content/add.vue'], resolve); } }
    ]
};

// 作为Main组件的子页面展示并且在左侧菜单显示的路由写在appRouter里
export const appRouter = [
    {
        path: '/access',
        redirect: '/access/index',
        icon: 'key',
        name: 'access',
        title: '权限管理',
        component: Main,
        children: [
            { path: 'index', title: '权限管理', name: 'access_index', component: resolve => { require(['./views/access/access.vue'], resolve); } }
        ]
    },
    {
        path: '/access-test',
        icon: 'lock-combination',
        title: '权限测试页',
        name: 'accesstest',
        access: 0,
        component: Main,
        children: [
            { path: 'index', title: '权限测试页', name: 'accesstest_index' }
        ]
    },
    {
        path: '/component',
        icon: 'social-buffer',
        name: 'component',
        title: '组件',
        component: Main,
        children: [
            {
                path: 'text-editor',
                icon: 'compose',
                name: 'text-editor',
                title: '富文本编辑器',
                component: resolve => { require(['./views/my_components/text-editor/text-editor.vue'], resolve); }
            },
            {
                path: 'md-editor',
                icon: 'pound',
                name: 'md-editor',
                title: 'Markdown编辑器',
                component: resolve => { require(['./views/my_components/markdown-editor/markdown-editor.vue'], resolve); }
            },
            {
                path: 'image-editor',
                icon: 'crop',
                name: 'image-editor',
                title: '图片预览编辑',
                component: resolve => { require(['./views/my_components/image-editor/image-editor.vue'], resolve); }
            },
            {
                path: 'draggable-list',
                icon: 'arrow-move',
                name: 'draggable-list',
                title: '可拖拽列表',
                component: resolve => { require(['./views/my_components/draggable-list/draggable-list.vue'], resolve); }
            },
            {
                path: 'file-upload',
                icon: 'android-upload',
                name: 'file-upload',
                title: '文件上传',
                component: resolve => { require(['./views/my_components/file-upload/file-upload.vue'], resolve); }
            },
            {
                path: 'count-to',
                icon: 'arrow-graph-up-right',
                name: 'count-to',
                title: '数字渐变',
                component: resolve => { require(['./views/my_components/count-to/count-to.vue'], resolve); }
            }
        ]
    },
    {
        path: '/form',
        icon: 'android-checkbox',
        name: 'form',
        title: '表单编辑',
        component: Main,
        children: [
            { path: 'artical-publish', title: '文章发布', name: 'articalpublish', icon: 'compose', component: resolve => { require(['./views/form/article-publish/article-publish.vue'], resolve); } },
            { path: 'workflow', title: '工作流', name: 'workflow', icon: 'arrow-swap', component: resolve => { require(['./views/form/work-flow/work-flow.vue'], resolve); } }

        ]
    },
    // {
    //     path: '/charts',
    //     icon: 'ios-analytics',
    //     name: 'charts',
    //     title: '图表',
    //     component: Main,
    //     children: [
    //         { path: 'pie', title: '饼状图', name: 'pie', icon: 'ios-pie', component: resolve => { require('./views/access/access.vue') },
    //         { path: 'histogram', title: '柱状图', name: 'histogram', icon: 'stats-bars', component: resolve => { require('./views/access/access.vue') }

    //     ]
    // },
    {
        path: '/tables',
        icon: 'ios-grid-view',
        name: 'tables',
        title: '表格',
        component: Main,
        children: [
            { path: 'dragableTable', title: '可拖拽排序', name: 'dragableTable', icon: 'arrow-move', component: resolve => { require(['./views/tables/dragable-table.vue'], resolve); } },
            { path: 'editableTable', title: '可编辑表格', name: 'editableTable', icon: 'edit', component: resolve => { require(['./views/tables/editable-table.vue'], resolve); } },
            { path: 'exportableTable', title: '表格导出数据', name: 'exportableTable', icon: 'code-download', component: resolve => { require(['./views/tables/exportable-table.vue'], resolve); } },
        ]
    },
    {
        path: '/argument-page',
        icon: 'ios-infinite',
        name: 'argupage',
        title: '带参页面',
        component: Main,
        children: [
            { path: 'index', title: '带参页面', name: 'argupage_index', component: resolve => { require(['./views/argument-page/argument-page.vue'], resolve); } }
        ]
    },
    {
        path: '/error-page',
        icon: 'android-sad',
        title: '错误页面',
        name: 'errorpage',
        component: Main,
        children: [
            { path: 'index', title: '错误页面', name: 'errorpage_index', component: resolve => { require(['./views/error_page/error-page.vue'], resolve); } }
        ]
    },
    {
        path: '/about',
        icon: 'ios-people-outline',
        name: 'about-us',
        title: '关于我们',
        component: Main,
        children: [
            { path: 'us', title: '我们介绍', name: 'us', icon: 'edit', component: resolve => { require(['./views/about/us.vue'], resolve); } },
            { path: 'background', title: '我们背景', name: 'background', icon: 'edit', component: resolve => { require(['./views/about/background.vue'], resolve); } },
            { path: 'structure', title: '我们结构', name: 'structure', icon: 'edit', component: resolve => { require(['./views/about/structure.vue'], resolve); } },
            { path: 'strategy', title: '我们战略', name: 'strategy', icon: 'edit', component: resolve => { require(['./views/about/strategy.vue'], resolve); } },
            { path: 'brand', title: '我们中心', name: 'brand', icon: 'edit', component: resolve => { require(['./views/about/brand.vue'], resolve); } },
            { path: 'culture', title: '我们文化', name: 'culture', icon: 'edit', component: resolve => { require(['./views/about/culture.vue'], resolve); } },
            { path: 'joinus', title: '加入我们', name: 'joinus', icon: 'edit', component: resolve => { require(['./views/about/joinus.vue'], resolve); } }
        ]
    },
    {
        path: '/news',
        icon: 'speakerphone',
        name: 'new-center',
        title: '新闻中心',
        component: Main,
        children: [
            { path: 'industry-news', title: '行业新闻', name: 'industry-news', icon: 'stats-bars', component: resolve => { require(['./views/news/industry-news.vue'], resolve); } },
            { path: 'corp-trends', title: '公司动态', name: 'corp-trends', icon: 'arrow-graph-up-right', component: resolve => { require(['./views/news/corp-trends.vue'], resolve); } },
        ]
    },
    {
        path: '/business',
        icon: 'ios-pulse-strong',
        name: 'business',
        title: '哈哈测试',
        component: Main,
        children: [
            { path: 'wealth-manage', title: '财富管理', name: 'wealth-manage', icon: 'arrow-move', component: resolve => { require(['./views/business/wealth-manage.vue'], resolve); } },
            { path: 'asset-manage', title: '资产管理', name: 'asset-manage', icon: 'edit', component: resolve => { require(['./views/business/asset-manage.vue'], resolve); } },
            { path: 'insurance-agent', title: '保险经纪', name: 'insurance-agent', icon: 'arrow-move', component: resolve => { require(['./views/business/insurance-agent.vue'], resolve); } },
            { path: 'network-credit', title: '网络信贷', name: 'network-credit', icon: 'edit', component: resolve => { require(['./views/business/network-credit.vue'], resolve); } },
            { path: 'inclusive-finance', title: '普惠金融', name: 'inclusive-finance', icon: 'edit', component: resolve => { require(['./views/business/inclusive-finance.vue'], resolve); } },
            { path: 'commercial-factoring', title: '商业保理', name: 'commercial-factoring', icon: 'edit', component: resolve => { require(['./views/business/commercial-factoring.vue'], resolve); } },
            { path: 'overseas-securities', title: '海外证券', name: 'overseas-securities', icon: 'edit', component: resolve => { require(['./views/business/overseas-securities.vue'], resolve); } },
            { path: 'finance-lease', title: '融资租赁', name: 'finance-lease', icon: 'edit', component: resolve => { require(['./views/business/finance-lease.vue'], resolve); } },
        ]
    },
    {
        path: '/research',
        icon: 'erlenmeyer-flask',
        name: 'research',
        title: '研究测试',
        component: Main,
        children: [
            { path: 'research', title: '研究测试', name: 'research', icon: 'arrow-move', component: resolve => { require(['./views/research/research.vue'], resolve); } },
            { path: 'financial-knowledge', title: '金融知识', name: 'financial-knowledge', icon: 'edit', component: resolve => { require(['./views/research/financial-knowledge.vue'], resolve); } },
        ]
    },
    {
        path: '/responsibility',
        icon: 'ribbon-a',
        name: 'responsibility',
        title: '责任测试',
        component: Main,
        children: [
            { path: 'public-service', title: '公益活动', name: 'public-service', icon: 'arrow-move', component: resolve => { require(['./views/responsibility/public-service.vue'], resolve); } },
            { path: 'charity-sponsorship', title: '慈善赞助', name: 'charity-sponsorship', icon: 'edit', component: resolve => { require(['./views/responsibility/charity-sponsorship.vue'], resolve); } },
        ]
    },
    {
        path: '/contactus',
        icon: 'ios-location',
        name: 'contactus',
        title: '联系我们',
        component: Main,
        children: [
            { path: 'beijing', title: '北京中心', name: 'beijing', icon: 'arrow-move', component: resolve => { require(['./views/contactus/beijing.vue'], resolve); } },
            { path: 'shenzhen', title: '深圳中心', name: 'shenzhen', icon: 'edit', component: resolve => { require(['./views/contactus/shenzhen.vue'], resolve); } },
        ]
    }
];

// 所有上面定义的路由都要写在下面的routers里
export const routers = [
    loginRouter,
    otherRouter,
    preview,
    locking,
    ...appRouter,
    page500,
    page401,
    page404
];
