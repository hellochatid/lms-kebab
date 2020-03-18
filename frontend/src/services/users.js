import auth from '~/services/auth';

const users = {
    accessToken: function () {
        const authAdmin = auth.user('admin');
        return authAdmin.token
    },
    getUserById(nuxt, id) {

    }
}

export default users;
