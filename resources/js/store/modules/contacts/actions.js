import * as types from "../../mutation-types"
import { map } from "lodash"
import { groupByCount } from "@/utilities/helpers"

export default {
    deleteOneContact ({ commit }, id) {
        return window.axios.delete("/api/contacts/" + id)
            .then(response => {
                const r = response.data.data
                commit(types.CONTACTS_DELETE_ONE, r)
                return r
            })
            .catch(error => {
                commit(types.CONTACTS_ERROR, error)
                return error
            })
    },

    fetchAllContacts ({ commit, state }, params) {
        commit(types.CONTACTS_FETCH_ALL_PENDING, true)

        return window.axios.get("/api/contacts", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.CONTACTS_FETCH_ALL, all)
                commit(types.CONTACTS_COUNT_ALL, groupByCount(all, "name"))
                window.addresses = all.map(item => item.address)
                commit(types.CONTACTS_COUNT_BY_CITY, groupByCount(addresses, "locality"))
                commit(types.CONTACTS_COUNT_BY_COUNTRY, groupByCount(addresses, "country"))
                commit(types.CONTACTS_COUNT_BY_STATE, groupByCount(addresses, "state"))
                commit(types.CONTACTS_FETCH_ALL_PENDING, false)

                return all
            })
            .catch(error => {
                commit(types.CONTACTS_ERROR, error)
                commit(types.CONTACTS_FETCH_ALL_PENDING, false)
                return error
            })
    },

    fetchOneContact ({ commit }, id) {
        commit(types.CONTACTS_FETCH_ONE_PENDING, true)
        return window.axios.get("/api/contacts/" + id)
            .then(response => {
                const one = response.data
                commit(types.CONTACTS_FETCH_ONE, one)
                commit(types.CONTACTS_FETCH_ONE_PENDING, false)
                return one
            })
            .catch(error => {
                commit(types.CONTACTS_ERROR, error)
                commit(types.CONTACTS_FETCH_ONE_PENDING, false)
                return error
            })
    },

    reset ({ commit }) {
        commit(types.CONTACTS_RESET)
        return null
    }
}
