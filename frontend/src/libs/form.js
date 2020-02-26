const form = {
	validation: function (formRrules) {
		var validateForm = true;
		Object.entries(formRrules).forEach(([formInput, value]) => {
			var input = document.getElementById(formInput);
			var inputLabel =
				input.parentNode.previousElementSibling !== null
					? input.parentNode.previousElementSibling.innerText
					: "";
			var inputRules = value.split("|");
			inputRules.forEach(v => {
				var arrRules = v.split("|");
				arrRules.forEach(rules => {
					var rule = rules.split(":");
					var ruleName = rule[0];
					var ruleValue = typeof rule[1] !== "undefined" ? rule[1] : null;
					var errorInfo =
						document.getElementById("description-" + formInput) !== null
							? document.getElementById("description-" + formInput)
							: document.createElement("small");
					errorInfo.setAttribute("id", "description-" + formInput);
					errorInfo.classList.add("text-danger");

					// Required
					if (ruleName === "required") {
						if (input.value === "") {
							errorInfo.innerText = inputLabel + " required";
							input.classList.add("form-error");
							input.parentNode.insertBefore(errorInfo, input.nextSibling);
							validateForm = false;
							return false;
						}
						input.classList.remove("form-error");
						errorInfo.remove();
					}
				});
			});
		});
		return validateForm;
	},
	alert(store, text, dismissCountDown, variant) {
		var alert = {
			text: text,
			dismissCountDown: dismissCountDown,
			variant: variant
		};
		store.commit("form/setAlert", alert);
	}
}

export default form;
