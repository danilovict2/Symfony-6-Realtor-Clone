import { registerVueControllerComponents } from '@symfony/ux-vue';
import './bootstrap.js';
import plugin from 'vue-toastify';
import './styles/app.scss';
import timeago from 'vue-timeago3'

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));

document.addEventListener('vue:before-mount', (event) => {
    const {
        componentName,
        component, 
        props, 
        app, 
    } = event.detail;

    app.use(plugin, {});
    app.use(timeago);
});