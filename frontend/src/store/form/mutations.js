export default {
	setAlert(state, { text, dismissCountDown, variant }) {
		state.alert.text = text
		state.alert.dismissCountDown = dismissCountDown
		state.alert.variant = variant
	}
}
