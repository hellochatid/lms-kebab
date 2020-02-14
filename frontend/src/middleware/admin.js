export default function ({ store, redirect }) {
  // If the user is not authenticated
  if (!store.getters['users/userAdmin'].authenticated) {
    return redirect('/admin/login')
  }
}
