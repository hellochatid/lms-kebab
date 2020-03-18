const authUser = {
    token: '',
    authenticated: false
}

export default () => ({
    list: [],
    adminUser: Object.assign({}, authUser),
    memberUser: Object.assign({}, authUser),
    affiliateUser: Object.assign({}, authUser)
})
