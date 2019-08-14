import * as types from "../../mutation-types"
import { initialState } from "./contacts"

export default {
    [types.CONTACTS_COUNT_ALL] (state, payload) {
        state.allCount = payload
    },

    [types.CONTACTS_COUNT_BY_CITY] (state, payload) {
        state.citiesCount = payload
    },

    [types.CONTACTS_COUNT_BY_COUNTRY] (state, payload) {
        state.countriesCount = payload
    },

    [types.CONTACTS_COUNT_BY_STATE] (state, payload) {
        state.statesCount = payload
    },

    [types.CONTACTS_DELETE_ONE] () {},

    [types.CONTACTS_ERROR] (state, payload) {
        state.error = JSON.stringify(payload)
    },

    [types.CONTACTS_FETCH_ALL] (state, payload) {
        state.all = payload
    },

    [types.CONTACTS_FETCH_ALL_PENDING] (state, payload) {
        state.allPending = payload
    },

    [types.CONTACTS_FETCH_ONE] (state, payload) {
        state.one = Object.freeze(payload)
    },

    [types.CONTACTS_FETCH_ONE_PENDING] (state, payload) {
        state.onePending = payload
    },

    [types.CONTACTS_RESET] (state) {
        Object.assign(state, { initialState: initialState(), ...initialState() })
    },
}
