export default function ({ store, redirect }) {
    // If the user is not authenticated
    if (!store.getters['users/memberUser'].authenticated) {
      return redirect('/login')
    }
  }
  