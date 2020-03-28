import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Faq from '../views/Faq.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Products from '../views/admin/Products.vue'
import Merchant from '../views/Merchant.vue'
import Order from '../views/Order.vue'

export const routes = [
    { path: '/', name: 'home', component: Home, display:'Home', icon: "mdi-home"},
    { path: '/about', name: 'about', component: About, display:'About', icon: "mdi-account-multiple"},
    { path: '/#contact', name: 'contact', component: null, display:'Contact', icon: "mdi-frequently-asked-questions"},
    { path: '/faq', name: 'faq', component: Faq, display:'Faq', icon: "mdi-email"},
    { path: '/login', name: 'login', component: Login, display:'hide', icon: "mdi-login-variant"},
    { path: '/register', name: 'register', component: Register, display:'hide', icon: "mdi-account-plus"},
    { path: '/products', name: 'products', component: Products, display:'Producten', icon: "mdi-store"},
    { path: '/merchant', name: 'Merchants', component: Merchant, display:'Merchant', icon: ""},
    { path: '/confirmorder', name: 'Order', component: Order, display:'hide', icon: ""},
]