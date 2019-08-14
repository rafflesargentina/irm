<style lang="scss">
h1 {
  margin-top: 50px;
  margin-bottom: 50px;
}

.avatar {
  width: 150px;
  border: 4px solid #fff;
  height: 150px;
  position: absolute;
  margin-top: -75px;
  margin-left: calc(50% - 75px);
}

.content {
  padding: 60px;
}

.map {
  width: 100%;
  height: 300px;
  background-color: #ccc;

  span {
    top: 50%;
    color: #fafafa;
    float: left;
    width: 100%;
    position: relative;
    text-align: center;
  }
}
</style>

<template>
  <form
    :action="action"
    :class="[validated ? 'needs-validation' : 'needs-validation']"
    :method="method"
    aria-label="Editar Contacto"
    novalidate
    @keydown="form.errors.clear($event.target.name)"
    @submit.prevent="submitForm"
  >
    <div class="container">
      <div class="card">
        <div class="card-header bg-white p-2 p-md-4">
          <h5 class="text-primary m-0">
            Identificación
          </h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="form-group row mb-0">
              <label
                for="first_name"
                class="col-6 col-form-label text-muted"
              >
                Nombre *
              </label>
              <div class="col-6 col-lg-4">
                <input
                  v-model="form.first_name"
                  :class="{ 'is-invalid': form.errors.has('first_name') }"
                  class="form-control"
                  name="first_name"
                  placeholder="Nombre"
                  type="text"
                  required
                >
                <span
                  v-if="form.errors.has('first_name')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('first_name')" />
                </span>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group row mb-0">
              <label
                for="last_name"
                class="col-6 col-form-label text-muted"
              >
                Apellido
              </label>
              <div class="col-6 col-lg-4">
                <input
                  v-model="form.last_name"
                  :class="{ 'is-invalid': form.errors.has('last_name') }"
                  class="form-control"
                  name="last_name"
                  placeholder="Apellido"
                  type="text"
                >
                <span
                  v-if="form.errors.has('last_name')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('last_name')" />
                </span>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group row mb-0">
              <label
                for="email"
                class="col-6 col-form-label text-muted"
              >
                Email *
              </label>
              <div class="col-6 col-lg-4">
                <input
                  v-model="form.email"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                  class="form-control"
                  name="email"
                  placeholder="Email"
                  type="email"
                  @keyup="form.slug = updateSlug($event.target.value)"
                >
                <span
                  v-if="form.errors.has('email')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('email')" />
                </span>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group row mb-0">
              <label
                for="slug"
                class="col-6 col-form-label text-muted"
              >
                Identificador url *
              </label>
              <div class="col-6 col-lg-4">
                <input
                  v-model="form.slug"
                  v-slugify
                  :class="{ 'is-invalid': form.errors.has('slug') }"
                  class="form-control"
                  name="slug"
                  placeholder="Identificador url"
                  type="text"
                >
                <span
                  v-if="form.errors.has('slug')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('slug')" />
                </span>
              </div>
            </div>
          </li>
        </ul>
        <div class="card-header bg-white p-2 p-md-4">
          <h5 class="text-primary m-0">
            Ubicación
          </h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="form-group row mb-3">
              <label class="col-6 col-form-label text-muted">
                Dirección *
              </label>
              <div class="col-6 col-lg-4">
                <input
                  id="autocomplete"
                  class="form-control"
                  placeholder="Dirección"
                  required
                  type="text"
                  @input="geolocate"
                >
                <span
                  v-if="form.errors.has('autocomplete')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('autocomplete')" />
                </span>
                <input
                  v-model="form.address.street_name"
                  type="hidden"
                  name="street_name"
                >
                <input
                  v-model="form.address.street_number"
                  type="hidden"
                  name="street_number"
                >
                <input
                  v-model="form.address.zip"
                  type="hidden"
                  name="zip"
                >
                <input
                  v-model="form.address.locality"
                  type="hidden"
                  name="locality"
                >
                <input
                  v-model="form.address.sublocality"
                  type="hidden"
                  name="sublocality"
                >
                <input
                  v-model="form.address.state"
                  type="hidden"
                  name="state"
                >
                <input
                  v-model="form.address.country"
                  type="hidden"
                  name="country"
                >
              </div>
            </div>
            <div
              id="map"
              class="map"
            />
            <div
              id="infowindow-content"
              class="infowindow-content"
            >
              <img
                id="place-icon"
                src=""
                width="16"
                height="16"
              >
              <span
                id="place-name"
                class="title"
              /><br>
              <span id="place-address" />
            </div>
          </li>
        </ul>
        <div class="card-header bg-white p-2 p-md-4">
          <h5 class="text-primary m-0">
            Contacto
          </h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="form-group row mb-3">
              <label class="col-6 col-form-label text-muted">
                Móvil
              </label>
              <div class="col-6 col-lg-4">
                <input
                  v-model="form.movil"
                  :class="{ 'is-invalid': form.errors.has('movil') }"
                  class="form-control"
                  placeholder="Móvil"
                  type="text"
                >
                <span
                  v-if="form.errors.has('movil')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('movil')" />
                </span>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group row mb-3">
              <label class="col-6 col-form-label text-muted">
                Fijo
              </label>
              <div class="col-6 col-lg-4">
                <input
                  v-model="form.phone"
                  :class="{ 'is-invalid': form.errors.has('phone') }"
                  class="form-control"
                  placeholder="Fijo"
                  type="text"
                >
                <span
                  v-if="form.errors.has('phone')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('phone')" />
                </span>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group row mb-3">
              <label class="col-6 col-form-label text-muted">
                Alternativo
              </label>
              <div class="col-6 col-lg-4">
                <input
                  v-model="form.fax"
                  :class="{ 'is-invalid': form.errors.has('fax') }"
                  class="form-control"
                  placeholder="Alternativo"
                  type="text"
                >
                <span
                  v-if="form.errors.has('fax')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('fax')" />
                </span>
              </div>
            </div>
          </li>
        </ul>
        <div class="card-header bg-white p-2 p-md-4">
          <h5 class="text-primary m-0">
            Empresa
          </h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="form-group row mb-0">
              <label
                for="company_id"
                class="col-6 col-form-label text-muted"
              >
                Compañía
              </label>
              <div class="col-6 col-lg-4">
                <select
                  v-model="form.company_id"
                  :class="{ 'is-invalid': form.errors.has('company_id') }"
                  class="form-control"
                  name="company_id"
                >
                  <option value="0">
                    Compañía
                  </option>
                  <option
                    v-for="item in allCompanies"
                    :key="item.id"
                    :value="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
                <span
                  v-if="form.errors.has('company_id')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('company_id')" />
                </span>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group row mb-0">
              <label
                for="position"
                class="col-6 col-form-label text-muted"
              >
                Posición
              </label>
              <div class="col-6 col-lg-4">
                <input
                  v-model="form.position"
                  :class="{ 'is-invalid': form.errors.has('position') }"
                  class="form-control"
                  name="position"
                  placeholder="Posición"
                  type="text"
                  required
                >
                <span
                  v-if="form.errors.has('position')"
                  class="invalid-feedback"
                  role="alert"
                >
                  <strong v-text="form.errors.get('position')" />
                </span>
              </div>
            </div>
          </li>
        </ul>
        <div class="card-header bg-white p-2 p-md-4">
          <h5 class="text-primary m-0">
            Listas de Subscripción
          </h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="form-group row mb-0">
              <label
                for="subscription_lists"
                class="col-6 col-form-label text-muted"
              >
                Listas de Subscripción
              </label>
              <div class="col-6 col-lg-4">
                <div
                  v-for="item in allSubscriptionLists"
                  :key="item.id"
                  class="form-check"
                >
                  <input
                    :id="'subscription-list-' + item.id"
                    v-model="assignedSubscriptionLists"
                    :value="item.id"
                    type="checkbox"
                    class="form-check-input"
                  >
                  <label
                    class="form-check-label"
                    :for="'subscription-list-' + item.id"
                  >{{ item.name }}</label>
                </div>
              </div>
            </div>
          </li>
        </ul>

        <div class="card-footer bg-white text-right">
          <button
            type="submit"
            class="btn btn-primary"
          >
            Guardar cambios
          </button>
        </div>
      </div>

      <div class="row p-3 text-center">
        <div class="col">
          <p class="text-muted">
            Última actualización: {{ oneContact.updated_at }}
          </p>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import { alertErrorMessage, alertSuccessMessage, slugify } from "@/utilities/helpers"
