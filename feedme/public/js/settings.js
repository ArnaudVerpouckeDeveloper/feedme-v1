document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("[name='banner']").addEventListener("change", function() {
        readURL(this, document.querySelector(".bannerForm img"));
    });

    document.querySelector("[name='logo']").addEventListener("change", function() {
        readURL(this, document.querySelector(".logoForm img"));
    });
});