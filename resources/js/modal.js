function showModal(id) {
	window.location.hash = `#${id}`;
}
function hideModal(id) {
	window.location.hash = "";
}

window.addEventListener("show-modal", (event) => {
	showModal(event.detail.modal_id);
});
window.addEventListener("hide-modal", (event) => {
	hideModal(event.detail.modal_id);
});

window.showModal = showModal;
window.hideModal = hideModal;
