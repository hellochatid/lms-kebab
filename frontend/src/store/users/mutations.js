export default {
    add(state, { text }) {
        state.list.push({
            text,
            done: false
        })
    },
    setUserAdmin(state, { name, displayPicture, token, authenticated }) {
        state.userAdmin.name = name
        state.userAdmin.displayPicture = displayPicture
        state.userAdmin.token = token
        state.userAdmin.authenticated = authenticated
    }
}
