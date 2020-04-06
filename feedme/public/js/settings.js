document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("[name='banner']").addEventListener("change", function() {
        readURL(this, document.querySelector(".bannerForm img"));
    });

    document.querySelector("[name='logo']").addEventListener("change", function() {
        readURL(this, document.querySelector(".logoForm img"));
    });
});

function readURL(input, DOM_preview_element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            DOM_preview_element.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}