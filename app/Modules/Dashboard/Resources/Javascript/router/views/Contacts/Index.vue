<template>
  <div>
    <h4 class="mb-3">
      Contactos
    </h4>

    <div class="card shadow">
      <div class="card-header bg-white">
        <div class="row">
          <div class="col-md-5">
            <quick-search
              ref="quickSearch"
              :items="allContacts"
            />
          </div>
          <div class="col-md-7">
            <form class="form-inline">
              <router-link
                class="btn btn-primary mr-2 text-white"
                :to="{ name: 'AdminContactsCreate' }"
              >
                <span class="fa fa-plus pr-2" />Nuevo Contacto
              </router-link>
              <button
                class="btn btn-primary text-white"
                type="button"
              >
                <span class="fa fa-upload pr-2" />Importar
              </button>
            </form>
          </div>
        </div>
      </div>
      <div v-if="$refs.quickSearch">
        <dynamic-table
          v-if="$refs.quickSearch.filteredItems.length > 0"
          :columns="columns"
          :items="$refs.quickSearch.filteredItems"
          :per-page="12"
          :sort-direction="'desc'"
          :sort-key="'updated_at'"
        >
          <th 
            slot="th" 
            class="th--acciones"
          >
            Acciones
          </th>
          <td 
            slot="td" 
            slot-scope="item"
          >
            <router-link 
              :to="{ name: 'AdminContactsEdit', params: { id: item.id } }" 
              class="mr-2"
            >
              <span class="fa fa-pencil pr-1" />Editar
            </router-link>
            <a 
              href="#" 
              @click="destroyRecord('/api/contacts/' + item.id, item.id)"
            >
              <span class="fa fa-trash pr-1" />Borrar
            </a>
          </td>
        </dynamic-table>

        <div v-if="$refs.quickSearch.filteredItems.length === 0">
          <div class="card-body">
            <p class="mb-0">
              No hay resultados para mostrar.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { alertDestroyRecordConfirmation } from "@/utilities/helpers"
import { contactsComputed, contactsMethods } from "@/store/helpers"

export default {
    data() {
        return {
            prepared: false,
            columns: {
                id: "Id.",
                name: "Nombre",
                email: "Email",
                position: "Posición",
            }
        }
    },

    computed: {
        ...contactsComputed,

        quickSearch() {
            if (this.$refs.quickSearch) {
                return this.$refs.quickSearch
            }
        }
    },

    watch: {
        "$route" (value) {
            if (value.name === "AdminContactsIndex" && this.prepared) {
                this.prepare()
            }
        }
    },

    created() {
        return this.prepare().then(this.prepared = true)
    },

    methods: {
        ...contactsMethods,

        destroyRecord(url, id) {
            return alertDestroyRecordConfirmation(url, id).then(value => {
                if (value) {
                    return this.fetchAllContacts()
                }
            })
        },

        prepare() {
            if (this.quickSearch) {
                this.quickSearch.search = ""
            }

            return this.$store.dispatch("contacts/fetchAllContacts")
        }
    }
}
</script>
