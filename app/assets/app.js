import './styles/app.css';
import './bootstrap';
import { createApp } from 'vue';
import App from './vue/App.vue';
import "bootswatch/dist/cyborg/bootstrap.min.css";

import Navbar from './vue/components/Navbar.vue';


const app = createApp(App);
app.component('Navbar', Navbar); 

app.mount('#vue-app');