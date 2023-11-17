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
