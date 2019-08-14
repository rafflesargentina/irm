<template>
  <div>
    <div class="container">
      <gmap-map
        v-if="hasMap"
        ref="companyMap"
        :center="{ lat: map.latitude, lng: map.longitude }"
        :zoom="zoom"
      >
        <gmap-marker
          v-for="(m, index) in markers"
          :key="index"
          :position="m.position"
          @click="center=m.position"
        />
      </gmap-map>
      <div
        v-if="!hasMap"
        class="map-placeholder"
      >
        <span>No hay un mapa para mostrar :(</span>
      </div>
      <div class="row no-gutters justify-content-center">
        <div class="col">
          <img
            :src="this.company.cover"
            class="avatar rounded-circle"
          >
        </div>
      </div>
      <div class="content bg-white">
        <h1 class="text-center">
          <span class="text-primary">{{ company.name }}</span><br>
          <small>{{ company.category_name }}</small>
        </h1>
        <hr>
        <div class="row lead align-items-start">
          <div class="col text-muted">
            <p><span class="octicon octicon-location" /> Ubicación</p>
          </div>
          <div class="col">
            <ul class="list-unstyled">
              <li>{{ company.address }}</li>
              <li>{{ company.city }}</li>
              <li>{{ company.state }}</li>
              <li>{{ company.country }}</li>
            </ul>
          </div>
        </div>
        <hr>
        <div class="row lead align-items-start">
          <div class="col text-muted">
            <p><span class="octicon octicon-device-mobile" /> Teléfonos</p>
          </div>
          <div class="col">
            <ul class="list-unstyled">
              <li>{{ company.mobile }}</li>
              <li>{{ company.phone }}</li>
            </ul>
          </div>
        </div>
        <hr>
        <div class="row lead align-items-start">
          <div class="col text-muted">
            <p><span class="octicon octicon-mail" /> Email</p>
          </div>
          <div class="col">
            <p>{{ company.email }}</p>
          </div>
        </div>
      </div>

      <div class="row p-3 text-center">
        <div class="col">
          <p class="text-muted">
            Última actualización: {{ company.updated_at }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import * as VueGoogleMaps from "vue2-google-maps"

export default {
    data: function() {
        return {
            map: {},
            company: {},
            markers: []
        }
    },

    computed: {
        zoom: function() {
            return this.map.zoom
        },

        google: VueGoogleMaps.gmapApi,

        hasMap: function() {
            return _.size(this.map) > 0
        }
    },

    watch: {
        "$route" (to, from) {
            this.getCompany()
            this.centerMap()
        }
    },

    created: function() {
        this.getCompany()
    },

    mounted: function() {
        return this.centerMap()
    },

    methods: {
        addMarker: function(marker) {
            return this.markers.push(marker)
        },

        centerMap: function() {
            if (this.hasMap) {
                this.$refs.companyMap.$mapPromise.then(map =>  {

                    this.bounds = new google.maps.LatLngBounds()
                    _.forEach(this.markers, marker => {
                        this.bounds.extend(marker.position)
                    })

                    //map.fitBounds(this.bounds);
                    map.panToBounds(this.bounds)

                    google.maps.event.trigger(map, "resize")
                })
            }
        },

        getCompany: function() {
            return axios.get("/companies/" + this.$route.params.id).then(response => {
                this.company = response.data
                this.map = this.company.map
                delete this.company["map"]

                if (this.hasMap) {
                    var marker = {
                        position: {
                            lat: this.map.latitude, lng: this.map.longitude
                        }
                    }

                    this.addMarker(marker)
                }
            })
        }
    }
}
</script>

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

.map-placeholder {
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

.vue-map-container {
  height: 300px;
}
</style>
