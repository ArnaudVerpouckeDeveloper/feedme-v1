import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Products from '../views/admin/Products.vue'
import Merchants from '../views/Merchants.vue'
import MerchantDetail from '../views/Merchant-Detail.vue'
import Order from '../views/Order.vue'



export const routes = [
    { path: '/', name: 'home', component: Home, display: 'Home', icon: "mdi-home" },
    { path: '/#about', name: 'about', component: null, display: 'Over ons', icon: "mdi-account-multiple" },
    { path: '/#faq', name: 'faq', component: null, display: 'Faq', icon: "mdi-frequently-asked-questions" },
    { path: '/#contact', name: 'contact', component: null, display: 'Contact', icon: "mdi-email" },
    { path: '/login', name: 'login', component: Login, display: 'hide', icon: "mdi-login-variant" },
    { path: '/register', name: 'register', component: Register, display: 'hide', icon: "mdi-account-plus" },
    { path: '/admin/products/:id', name: 'products', component: Products, display: 'hide', icon: "" },
    { path: '/restaurant', name: 'Merchants', component: Merchants, display: 'Restaurants', icon: "mdi-store" },
    { path: '/restaurant/:id', name: 'MerchantDetail', component: MerchantDetail, display: 'hide', icon: ""},
    { path: '/confirmorder', name: 'Order', component: Order, display: 'hide', icon: "" },
]