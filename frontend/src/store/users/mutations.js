export default {
    add(state, { text }) {
        state.list.push({
            text,
            done: false
        })
    },
    setUserAdmin(state, { name, authenticated }) {
        console.log('text', name)
        state.userAdmin.name = name
        state.userAdmin.authenticated = authenticated
    }
}
