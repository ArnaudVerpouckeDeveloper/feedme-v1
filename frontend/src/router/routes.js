import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Contact from '../views/Contact.vue'
import Faq from '../views/Faq.vue'


export const routes = [
    { path: '/', name: 'home', component: Home, display:'Home', icon: "mdi-home"},
    { path: '/about', name: 'about', component: About, display:'About', icon: "mdi-account-multiple",},
    { path: '/contact', name: 'contact', component: Contact, display:'Contact', icon: "mdi-frequently-asked-questions",},
    { path: '/faq', name: 'faq', component: Faq, display:'Faq', icon: "mdi-email",},
]