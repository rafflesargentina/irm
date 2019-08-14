import { mapActions, mapState } from "vuex"

export const countriesComputed = {
    ...mapState(
        "countries", {
            allCountries: state => state.all,
        }
    ),
}

export const countriesMethods = {
    ...mapActions(
        "countries", [
            "fetchAllCountries",
        ]
    )
}

export const subscriptionListsComputed = {
    ...mapState(
        "subscriptionLists", {
            allSubscriptionLists: state => state.all,
            oneSubscriptionList: state => state.one
        }
    ),
}

export const subscriptionListsMethods = {
    ...mapActions(
        "subscriptionLists", [
            "deleteOneSubscriptionList",
            "fetchAllSubscriptionLists",
            "fetchOneSubscriptionList",
        ]
    )
}
