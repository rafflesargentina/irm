import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"

export function initialState()
{
    return {
        all: [],
        allPending: true,
        one: {
            address: {},
            addresses: [],
            contact: {},
            contacts: [],
            description: "",
            industry: "",
            featured_address: {},
            featured_photo: {},
            name: "",
            photos: [],
            slug: "",
            unfeatured_addresses: [],
            unfeatured_photos: [],
            user_id: "",
            website: "",
        },
        onePending: true
    }
}

const state = {
    initialState: initialState(),
    ...initialState()
}

export default {
    actions,
    getters,
    mutations,
    state
}
