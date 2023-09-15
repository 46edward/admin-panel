import {createRouter, createWebHistory} from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/users/login',
            component: () => import('./components/User/Login.vue'),
            name: 'user.login'
        },
        {
            path: '/users/registration',
            component: () => import('./components/User/Registration.vue'),
            name: 'user.registration'
        },
        {
            path: '/users/personal',
            component: () => import('./components/User/Personal.vue'),
            name: 'user.personal'
        },
        {
            path: '/users',
            component: () => import('./components/User/Index.vue'),
            name: 'user.index'
        },
        {
            path: '/posts',
            component: () => import('./components/Posts/Index.vue'),
            name: 'posts.index'
        },
        {
            path: '/posts/create',
            component: () => import('./components/Posts/Create.vue'),
            name: 'posts.create'
        },
        {
            path: '/:catchAll(.*)',
            component: () => import('./components/404.vue'),
            name: 'error.404'
        }
    ]
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('access_token')

    if(to.name !== 'user.login' && to.name !== 'user.registration'){
        if(!token) {
            next({
                name: 'user.login'
            })
        }
    }

    if(to.name === 'user.login' || to.name === 'user.registration'){
        if(token){
            next({
                name: 'user.personal'
            })
        }
    }

    next()
})

export {router}

