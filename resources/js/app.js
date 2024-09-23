import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import FloatingConfigurator from './vite-project/components/FloatingConfigurator.vue'

applyStyles.component("FloatingConfigurator",FloatingConfigurator)

createApp(App).mount("#app");