<style lang="scss" scoped>
.section {
  padding: 0;
}
</style>

<template>
  <div class="wrapper">
    <parallax
      class="section page-header header-filter"
      :style="headerStyle"
    />
    <form
      :class="[validated ? 'needs-validation' : 'needs-validation']"
      class="form-horizontal"
      novalidate
      @submit.prevent="submitForm"
      @keydown="form.errors.clear($event.target.name)"
    >
      <div class="section profile-content">
        <div class="container">
          <div class="md-layout">
            <div class="md-layout-item md-size-75 mx-auto">
              <div class="profile">
                <div class="avatar">
                  <img
                    :src="img"
                    alt="Circle Image"
                    class="img-raised rounded-circle img-fluid"
                  >
                </div>
                <div class="name">
                  <h3 class="title">
                    {{ oneContact.name }}
                  </h3>
                </div>

                <nav-tabs-card no-label>
                  <template slot="content">
                    <md-tabs
                      class="md-primary"
                      md-alignment="left"
                    >
                      <md-tab
                        id="tab-home"
                        md-label="Datos Personales"
                        md-icon="face"
                      >
                        <div class="md-layout">
                          <label class="md-layout-item md-size-25 md-form-label">Nombre</label>
                          <div class="md-layout-item">
                            <md-field
                              :class="[
                                { 'md-form-group': true },
                                { 'md-error': form.errors.has('first_name') }
                              ]"
                            >
                              <md-input
                                v-model="form.first_name"
                                name="first_name"
                                type="text"
                              />
                              <span
                                v-if="form.errors.has('first_name')"
                                class="md-error"
                              >{{ form.errors.get('first_name') }}</span>
                            </md-field>
                          </div>
                        </div>
                        <div class="md-layout">
                          <label class="md-layout-item md-size-25 md-form-label">Apellido</label>
                          <div class="md-layout-item">
                            <md-field
                              :class="[
                                { 'md-form-group': true },
                                { 'md-error': form.errors.has('last_name') }
                              ]"
                            >
                              <md-input
                                v-model="form.last_name"
                                name="last_name"
                                type="text"
                              />
                              <span
                                v-if="form.errors.has('last_name')"
                                class="md-error"
                              >{{ form.errors.get('last_name') }}</span>
                            </md-field>
                          </div>
                        </div>

                        <div class="md-layout">
                          <label class="md-layout-item md-size-25 md-form-label">Email</label>
                          <div class="md-layout-item">
                            <md-field
                              :class="[
                                { 'md-form-group': true },
                                { 'md-error': form.errors.has('email') }
                              ]"
                            >
                              <md-input
                                v-model="form.email"
                                name="email"
                                type="email"
                                required
                              />
                              <span
                                v-if="form.errors.has('email')"
                                class="md-error"
                              >{{ form.errors.get('email') }}</span>
                            </md-field>
                          </div>
                        </div>

                        <div class="md-layout">
                          <label class="md-layout-item md-size-25 md-form-label">Teléfono principal</label>
                          <div class="md-layout-item">
                            <md-field
                              :class="[
                                { 'md-form-group': true },
                                { 'md-error': form.errors.has('phone') }
                              ]"
                            >
                              <md-input
                                v-model="form.phone"
                                name="phone"
                                type="text"
                              />
                              <span
                                v-if="form.errors.has('phone')"
                                class="md-error"
                              >{{ form.errors.get('phone') }}</span>
                            </md-field>
                          </div>
                        </div>

                        <div class="md-layout">
                          <label class="md-layout-item md-size-25 md-form-label">Teléfono móvil</label>
                          <div class="md-layout-item">
                            <md-field
                              :class="[
                                { 'md-form-group': true },
                                { 'md-error': form.errors.has('movil') }
                              ]"
                            >
                              <md-input
                                v-model="form.mobile"
                                name="mobile"
                                type="text"
                              />
                              <span
                                v-if="form.errors.has('mobile')"
                                class="md-error"
                              >{{ form.errors.get('mobile') }}</span>
                            </md-field>
                          </div>
                        </div>

                        <div class="md-layout">
                          <label class="md-layout-item md-size-25 md-form-label">Teléfono alternativo / Fax</label>
                          <div class="md-layout-item">
                            <md-field
                              :class="[
                                { 'md-form-group': true },
                                { 'md-error': form.errors.has('fax') }
                              ]"
                            >
                              <md-input
                                v-model="form.fax"
                                name="fax"
                                type="text"
                              />
                              <span
                                v-if="form.errors.has('fax')"
                                class="md-error"
                              >{{ form.errors.get('fax') }}</span>
                            </md-field>
                          </div>
                        </div>
                      </md-tab>


                      <md-tab
                        id="tab-company"
                        md-label="Datos laborales"
                        md-icon="work"
                      >
                        <div class="md-layout">
                          <label class="md-layout-item md-size-25 md-form-label">Compañía</label>
                          <div class="md-layout-item">
                            <md-field
                              :class="[
                                { 'md-form-group': true },
                                { 'md-error': form.errors.has('company_id') }
                              ]"
                            >
                              <md-select
                                v-model="form.company_id"
                                name="company_id"
                              >
                                <md-option value="">Compañía</md-option>
                                <md-option v-for="item in allCompanies" :key="item.id" :value="item.id">{{ item.name }}</md-option>
                              </md-select>
                              <span
                                v-if="form.errors.has('company_id')"
                                class="md-error"
                              >{{ form.errors.get('company_id') }}</span>
                            </md-field>
                          </div>
                        </div>

                        <div class="md-layout">
                          <label class="md-layout-item md-size-25 md-form-label">Posición / Cargo</label>
                          <div class="md-layout-item">
                            <md-field
                              :class="[
                                { 'md-form-group': true },
                                { 'md-error': form.errors.has('position') }
                              ]"
                            >
                              <md-input
                                v-model="form.position"
                                name="position"
                                type="text"
                              />
                              <span
                                v-if="form.errors.has('position')"
                                class="md-error"
                              >{{ form.errors.get('position') }}</span>
                            </md-field>
                          </div>
                        </div>
                      </md-tab>
            
                      <md-tab
                        id="tab-subscription-lists"
                        md-label="Listas de Susbscripción"
                        md-icon="favorite"
                      >
                        <md-switch v-for="item in allSubscriptionLists" :name="'subscriptionLists.' + item.id" :checked="hasSubscriptionList(item.id)" :key="item.id" :value="item.id" v-model="assignedSubscriptionLists">{{ item.name }}</md-switch>
                      </md-tab>
                    </md-tabs>
                  </template>
                </nav-tabs-card>
                <md-button @click="$router.go(-1)" class="md-raised">Volver</md-button>
                <md-button type="submit" class="md-raised md-success">Guardar cambios</md-button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Form from "@/utilities/Form"
