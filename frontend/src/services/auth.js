const Cookie = process.client ? require("js-cookie") : undefined;

const auth = {
	admin: function () {
		const authAdmin = Cookie.get("authAdmin");
		return JSON.parse(authAdmin);
	}
}

export default auth;
