import { createRouter, createWebHistory } from "vue-router";
// import auth from '../utils/auth'
// import { nextFactory } from './middleware'
// import MainPage from '@/pages/MainPage/MainPage.vue';

export const ROUTER_CONST = {
    main: "/",
    admin: {
        main: "/admin/",
    },
    //   profile: '/profile',
    //   profileEdit: '/profile_edit',
    //   settings: '/settings',
    //   lenta: '/lenta',
    //   chat: '/chat',
    //   messages: '/messages',
    //   like: '/like',
    //   wizardMan: '/wizard-man',
    //   userAgreement: '/user-agreement',
    //   personalPolicy: '/personal-policy',
    //   contacts: '/contacts'
};

const routes = [
    {
        path: ROUTER_CONST.main,
        name: "MainPage",
        component: () =>
            import(/* webpackChunkName: "MainPage" */ "@/pages/MainPage.vue"),
    },

    {
        path: ROUTER_CONST.admin.main,
        name: "AdminMainPage",
        component: () =>
            import(
                /* webpackChunkName: "AdminMainPage" */ "@/pages/admin/Main/index.vue"
            ),
    },
    //   {
    //     path: ROUTER_CONST.profile + '/:id',
    //     name: 'ProfilePage',
    //     component: () => import(/* webpackChunkName: "ProfilePage" */ '@/pages/ProfilePage/ProfilePage.vue'),
    //     meta: {
    //       middleware: [
    //         auth,
    //       ]
    //     },
    //   },
    //   {
    //     path: ROUTER_CONST.profileEdit,
    //     name: 'ProfileEditPage',
    //     component: () => import(/* webpackChunkName: "ProfileEditPage" */ '@/pages/ProfileEditPage/ProfileEditPage.vue'),
    //     meta: {
    //       middleware: [
    //         auth
    //       ]
    //     }
    //   },
    //   {
    //     path: ROUTER_CONST.settings,
    //     name: 'SettingsPage',
    //     component: () => import(/* webpackChunkName: "SettingsPage" */ '@/pages/SettingsPage/SettingsPage.vue'),
    //     meta: {
    //       middleware: [
    //         auth,
    //       ]
    //     },
    //   },
    //   {
    //     path: ROUTER_CONST.lenta,
    //     name: 'LentaPage',
    //     component: () => import(/* webpackChunkName: "LentaPage" */ '@/pages/LentaPage/LentaPage.vue'),
    //     meta: {
    //       middleware: [
    //         auth,
    //       ]
    //     },
    //   },
    //   {
    //     path: ROUTER_CONST.chat,
    //     name: 'ChatPage',
    //     component: () => import(/* webpackChunkName: "ChatPage" */ '@/pages/ChatPage/ChatPage.vue'),
    //     meta: {
    //       middleware: [
    //         auth,
    //       ]
    //     },
    //   },
    //   {
    //     path: ROUTER_CONST.messages + '/:id',
    //     name: 'MessagePage',
    //     component: () => import(/* webpackChunkName: "MessagePage" */ '@/pages/MessagePage/MessagePage.vue'),
    //     meta: {
    //       middleware: [
    //         auth,
    //       ]
    //     },
    //   },
    //   {
    //     path: ROUTER_CONST.like,
    //     name: 'LikePage',
    //     component: () => import(/* webpackChunkName: "LikePage" */ '@/pages/LikePage/LikePage.vue'),
    //     meta: {
    //       middleware: [
    //         auth,
    //       ]
    //     },
    //   },
    //   {
    //     path: ROUTER_CONST.wizardMan,
    //     name: 'WizardManPage',
    //     component: () => import(/* webpackChunkName: "WizardManPage" */ '@/pages/WizardManPage/WizardManPage.vue')
    //   },
    //   {
    //     path: ROUTER_CONST.userAgreement,
    //     name: 'UserAgreementPage',
    //     component: () => import(/* webpackChunkName: "UserAgreementPage" */ '@/pages/UserAgreementPage/UserAgreementPage.vue')
    //   },
    //   {
    //     path: ROUTER_CONST.personalPolicy,
    //     name: 'PersonalPolicyPage',
    //     component: () => import(/* webpackChunkName: "PersonalPolicyPage" */ '@PersonalPolicyPage/PersonalPolicyPage.vue')
    //   },
    //   {
    //     path: ROUTER_CONST.contacts,
    //     name: 'ContactsPage',
    //     component: () => import(/* webpackChunkName: "ContactsPage" */ '@/pages/ContactsPage/ContactsPage.vue')
    //   }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// export const middlewareRouter = () => {
//   router.beforeEach((to, from, next) => {
//     if (!to.meta.middleware) return next();

//     const middleware = Array.isArray(to.meta.middleware)
//       ? to.meta.middleware
//       : [to.meta.middleware];
//     const context = {
//       to,
//       from,
//       next,
//       router,
//     };

//     return middleware[0]({ ...context, next: nextFactory(context, middleware, 1) });
//   });
// }
// middlewareRouter();
export default router;
