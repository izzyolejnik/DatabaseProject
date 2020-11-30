import Vue from 'vue'
import VueRouter from 'vue-router'

import HomePage from './components/home/homepage.vue'
import EventHomePage from './components/userview/eventhome.vue'
import SignupPage from './components/auth/signup.vue'
import SigninPage from './components/auth/signin.vue'

Vue.use(VueRouter)

const routes = [
  { path: '/', component: HomePage },
  { path: '/signup', component: SignupPage },
  { path: '/signin', component: SigninPage },
  { path: '/eventhome', component: EventHomePage }
]

export default new VueRouter({mode: 'history', routes})