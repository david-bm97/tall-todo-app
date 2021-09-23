import Toastify from "toastify-js";

window.addEventListener("show-toast", (event) => {
	Toastify({
		text: event.detail.text,
		duration: 3000,
		position: "right",
		gravity: "bottom",
	}).showToast();
});
