import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/home/Home.vue";
import TestView from "../views/test/Test.vue";
import TodoList from "../views/todoList/TodoList.vue";
import Brand from "../views/brand/Brand.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/test",
      name: "test",
      component: TestView,
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
    {
      path: "/todoList",
      name: "todoList",
      component: TodoList,
    },
    {
      path: "/brand",
      name: "brand",
      component: Brand,
    },
  ],
});

export default router;
