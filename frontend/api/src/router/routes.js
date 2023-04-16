import DashboardLayout from "@/layout/dashboard/DashboardLayout.vue";
// GeneralViews
import NotFound from "@/pages/NotFoundPage.vue";

// Admin pages
const PersonList = () => import(/* webpackChunkName: "common" */ "@/pages/PersonList.vue")
const PersonAdd = () => import(/* webpackChunkName: "common" */ "@/pages/PersonAdd.vue")
const PersonEdit = () => import(/* webpackChunkName: "common" */ "@/pages/PersonEdit.vue")

const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/person",
    children: [
      {
        path: "person",
        name: "person-list",
        component: PersonList
      },
      {
        path: "person/add",
        name: "person-add",
        component: PersonAdd
      },
      {
        path: "person/edit/:id",
        name: "person-edit",
        component: PersonEdit
      },
    ]
  },
  { path: "*", component: NotFound },
];

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes;
