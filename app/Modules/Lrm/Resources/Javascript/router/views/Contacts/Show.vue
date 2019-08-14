<style lang="scss" scoped>
  .md-list {
    display: inline-block;
    vertical-align: top;
  }

.section {
  padding: 0;
}

.profile-tabs /deep/ {
  .md-card-tabs .md-list {
    justify-content: center;
  }

  [class*="tab-pane-"] {
    margin-top: 3.213rem;
    padding-bottom: 50px;

    img {
      margin-bottom: 2.142rem;
    }
  }
}
</style>

<template>
  <div class="wrapper">
    <parallax
      class="section page-header header-filter"
      :style="headerStyle"
    />
    <div class="main main-raised">
      <div class="section profile-content">
        <div class="container">
          <div class="md-layout">
            <div class="md-layout-item md-size-50 mx-auto">
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
                  <h6>{{ oneContact.company ? oneContact.company.name : '' }}</h6>
                  <RouterLink
                    :to="{ name: 'ContactsEdit', params: { id: oneContact.id }}"
                    class="md-button md-simple"
                  >
                    Editar
                  </RouterLink>
                </div>
              </div>
            </div>
          </div>
          <!--<div class="description text-center">
            <p>
              An artist of considerable range, Chet Faker — the name taken by
              Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs
              and records all of his own music, giving it a warm, intimate feel
              with a solid groove structure.
            </p>
          </div>-->
          <div class="profile-tabs">
            <tabs
              :tab-name="['Datos personales', 'Datos laborales', 'Listas de Subscripción']"
              :tab-icon="['face', 'work', 'favorite']"
              plain
              nav-pills-icons
              color-button="info"
            >
              <!-- here you can add your content for tab-content -->
              <template slot="tab-pane-1">
                <div class="md-layout">
                  <div class="md-layout-item md-size-33">
                    <md-list class="md-double-line">
                      <md-subheader>Identidad</md-subheader>

                      <md-list-item>
                        <md-icon class="md-primary">
                          person
                        </md-icon>

                        <div class="md-list-item-text">
                          <span>{{ oneContact.first_name }}</span>
                          <span>Nombre</span>
                        </div>
                      </md-list-item>

                      <md-list-item class="md-inset">
                        <div class="md-list-item-text">
                          <span>{{ oneContact.last_name || nullMessage }}</span>
                          <span>Apellido</span>
                        </div>
                      </md-list-item>

                      <md-divider />

                      <md-subheader>Email</md-subheader>

                      <md-list-item>
                        <md-icon class="md-primary">
                          email
                        </md-icon>

                        <div class="md-list-item-text">
                          <span>{{ oneContact.email }}</span>
                          <span>Personal</span>
                        </div>
                      </md-list-item>
                    </md-list>
                  </div>

                  <div class="md-layout-item md-size-33">
                    <md-list class="md-double-line">
                      <md-subheader>Teléfonos</md-subheader>

                      <md-list-item>
                        <md-icon class="md-primary">
                          phone
                        </md-icon>
            
                        <div class="md-list-item-text">
                          <span>{{ oneContact.phone || nullMessage }}</span>
                          <span>Línea</span>
                        </div>
                      </md-list-item>

                      <md-list-item class="md-inset">
                        <div class="md-list-item-text">
                          <span>{{ oneContact.mobile || nullMessage }}</span>
                          <span>Móvil</span>
                        </div>
                      </md-list-item>

                      <md-list-item class="md-inset">
                        <div class="md-list-item-text">
                          <span>{{ oneContact.fax || nullMessage }}</span>
                          <span>Fax / Alternativo</span>
                        </div>
                      </md-list-item>

                      <md-divider />

                      <md-subheader>Sitio web</md-subheader>

                      <md-list-item>
                        <md-icon class="md-primary">
                          public
                        </md-icon>

                        <div class="md-list-item-text">
                          <span>{{ oneContact.website || nullMessage }}</span>
                          <span>Personal</span>
                        </div>
                      </md-list-item>
                    </md-list>
                  </div>

                  <div class="md-layout-item md-size-33">
                    <md-list class="md-double-line">
                      <md-subheader>Dirección</md-subheader>

                      <md-list-item>
                        <md-icon class="md-primary">
                          place
                        </md-icon>

                        <div class="md-list-item-text">
                          <span>{{ oneContact.address.street_name }} {{ oneContact.address.street__number }}</span>
                          <span>Dirección</span>
                        </div>
                      </md-list-item>

                      <md-list-item class="md-inset">
                        <div class="md-list-item-text">
                          <span>{{ oneContact.address.locality || nullMessage }}</span>
                          <span>Ciudad</span>
                        </div>
                      </md-list-item>

                      <md-list-item class="md-inset">
                        <div class="md-list-item-text">
                          <span>{{ oneContact.address.sublocality || nullMessage }}</span>
                          <span>Barrio / Pueblo</span>
                        </div>
                      </md-list-item>

                      <md-list-item class="md-inset">
                        <div class="md-list-item-text">
                          <span>{{ oneContact.address.state || nullMessage }}</span>
                          <span>Provincia / Estado</span>
                        </div>
                      </md-list-item>

                      <md-list-item class="md-inset">
                        <div class="md-list-item-text">
                          <span>{{ oneContact.address.country || nullMessage }}</span>
                          <span>País</span>
                        </div>
                      </md-list-item>
                    </md-list>
                  </div>
                </div>
              </template>
              <template slot="tab-pane-2">
                <div class="md-layout">
                  <div class="md-layout-item md-size-33 mx-auto">
                    <md-list class="md-double-line">
                      <md-subheader>Compañía</md-subheader>
                      <md-list-item>
                        <md-icon class="md-primary">
                          business
                        </md-icon>

                        <div class="md-list-item-text">
                          <span>{{ oneContact.company ? oneContact.company.name : nullMessage }}</span>
                          <span>Nombre</span>
                        </div>
                      </md-list-item>

                      <md-list-item class="md-inset">
                        <div class="md-list-item-text">
                          <span>{{ oneContact.position }}</span>
                          <span>Posición / Cargo</span>
                        </div>
                      </md-list-item>
                    </md-list>
                  </div>
                </div>
              </template>
              <template slot="tab-pane-3">
                <div class="md-layout">
                  <div v-for="item in oneContact.subscription_lists" class="md-layout-item md-size-25 ml-auto">
                    <md-card class="md-primary" md-theme="green-card">
                      <md-card-header>
                        <md-card-header-text>
                          <div class="md-title">{{ item.name }}</div>
                        </md-card-header-text>
                      </md-card-header>
                    </md-card>
                  </div>
                </div>
              </template>
            </tabs>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { contactsComputed } from "@/store/helpers"

