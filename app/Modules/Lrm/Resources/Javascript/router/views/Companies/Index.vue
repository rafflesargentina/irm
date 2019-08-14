<template>
  <div>
    <div class="jumbotron jumbotron-fluid bg-dark">
      <div class="container text-center text-white">
        <h1 class="display-4 mb-3">
          Compañías
        </h1>
        <p class="lead">
          Búsqueda por nombre, empresa, o ubicación (país, estado o ciudad)
        </p>
        <hr>
        <div class="row justify-content-center">
          <div class="col-md-7">
            <label
              class="sr-only"
              for="keywords"
            >Palabras clave</label>
            <div class="input-group mb-3">
              <span class="input-group-prepend">
                <div class="input-group-text bg-white"><i class="octicon octicon-search" /></div>
              </span>
              <input
                v-model="keywords"
                type="text"
                name="keywords"
                class="form-control form-control-lg border-left-0 border"
                placeholder="Palabras clave..."
                @keyup="filterByKeywords"
              >
              <div class="input-group-append">
                <button
                  type="button"
                  class="btn btn-light"
                >
                  Categoría <span class="octicon octicon-chevron-down" />
                </button>
                <button
                  type="button"
                  class="btn btn-light"
                >
                  Ubicación <span class="octicon octicon-chevron-down" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="card bg-primary text-white mb-3">
        <div class="card-header">
          Mostrando {{ from }}-{{ to }} de {{ total }} resultados.
        </div>
      </div>
      <div
        v-for="chunk in chunks"
        class="row"
      >
        <div
          v-for="card in chunk"
          class="col-sm-6 col-md-3 mb-3"
        >
          <div class="card">
            <div class="embed-responsive embed-responsive-16by9">
              <img
                class="embed-responsive-item card-img-top"
                :src="card.cover"
              >
            </div>
            <div class="card-body">
              <h4 class="card-title">
                <router-link
                  class="text-primary"
                  :to="'/company/' + card.id"
                >
                  {{ card.name }}
                </router-link><br><small>{{ card.category_name }}</small>
              </h4>
              <div class="card-text">
                <p class="text-muted">
                  <span class="octicon octicon-location" /> {{ card.city }} - {{ card.country }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <pagination :per-page="12" />
    </div>
  </div>
</template>

<script>
import store from "@/store"

var state = store.state

export default {

    components: {
        Pagination
    },
    data: function() {
        return {
            state,

            card: {},
            keywords: "",
        }
    },

    computed: {
        to: function() {
            return this.state.pagination.to
        },

        from: function() {
            return this.state.pagination.from
        },

        items: function() {
            return this.state.pagination.items
        },

        total: function() {
            return this.state.pagination.total
        },

        chunks: function() {
            return _.chunk(this.items, 4)
        },

        filteredItems: function() {
            return this.state.pagination.filteredItems
        },

        originalItems: function() {
            return this.state.pagination.originalItems
        }
    },

    created: function() {
        this.getCompanies()
    },

    methods: {
        getCompanies: function() {
            return axios.get("/companies").then(response => {
                this.state.pagination = new Paginator(response.data, 12)
            })
        },

        filterByKeywords: function() {
            var query
            var filtered = _.filter(this.originalItems, item => {
                query = item.name + " " + item.country + " " + item.state + " " + item.city
                return query.toLowerCase().indexOf(this.keywords.toLowerCase()) > -1
            })

            this.state.pagination.filteredItems = filtered
            this.state.pagination.setCurrentPage()
        }
    }
}
</script>
