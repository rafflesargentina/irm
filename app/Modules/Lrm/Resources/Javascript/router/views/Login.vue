<template>
  <form
    action="/login"
    :class="[validated ? 'needs-validation' : 'needs-validation']"
    method="post"
    aria-label="Ingresá"
    novalidate
    @keydown="form.errors.clear($event.target.name)"
    @submit.prevent="login"
  >
  <div class="wrapper">
    <div
      class="section page-header header-filter"
      :style="headerStyle"
    >
      <div class="container">
        <div class="md-layout">
          <div
            class="md-layout-item md-size-33 md-small-size-66 md-xsmall-size-100 md-medium-size-40 mx-auto"
          >
            <login-card header-color="green">
              <h4
                slot="title"
                class="card-title"
              >
                Ingresá
              </h4>
        <md-field
          slot="inputs"
          class="md-form-group"
          :class="{ 'md-invalid': form.errors.has('email') }"
        >
          <md-icon>email</md-icon>
          <label>Email</label>
          <md-input
            v-model="form.email"
            type="email"
            required
          />
          <span
            v-if="form.errors.has('email')"
            class="md-error"
          >{{ form.errors.get('email') }}</span>
        </md-field>
        <md-field
          slot="inputs"
          class="md-form-group"
          :class="{ 'md-invalid': form.errors.has('password') }"
        >
          <md-icon>lock_outline</md-icon>
          <label>Contraseña</label>
          <md-input
            v-model="form.password"
            type="password"
            required
          />
          <span
            v-if="form.errors.has('password')"
            class="md-error"
          >{{ form.errors.get('password') }}</span>
        </md-field>
        <md-button
          slot="footer"
          class="md-simple md-success md-lg"
          type="submit"
        >
          Ingresa
        </md-button>
            </login-card>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
</template>

<script>
import Form from "@/utilities/Form"

var fields = {
    email: "",
    password: "",
}

export default {
    bodyClass: "login-page",

    data() {
        return {
            form: new Form(fields),
            submitted: false
        }
    },
    props: {
        header: {
            type: String,
            default: require("@irm/assets/img/profile_city.jpg")
        }
    },

    data() {
        return {
            form: new Form(fields),
            submitted: false
        }
    },

    computed: {
        headerStyle() {
            return {
                backgroundImage: `url(${this.header})`
            }
        },

        validated() {
            return this.form.errors.any()
        }
    },

    methods: {
        login() {
            this.submitted = true

            this.form.post("/login")
                .then(response => {
                    return this.$store.dispatch("auth/login", response)
                })
                .then(response => {
                    //let intended = this.$route.query.intended
                    //let redirect = intended || response.redirect || "/"
                    return this.$router.push({ name: 'Home' })
                })
                .catch(()=> {
                    this.submitted = false
                })
        }
    }
}
</script>

<style lang="css"></style>
