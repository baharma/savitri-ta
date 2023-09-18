import './bootstrap';
import axios from "axios";
import Alpine from 'alpinejs';



window.axios = axios;
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken;

window.Alpine = Alpine;

Alpine.start();
