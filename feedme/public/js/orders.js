document.addEventListener("DOMContentLoaded", function() {
    let allOrderElements = document.querySelectorAll(".orders .order");
    for (let i = 0; i < allOrderElements.length; i++) {
        setEventListenersForOrder(allOrderElements[i]);
    }
});




function setEventListenersForOrder(order) {
    let orderId = order.dataset.orderid;
    if (order.classList.contains("confirmed") || order.classList.contains("denied")) {

    } else {
        order.querySelector(".orderSections .confirmOrder").addEventListener("click", async function(e) {
            console.log("confirming order...");
            makeRequest("PUT", "/manager/orders/confirmOrder", {
                    orderId: orderId
                })
                .then(res => {
                    if (res == "ok") {
                        order.classList.add("confirmed");
                        order.querySelector(".orderSections .confirmOrder").remove();
                        order.querySelector(".orderSections .denyOrder").remove();
                    } else {
                        throw (res);
                    }
                })
                .catch(error => {
                    console.log("error: ", error);
                    promptError();
                });
        });



        order.querySelector(".orderSections .denyOrder").addEventListener("click", async function(e) {
            console.log("confirming order...");
            makeRequest("PUT", "/manager/orders/denyOrder", {
                    orderId: orderId
                })
                .then(res => {
                    if (res == "ok") {
                        order.classList.add("denied");
                        order.querySelector(".orderSections .confirmOrder").remove();
                        order.querySelector(".orderSections .denyOrder").remove();
                    } else {
                        throw (res);
                    }
                })
                .catch(error => {
                    console.log("error: ", error);
                    promptError();
                });
        });



        order.querySelector(".orderSections .addExtraTime.addExtraTime_15").addEventListener("click", async function(e) {
            console.log("Adding 15 minutes extra time to order...");
            makeRequest("PUT", "/manager/orders/addTimeToOrder_15", {
                    orderId: orderId
                })
                .then(res => {
                    if (res == "ok") {
                        removeAllDelaysFromExtraTimeButtons(order);
                        order.querySelector(".orderSections .addExtraTime.addExtraTime_15").classList.add("delayed");
                        Swal.fire(
                            'Geslaagd!',
                            'Het order werd met 15 minuten uitgesteld, de klant zal hiervan een e-mail ontvangen.',
                            'success'
                        );
                    } else {
                        throw (res);
                    }
                })
                .catch(error => {
                    console.log("error: ", error);
                    promptError();
                });
        });
        order.querySelector(".orderSections .addExtraTime.addExtraTime_30").addEventListener("click", async function(e) {
            console.log("Adding 30 minutes extra time to order...");
            makeRequest("PUT", "/manager/orders/addTimeToOrder_30", {
                    orderId: orderId
                })
                .then(res => {
                    if (res == "ok") {
                        removeAllDelaysFromExtraTimeButtons(order);
                        order.querySelector(".orderSections .addExtraTime.addExtraTime_30").classList.add("delayed");
                        Swal.fire(
                            'Geslaagd!',
                            'Het order werd met 30 minuten uitgesteld, de klant zal hiervan een e-mail ontvangen.',
                            'success'
                        );
                    } else {
                        throw (res);
                    }
                })
                .catch(error => {
                    console.log("error: ", error);
                    promptError();
                });
        });
        order.querySelector(".orderSections .addExtraTime.addExtraTime_60").addEventListener("click", async function(e) {
            console.log("Adding 60 minutes extra time to order...");
            makeRequest("PUT", "/manager/orders/addTimeToOrder_60", {
                    orderId: orderId
                })
                .then(res => {
                    if (res == "ok") {
                        removeAllDelaysFromExtraTimeButtons(order);
                        order.querySelector(".orderSections .addExtraTime.addExtraTime_60").classList.add("delayed");
                        Swal.fire(
                            'Geslaagd!',
                            'Het order werd met 60 minuten uitgesteld, de klant zal hiervan een e-mail ontvangen.',
                            'success'
                        );
                    } else {
                        throw (res);
                    }
                })
                .catch(error => {
                    console.log("error: ", error);
                    promptError();
                });
        });

    }



    /*
        product.querySelector("form .cancel-button").addEventListener("click", async function(e) {
            console.log("cancelling...");
            hideForm(product);
        });

        product.querySelector(".orderable input[type='checkbox']").addEventListener("click", async function(e) {
            await makeRequest("PUT", "/manager/producten/toggleOrderable", { productId: productId })
                .then(res => {
                    if (res !== "ok") throw (res);
                })
                .catch((error) => {
                    console.log("error: ", error);
                    e.target.checked = !e.target.checked;
                    promptError();
                })
        });

        product.querySelector(".edit").addEventListener("click", async function(e) {
            let productId = getClosest(e.target, "[data-id").dataset.id;
            showForm(product);
        });

        product.querySelector(".remove").addEventListener("click", async function(e) {
            let productId = getClosest(e.target, "[data-id").dataset.id;
            Swal.fire({
                    title: 'Bent u zeker dat u onderstaand product wilt verwijderen?',
                    text: product.querySelector(".row.upper .name").innerHTML,
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#dadada',
                    cancelButtonText: 'Annuleren',
                    confirmButtonColor: '#e43a3a',
                    confirmButtonText: 'Verwijderen',
                    reverseButtons: true

                })
                .then((result) => {
                    if (result.value) {
                        makeRequest("DELETE", "/manager/producten/deleteProduct", { productId: productId })
                            .then(res => {
                                console.log("res", res);
                                if (res == "ok") {
                                    Swal.fire(
                                        'Geslaagd!',
                                        'Uw product is verwijderd.',
                                        'success'
                                    );
                                    product.remove();
                                } else if (res == "product found in orders") {
                                    promptError("Dit product werd gevonden in minstens één order en kan dus niet verwijderd worden.");
                                } else {
                                    throw (res);
                                }

                            })
                            .catch(error => {
                                console.log("error: ", error);
                                e.target.checked = !e.target.checked;
                                promptError();
                            })
                    }
                })

        });

        */
}




function showForm(productDOM_element) {
    productDOM_element.querySelector("form").classList.remove("hidden");
    productDOM_element.querySelector(".row.upper").classList.add("hidden");
    productDOM_element.querySelector(".row.bottom").classList.add("hidden");
}

function hideForm(productDOM_element) {
    productDOM_element.querySelector("form").classList.add("hidden");
    productDOM_element.querySelector(".row.upper").classList.remove("hidden");
    productDOM_element.querySelector(".row.bottom").classList.remove("hidden");
}

function removeAllDelaysFromExtraTimeButtons(order) {
    let extraTimeElements = order.querySelectorAll(".orderSections .addExtraTime");
    for (let i = 0; i < extraTimeElements.length; i++) {
        extraTimeElements[i].classList.remove("delayed");
    }
};