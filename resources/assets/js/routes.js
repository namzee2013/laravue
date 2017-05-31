import VueRouter from 'vue-router'

const routes = [
  {
      path: '/',
      component: require('./components/Index')
  },
  {
    name: 'login',
    path: '/login',
    component: require('./components/auth/Login')
  },
  {
    name: 'role',
    path: '/role',
    component: require('./components/role/Index.vue')
  },
  {
    name: 'role.create',
    path: '/role/create',
    component: require('./components/role/Create.vue')
  },
  {
    name: 'role.edit',
    path: '/role/:id/edit',
    component: require('./components/role/Edit.vue')
  },
  {
    name: 'employee',
    path: '/employee',
    component: require('./components/employee/Index.vue')
  },
  {
    name: 'employee.create',
    path: '/employee/create',
    component: require('./components/employee/Create')
  },
  {
    name: 'employee.edit',
    path: '/employee/:id/edit',
    component: require('./components/employee/Edit')
  },
  {
    name: 'category',
    path: '/category',
    component: require('./components/category/Index')
  },
  {
    name: 'category.create',
    path: '/category/create',
    component: require('./components/category/Create')
  },
  {
    name: 'category.edit',
    path: '/category/:id/edit',
    component: require('./components/category/Edit')
  },
  {
    name: 'product',
    path: '/product',
    component: require('./components/product/Index')
  },
  {
    name: 'product.create',
    path: '/product/create',
    component: require('./components/product/Create')
  },
  {
    name: 'product.edit',
    path: '/product/:id/edit',
    component: require('./components/product/Edit')
  },
  {
    name: 'billInput',
    path: '/bill-input',
    component: require('./components/billinput/Index')
  },
  {
    name: 'billInput.modified',
    path: '/bill-input/modified/:id',
    component: require('./components/billinput/Modified')
  },
  {
    name: 'shopping',
    path: '/shopping',
    component: require('./components/shopping/Shopping')
  }
];

export default new VueRouter({
  routes
});
