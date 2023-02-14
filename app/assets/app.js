import './styles/app.css';
import './bootstrap';

import { registerVueControllerComponents } from '@symfony/ux-vue';
import "bootswatch/dist/cyborg/bootstrap.min.css";

registerVueControllerComponents(require.context('./controllers', true, /\.vue$/));

globalThis.__VUE_OPTIONS_API__ = true;
globalThis.__VUE_PROD_DEVTOOLS__ = false;