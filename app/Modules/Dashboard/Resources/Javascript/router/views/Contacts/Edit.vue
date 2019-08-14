<template>
  <div>
    <h4 class="mb-3 text-center">
      Editar Contacto: {{ strLimit(oneContact.name) }}
    </h4>

    <ContactForm
      :action="'/api/contacts/' + $route.params.id"
      :method="'put'"
    />
  </div>
</template>

<script>
import { contactsComputed } from "@/store/helpers"
import { strLimit } from "@/utilities/helpers"

export default {
    data() {
        return {
            prepared: false,
        }
    },

    computed: {
        ...contactsComputed,
    },

    watch: {
        "$route" (value) {
            if (value.name === "AdminContactsEdit" && this.prepared) {
                this.prepare()
            }
        }
    },

    created() {
        return this.prepare().then(this.prepared = true)
    },

    methods: {
        prepare() {
            var one = this.$store.dispatch("contacts/fetchOneContact", this.$route.params.id)
            var subscriptionLists = this.$store.dispatch("subscriptionLists/fetchAllSubscriptionLists")

            return Promise.all([one, subscriptionLists])
        },

        strLimit,
    },
}
</script>
