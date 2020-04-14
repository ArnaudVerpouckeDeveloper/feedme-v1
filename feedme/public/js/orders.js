document.addEventListener("DOMContentLoaded", function() {
    let allOrderElements = document.querySelectorAll(".orders .order");
    for (let i = 0; i < allOrderElements.length; i++) {
        setEventListenersForOrder(allOrderElements[i]);
    }
    checkForOpenOrders(true);
    setInterval(checkForOpenOrders, 30000);
});


function checkForOpenOrders(hasToConfirm = false) {
    makeRequest("POST", "/admin/orders/checkForOpenOrders")
        .then(res => {
            if (Object.values(res).length > 0) {
                if (hasToConfirm) {
                    Swal.fire(
                        'U heeft openstaande orders.',
                        '',
                        'warning'
                    )
                } else {
                    if (orderIdIsMissing(Object.values(res))) {
                        newOrderSound.play();
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        notificationSound.play();
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'U heeft openstaande orders.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            } else {
                console.log("No open orders were found.", res);
            }
        })
        .catch(error => {
            console.log("Error:", error);
        });
}

function orderIdIsMissing(allOrderIdsToCheck) {
    for (let i = 0; i < allOrderIdsToCheck.length; i++) {
        const orderIdToCheck = allOrderIdsToCheck[i].id;
        if (!document.querySelector(".order[data-orderId='" + orderIdToCheck + "']")) { //notFound
            return true;
        }
    }
    return false;
}

function setEventListenersForOrder(order) {
    let orderId = order.dataset.orderid;
    if (order.classList.contains("accepted") || order.classList.contains("denied")) {
        order.querySelector(".orderSections .completeOrder").addEventListener("click", async function(e) {
            console.log("completing order...");
            makeRequest("PUT", "/admin/orders/completeOrder", {
                    orderId: orderId
                })
                .then(res => {
                    if (res == "ok") {
                        Swal.fire(
                            'Geslaagd!',
                            'Het order werd succesvol afgerond.',
                            'success'
                        );
                        $(".order[data-orderId='" + orderId + "']").fadeOut(400, "swing", function() {
                            order.remove();
                        });
                    } else {
                        throw (res);
                    }
                })
                .catch(error => {
                    console.log("error: ", error);
                    promptError();
                });
        });
    } else {
        order.querySelector(".orderSections .acceptOrder").addEventListener("click", async function(e) {
            console.log("confirming order...");
            makeRequest("PUT", "/admin/orders/acceptOrder", {
                    orderId: orderId
                })
                .then(res => {
                    if (res == "ok") {
                        order.classList.add("accepted");
                        order.querySelector(".orderSections .acceptOrder").remove();
                        order.querySelector(".orderSections .denyOrder").remove();
                        order.querySelector(".orderSections .deliveryMethod").insertAdjacentHTML("afterEnd", "<li class='action completeOrder'><span class='material-icons'>check</span><p>Voltooi</p></li>");
                        setEventListenersForOrder(order);
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
            makeRequest("PUT", "/admin/orders/denyOrder", {
                    orderId: orderId
                })
                .then(res => {
                    if (res == "ok") {
                        Swal.fire(
                            'Geslaagd!',
                            'Het order werd geweigerd, de klant zal hiervan een e-mail ontvangen.',
                            'success'
                        );
                        $(".order[data-orderId='" + orderId + "']").fadeOut(400, "swing", function() {
                            order.remove();
                        });
                        /*
                        order.classList.add("denied");
                        order.querySelector(".orderSections .acceptOrder").remove();
                        order.querySelector(".orderSections .denyOrder").remove();
                        */
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
            makeRequest("PUT", "/admin/orders/addTimeToOrder_15", {
                    orderId: orderId
                })
                .then(res => {
                    console.log(res);
                    if (res.message == "ok") {
                        removeAllDelaysFromExtraTimeButtons(order);
                        showNewTime(order, res.newTime);
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
            makeRequest("PUT", "/admin/orders/addTimeToOrder_30", {
                    orderId: orderId
                })
                .then(res => {
                    console.log(res);

                    if (res.message == "ok") {
                        removeAllDelaysFromExtraTimeButtons(order);
                        showNewTime(order, res.newTime);
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
            makeRequest("PUT", "/admin/orders/addTimeToOrder_60", {
                    orderId: orderId
                })
                .then(res => {
                    console.log(res);

                    if (res.message == "ok") {
                        removeAllDelaysFromExtraTimeButtons(order);
                        showNewTime(order, res.newTime);
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
            await makeRequest("PUT", "/admin/producten/toggleOrderable", { productId: productId })
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
                        makeRequest("DELETE", "/admin/producten/deleteProduct", { productId: productId })
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
}

function showNewTime(order, newTime) {
    order.querySelector(".time").classList.add("lineThrough");
    if (order.querySelector(".timeDelay")) {
        order.querySelector(".timeDelay").remove();
    }
    order.querySelector(".time").insertAdjacentHTML("afterEnd", "<p class='timeDelay'>" + newTime + "</p>");

}