import { Tabs } from "@irm/components"

export default {
    components: {
        Tabs
    },

    bodyClass: "profile-page",

    data() {
        return {
            nullMessage: "No especifica",
            tabPane1: [
                { image: require("@irm/assets/img/examples/studio-1.jpg") },
                { image: require("@irm/assets/img/examples/studio-2.jpg") },
                { image: require("@irm/assets/img/examples/studio-4.jpg") },
                { image: require("@irm/assets/img/examples/studio-5.jpg") }
            ],
            tabPane2: [
                { image: require("@irm/assets/img/examples/olu-eletu.jpg") },
                { image: require("@irm/assets/img/examples/clem-onojeghuo.jpg") },
                { image: require("@irm/assets/img/examples/cynthia-del-rio.jpg") },
                { image: require("@irm/assets/img/examples/mariya-georgieva.jpg") },
                { image: require("@irm/assets/img/examples/clem-onojegaw.jpg") }
            ],
            tabPane3: [
                { image: require("@irm/assets/img/examples/mariya-georgieva.jpg") },
                { image: require("@irm/assets/img/examples/studio-3.jpg") },
                { image: require("@irm/assets/img/examples/clem-onojeghuo.jpg") },
                { image: require("@irm/assets/img/examples/olu-eletu.jpg") },
                { image: require("@irm/assets/img/examples/studio-1.jpg") }
            ]
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
        ...contactsComputed,

        headerStyle() {
            return {
                backgroundImage: `url(${this.header})`
            }
        }
    },

    watch: {
        "$route" (value) {
            if (value.name === "ContactsShow" && this.prepared) {
                this.prepare()
            }
        }
    },

    created() {
        return this.prepare()
    },

    methods: {
        hasSubscriptionList(id) {
            return this.oneContact.subscription_lists.filter(item => item.id === id).length > 0
        },

        prepare() {
            var one = this.$store.dispatch("contacts/fetchOneContact", this.$route.params.id)
            var subscriptionLists = this.$store.dispatch("subscriptionLists/fetchAllSubscriptionLists")

            return Promise.all([one, subscriptionLists])
        }
    }
}
</script>
