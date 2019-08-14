import * as middleware from "@/router/middleware"
import multiguard from "vue-router-multiguard"
import router from "@/router"

import MainNavbar from "@irm/components/layout/MainNavbar.vue"
import MainFooter from "@irm/components/layout/MainFooter.vue"

router.addRoutes(
    [
    {
            beforeEnter: middleware.authNotRequired,
            component: view("Login"),
            name: "Login",
            path: "/login"
        },
        {
            components: { default: view("Contacts/Index"), header: MainNavbar, footer: MainFooter },
            props: {
                header: { colorOnScroll: 400 },
                footer: { backgroundColor: "black" }
            },
            name: "Home",
            path: "/"
        },
        {
            components: { default: view("Contacts/Edit"), header: MainNavbar, footer: MainFooter },
            beforeEnter: middleware.authRequired,
            name: "ContactsEdit",
            path: "/contacts/:id/edit"
        },
        {
            components: { default: view("Contacts/Show"), header: MainNavbar, footer: MainFooter },
            beforeEnter: middleware.authRequired,
            name: "ContactsShow",
            path: "/contacts/:id",
            props: {
                header: { colorOnScroll: 400 },
                footer: { backgroundColor: "black" }
            }
        },
    ]
)

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 *
 * @param {string} name The filename (basename) of the view to load.
 */
function view(name) {
    return function(resolve) {
        require(["./views/" + name + ".vue"], resolve)
    }
}
