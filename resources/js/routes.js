import List from './components/bookings/List.vue';
import Add from './components/bookings/Add.vue';
import Update from './components/bookings/Update.vue';

export const routes = [
  {
    name: 'home',
    path: '/',
    component: List
  },
  {
    name: 'add',
    path: '/add',
    component: Add
  },
  {
    name: 'edit',
    path: '/edit/:id',
    component: Update
  }
];