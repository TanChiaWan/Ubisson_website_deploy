/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import Organization from './components/Organization.vue';
app.component('example-component', ExampleComponent);
app.component('organization', Organization);
import Professional from './components/professional.vue';
app.component('professional', Professional);
import Role from './components/role.vue';
app.component('role', Role);
import Permission from './components/permission.vue';
app.component('permission', Permission);
import Patient from './components/patient.vue';
app.component('patient', Patient);
import Patientorg from './components/patientorg.vue';
app.component('patientorg', Patientorg);
import Patient2 from './components/patient2.vue';
app.component('patient2', Patient2);

import Usercheck from './components/usercheck.vue';
app.component('usercheck', Usercheck);

import Practice_group from './components/practice_group.vue';
app.component('practice_group', Practice_group);

import Practicegroup from './components/practicegroup.vue';
app.component('practicegroup', Practicegroup);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');