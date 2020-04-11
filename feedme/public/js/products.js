document.addEventListener("DOMContentLoaded", function() {
    let allProductElements = document.querySelectorAll(".products li");
    for (let i = 0; i < allProductElements.length; i++) {
        setEventListenersForProduct(allProductElements[i]);
    }

    document.querySelector(".createProductForm input[type='submit']").addEventListener("click", function(e) {
        e.preventDefault();
        makeRequest("POST", "/admin/producten/addProduct", {
                name: document.querySelector(".createProductForm .name").value,
                price: document.querySelector(".createProductForm .price").value,
                description: document.querySelector(".createProductForm .description").value
            })
            .then(res => {
                if (res == "ok") {
                    Swal.fire(
                            'Geslaagd!',
                            'Uw product is toegevoegd.',
                            'success'
                        )
                        .then(res => {
                            window.location.href = "/admin/producten";
                        })
                } else {
                    throw (res);
                }
            })
            .catch(error => {
                console.log("error: ", error);
                promptError();
            })
    });
});

function setEventListenersForProduct(product) {
    let productId = getClosest(product, "[data-id").dataset.id;

    product.querySelector("form .update-button").addEventListener("click", async function(e) {
        console.log("saving...");
        e.preventDefault();
        const name = product.querySelector("form .inputValues .name").value;
        const price = product.querySelector("form .inputValues .price").value;
        const description = product.querySelector("form .descriptionValue textarea").value;

        makeRequest("PUT", "/admin/producten/updateProduct", {
                productId: productId,
                name: name,
                price: price,
                description: description
            })
            .then(res => {
                if (res == "ok") {
                    hideForm(product);
                    product.querySelector(".row.upper .name").innerHTML = name;
                    product.querySelector(".row.upper .price").innerHTML = "€ " + addTrailZero(price, 2);
                    if (product.querySelector(".row.descriptionRow") && description != "") {
                        console.log("a");
                        product.querySelector(".row.descriptionRow p").innerHTML = description;
                    } else {
                        console.log("b");
                        if (description != "") {
                            console.log("c");
                            product.querySelector(".row.upper").insertAdjacentHTML("afterEnd", '<div class="row descriptionRow"><p>' + description + '</p></div>');
                        } else {
                            if (product.querySelector(".row.descriptionRow")) {
                                product.querySelector(".row.descriptionRow").remove();
                            }
                        }
                    }

                } else {
                    throw (res);
                }
            })
            .catch(error => {
                console.log("error: ", error);
                e.target.checked = !e.target.checked;
                promptError();
            });
    });

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
}




function showForm(productDOM_element) {
    productDOM_element.querySelector("form").classList.remove("hidden");
    productDOM_element.querySelector(".row.upper").classList.add("hidden");
    if (productDOM_element.querySelector(".row.descriptionRow")) { productDOM_element.querySelector(".row.descriptionRow").classList.add("hidden"); };
    productDOM_element.querySelector(".row.bottom").classList.add("hidden");
}

function hideForm(productDOM_element) {
    productDOM_element.querySelector("form").classList.add("hidden");
    productDOM_element.querySelector(".row.upper").classList.remove("hidden");
    if (productDOM_element.querySelector(".row.descriptionRow")) { productDOM_element.querySelector(".row.descriptionRow").classList.remove("hidden"); };
    productDOM_element.querySelector(".row.bottom").classList.remove("hidden");
}

function addTrailZero(num, digits) {
    // addTrailZero() : add trailing zeroes to given number
    // PARAM num : original number
    //       digits : total number of decimal places required

    var cString = num.toString(), // Convert to string
        cLength = cString.indexOf(","); // Position of decimal point

    // Is a whole number
    if (cLength == -1) {
        cLength = 0;
        cString += ",";
    }
    // Is a decimal nummber 
    else {
        cLength = cString.substr(cLength + 1).length;
    }

    // Pad with zeroes
    if (cLength < digits) {
        for (let i = cLength; i < digits; i++) {
            cString += "0";
        }
    }

    // Return result
    return cString;
}