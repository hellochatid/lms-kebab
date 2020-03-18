export default function ({ store, redirect }) {
  // If the user is not authenticated
  if (!store.getters['users/adminUser'].authenticated) {
    return redirect('/admin/login')
  }
}
