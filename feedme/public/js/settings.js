document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("[name='banner']").addEventListener("change", function() {
        readURL(this, document.querySelector(".bannerForm img"));
    });

    document.querySelector("[name='logo']").addEventListener("change", function() {
        readURL(this, document.querySelector(".logoForm img"));
    });

    document.querySelector("#receiveEmailsForNewOrdersForm input[type='checkbox']").addEventListener("click", function(e) {
        makeRequest("PUT", "/admin/settings/toggleReceiveEmailsForNewOrders", {
                receiveEmailsForNewOrders: e.target.checked
            })
            .then(res => {
                if (res !== "ok") throw (res);
            })
            .catch(error => {
                console.log("error: ", error);
                e.target.checked = !e.target.checked;
                promptError();
            });
    });

    document.querySelector("#hideMerchantFromSpeedmealForm input[type='checkbox']").addEventListener("click", function(e) {
        makeRequest("PUT", "/admin/settings/toggleHideMerchantFromSpeedmeal", {
                receiveEmailsForNewOrders: !e.target.checked
            })
            .then(res => {
                if (res !== "ok") throw (res);
            })
            .catch(error => {
                console.log("error: ", error);
                e.target.checked = !e.target.checked;
                promptError();
            });
    });
});