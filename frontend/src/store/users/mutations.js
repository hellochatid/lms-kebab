export default {
    add(state, { text }) {
        state.list.push({
            text,
            done: false
        })
    },
    setUserAdmin(state, { name, authenticated }) {
        state.userAdmin.name = name
        state.userAdmin.authenticated = authenticated
    }
}