import { companiesComputed, contactsComputed } from "@/store/helpers"
import { pick } from "lodash"
import { subscriptionListsComputed } from "@irm/store/helpers"
import { gmaps } from "@/utilities/mixins/gmaps"

import Form from "@/utilities/Form"

export default {
    mixins: [gmaps],

    props: {
        action: {
            type: String,
            required: true
        },

        method: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            assignedSubscriptionLists: [],
            form: new Form(),
            location: "",
            nullMessage: "No especifica",
            prepared: false,
            submitted: false,
        }
    },

    computed: {
        ...companiesComputed,
        ...contactsComputed,
        ...subscriptionListsComputed,

        validated() {
            return this.form.errors.any()
        }
    },

    created() {
        this.prepare()

        this.$store.watch(state => state.contacts.one, (value)=> {
            this.prepare()
        })
    },

    mounted: function() {
        this.initAutocomplete()
    },

    methods: {
        prepare() {
            this.isDestroying = false
            this.submitted = false

            this.form = new Form(this.oneContact)
            this.assignedSubscriptionLists = this.oneContact.subscription_lists.map(item => item.id)
            this.setLocation()
        },

        setLocation() {
            if (this.oneContact.address) {
                window.$(() => {
                    var input = document.getElementById("autocomplete")
                    return input.value = this.oneContact.address.location
                })
            }

            return
        },

        setMap() {
            if (this.gmapApi) {
                var maps = this.gmapApi.maps
                this.$refs.map.$mapPromise.then(function(map) {

                    this.bounds = new maps.LatLngBounds()
                    //this.bounds.extend(this.center)

                    map.fitBounds(this.bounds)
                    map.panToBounds(this.bounds)

                    return maps.event.trigger(map, "resize")
                })
                    .catch(map => {
                        console.error(map)
                    })
            }
        },

        submitForm() {
            this.submitted = true

            this.assignedSubscriptionLists.forEach(item => this.form.subscription_lists.push({ id: item }))

            this.form[this.method](this.action)
                .then(response => {
                    let id = response.data[0].id
                    alertSuccessMessage("El registro nº " + id + " fue guardado correctamente.")
                    this.$router.push({ name: "ContactsShow", params: { id: id }})

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