import { companiesComputed, contactsComputed } from "@/store/helpers"
import { subscriptionListsComputed } from "@irm/store/helpers"
import { alertErrorMessage, alertSuccessMessage, strLimit } from "@/utilities/helpers"

export default {
    bodyClass: "profile-page",

    data() {
        return {
            assignedSubscriptionLists: [],
            form: new Form(this.$store.state.contacts.one),
            submitted: false,
        }
    },

    props: {
        header: {
            type: String,
            default: require("@irm/assets/img/city-profile.jpg")
        },
        img: {
            type: String,
            default: require("@irm/assets/img/faces/christian.jpg")
        }
    },

    computed: {
        ...companiesComputed,
        ...subscriptionListsComputed,
        ...contactsComputed,

        headerStyle() {
            return {
                backgroundImage: `url(${this.header})`
            }
        },

        validated() {
            return this.form.errors.any()
        }
    },

    watch: {
        "$route" (value) {
            if (value.name === "ContactsEdit" && this.prepared) {
                this.prepare()
            }
        }
    },

    created() {
        return this.prepare().then(this.prepared = true)
    },

    methods: {
        hasSubscriptionList(id) {
            return this.oneContact.subscription_lists.filter(item => item.id === id).length > 0
        },

        prepare() {
            var oneContact = this.$store.dispatch("contacts/fetchOneContact", this.$route.params.id)
            var companies = this.$store.dispatch("companies/fetchAllCompanies")
            var subscriptionLists = this.$store.dispatch("subscriptionLists/fetchAllSubscriptionLists")

            oneContact.then(value => {
                if (value) {
                    this.form = new Form(value)
                    this.assignedSubscriptionLists = value.subscription_lists.map(item => item.id)
                }
            })

            return Promise.all([oneContact, companies, subscriptionLists])
        },

        strLimit,

        submitForm() {
            this.submitted = true

            this.form.subscription_lists = []
            this.assignedSubscriptionLists.forEach(item => this.form.subscription_lists.push({ id: item }))

            this.form.put("/api/contacts/" + this.$route.params.id)
                .then(response => {
                    let id = response.data[0].id
                    alertSuccessMessage("El registro nº " + id + " fue guardado correctamente.")

                    return this.submitted = false
                }).catch(error => {
                    if (error.status > 422) {
                        alertErrorMessage("Ocurrió un error con el siguiente mensaje: " + error.data.message)
                    }

                    return this.submitted = false
                })
        },

        updateSlug(value) {
            return this.form.slug = slugify(value)
        }
    }
}
</script>
