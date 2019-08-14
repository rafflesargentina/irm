<style lang="scss" scoped>
.md-card .md-card-header {
  padding: 0;
}

.section-gray {
  background-color: #e5e5e5;
}
</style>

<template>
  <div class="wrapper">
    <parallax
      class="section page-header header-filter"
      :style="headerStyle"
    >
      <div class="container">
        <div class="md-layout">
          <div
            class="md-layout-item md-size-50 md-small-size-70 md-xsmall-size-100"
          >
            <h1 class="title">
              Contactos {{ this.country ? ' de ' + this.country : '' }}
            </h1>
            <h4>
              Every landing page needs a small description after the big bold
              title, that's why we added this text here. Add here all the
              information that can make you or your product create the first
              impression.
            </h4>
            <br>
            <md-menu md-direction="bottom-start">
              <md-button md-lg md-menu-trigger>{{ country || 'País' }}</md-button>
              <md-menu-content>
                <md-menu-item @click="country = item,fetchAllContacts({ country: item, list: this.subscriptionList })" v-for="item in allCountries">{{ item }}</md-menu-item>
              </md-menu-content>
            </md-menu>
            <md-menu md-direction="bottom-start">
              <md-button md-lg md-menu-trigger>{{ subscriptionList || 'Lista de Subscripción' }}</md-button>
              <md-menu-content>
                <md-menu-item @click="subscriptionList = item.id,fetchAllContacts({ country: this.country, list: item.id })" v-for="item in allSubscriptionLists">{{ item.name }}</md-menu-item>
              </md-menu-content>
            </md-menu>
          </div>
        </div>
      </div>
    </parallax>
    <div class="main">
      <div class="section section-gray">
          <div class="container">
            <div
              v-for="chunk in chunks"
              class="md-layout"
            >
              <div
                v-for="item in chunk"
                class="md-layout-item md-size-33 md-mall-size-100"
              >
                <div class="md-layout">
                  <div class="md-layout-item md-medium-size-33 md-small-size-100">
                    <md-card class="md-card md-card-profile md-theme-default">
                      <div
                        class="md-card-header md-card-avatar"
                        shadow-normal="true"
                      >
                        <img
                          :src="teamImg1"
                          alt="Thumbnail Image"
                          class="img"
                        >
                      </div>
                      <div class="md-card-content">
                        <h6 class="card-category text-gray">
                          {{ item.position || 'Sin cargo definido' }}
                        </h6>
                        <h4 class="card-title">
                          {{ item.name }}
                        </h4>
                        <RouterLink
                          :to="{ name: 'ContactsShow', params: { id: item.id }}"
                          class="md-button md-info md-round md-theme-default"
                        >
                          <div class="md-ripple">
                            <div class="md-button-content">
                              Ver
                            </div>
                          </div>
                        </RouterLink>
                        <RouterLink
                          :to="{ name: 'ContactsEdit', params: { id: item.id }}"
                          class="md-button md-info md-round md-theme-default"
                        >
                          <div class="md-ripple">
                            <div class="md-button-content">
                              Editar
                            </div>
                          </div>
                        </RouterLink>
                      </div>
                    </md-card>
                  </div>
                </div>     
              </div>
            </div>
            <Pagination
              ref="pagination"
              :items="allContacts"
              @pagination-items-change="setChunks"
            />
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import { chunk } from "lodash"
import { contactsComputed, contactsMethods } from "@/store/helpers"
import { countriesComputed, subscriptionListsComputed } from "@irm/store/helpers"

export default {
    bodyClass: "landing-page",

    props: {
        header: {
            type: String,
            default: require("@irm/assets/img/bg7.jpg")
        },
        teamImg1: {
            type: String,
            default: require("@irm/assets/img/faces/avatar.jpg")
        },
        teamImg2: {
            type: String,
            default: require("@irm/assets/img/faces/christian.jpg")
        },
        teamImg3: {
            type: String,
            default: require("@irm/assets/img/faces/kendall.jpg")
        }
    },
    data() {
        return {
            chunks: [],
            country: "PARAGUAY",
            name: null,
            email: null,
            message: null,
            prepared: false,
            subscriptionList: "",
        }
    },

    computed: {
        ...contactsComputed, 
        ...countriesComputed,
        ...subscriptionListsComputed,

        from() {
            return this.$refs.pagination.from
        },

        headerStyle() {
            return {
                backgroundImage: `url(${this.header})`
            }
        },

        to() {
            return this.$refs.pagination.to
        },

        total() {
            return this.$refs.pagination.total
        }
    },

    created() {
        return this.prepare().then(this.prepared = true)
    },

    methods: {
        ...contactsMethods,

        prepare() {
            var contacts = this.$store.dispatch("contacts/fetchAllContacts", { country: this.country, list: this.subscriptionList })
            var subscriptionLists = this.$store.dispatch("subscriptionLists/fetchAllSubscriptionLists")

            return Promise.all([contacts, subscriptionLists])
        },

        setChunks(items) {
            return this.chunks = chunk(items, 3)
        },
    }
}
</script>
