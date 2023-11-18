document.addEventListener("livewire:load", function () {
    Livewire.on("show-toast", function (data) {
        Toastify({
            text: data.message,
            duration: 3000,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            className: "info",
        }).showToast();
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let toastMessage = "{{ Session::get('toast') }}";

    if (toastMessage) {
        Toastify({
            text: toastMessage,
            duration: 3000,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            className: "info",
        }).showToast();
    }
});

var loadFile = function (event) {
    var featured_image = document.getElementById("image-preview");
    featured_image.src = URL.createObjectURL(event.target.files[0]);
};
