document.addEventListener("DOMContentLoaded", function() {
    let allProductElements = document.querySelectorAll(".products li");
    for (let i = 0; i < allProductElements.length; i++) {
        setEventListenersForProduct(allProductElements[i]);
    }

    document.querySelector(".createProductForm input[type='submit']").addEventListener("click", async function(e) {
        e.preventDefault();

        const formData = new FormData();
        const imageFile = document.querySelector(".createProductForm input[name='image']").files[0];
        if (imageFile !== undefined) {
            formData.append('image', imageFile);
        }
        formData.append("name", document.querySelector(".createProductForm .name").value);
        formData.append("price", document.querySelector(".createProductForm .price").value);
        formData.append("description", document.querySelector(".createProductForm .description").value);
        formData.append("productCategory", document.querySelector(".createProductForm .productCategory").value);
        formData.append("_token", getCSRF_token());

        await fetch("/admin/producten/addProduct", {
                method: "POST",
                mode: 'cors',
                headers: {
                    //'Content-Type': 'multipart/form-data', /*may not be defined when uploading a file*/
                    'Accept': 'application/json',
                },
                redirect: 'follow',
                body: formData
            })
            .then(res => { return res.json() })
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
            });
    });

    document.querySelector("form.newProductCategoryForm input[type='submit']").addEventListener("click", function(e) {
        e.preventDefault();

        makeRequest("POST", "/admin/producten/addProductCategory", {
                name: document.querySelector("form.newProductCategoryForm input[type='text']").value
            })
            .then(res => {
                if (res == "ok") {
                    Swal.fire(
                            'Geslaagd!',
                            'De productcategorie werd aangemaakt.',
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
                if (error == "category already exists") {
                    promptError("Er bestaat al een categorie met deze naam.");
                } else {
                    promptError();
                }
            })
    });

    let allProductCategoryElements = document.querySelectorAll(".productCategoryList li");
    for (let i = 0; i < allProductCategoryElements.length; i++) {
        setEventListenersForProductCategory(allProductCategoryElements[i]);
    }

    document.querySelector(".createProductForm .productImageUploadButton").addEventListener("click", function(e) {
        e.preventDefault();
        document.querySelector(".createProductForm input[name='image']").click();
    });

    document.querySelector(".createProductForm input[name='image']").addEventListener("change", function() {
        readURL(this, document.querySelector(".createProductForm .imagePreview img"), false);
        document.querySelector(".createProductForm .imagePreview").classList.remove("hidden");
    });
});

function setEventListenersForProductCategory(productCategory) {
    let productCategoryId = productCategory.dataset.productcategoryid;
    productCategory.querySelector(".edit").addEventListener("click", function() {
        Swal.fire({
                title: 'Wijzig de categorienaam',
                input: 'text',
                inputValue: productCategory.querySelector(".upper-row").innerHTML,
                inputPlaceholder: productCategory.querySelector(".upper-row").innerHTML,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                cancelButtonColor: '#dadada',
                cancelButtonText: 'Annuleren',
                confirmButtonColor: '#4CAF50',
                confirmButtonText: 'Opslaan',
                reverseButtons: true,
                allowOutsideClick: () => !Swal.isLoading()
            })
            .then(res => {
                if (res.value) {
                    makeRequest("PUT", "/admin/producten/editProductCategory", {
                            name: res.value,
                            productCategoryId: productCategoryId
                        })
                        .then(res => {
                            if (res == "ok") {
                                Swal.fire(
                                        'Geslaagd!',
                                        'De productcategorie werd aangepast.',
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
                            if (error == "category already exists") {
                                promptError("Er bestaat al een categorie met deze naam.");
                            } else {
                                promptError();
                            }
                        })
                }
            })
    });

    productCategory.querySelector(".remove").addEventListener("click", function() {
        Swal.fire({
                title: 'Bent u zeker dat u de categorie wilt verwijderen?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#dadada',
                cancelButtonText: 'Annuleren',
                confirmButtonColor: '#e43a3a',
                confirmButtonText: 'Verwijderen',
                reverseButtons: true
            })
            .then(res => {
                if (res.value) {
                    makeRequest("DELETE", "/admin/producten/deleteProductCategory", {
                            productCategoryId: productCategoryId
                        })
                        .then(res => {
                            if (res == "ok") {
                                Swal.fire(
                                        'Geslaagd!',
                                        'De productcategorie werd verwijderd.',
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
                            if (error == "category connected with products") {
                                promptError("Er zijn producten gevonden in deze categorie. Verander de categorie van deze producten eerst.");
                            } else {
                                promptError();
                            }
                        })
                }
            });
    });
}

function setEventListenersForProduct(product) {
    let productId = getClosest(product, "[data-id").dataset.id;

    product.querySelector("form .update-button").addEventListener("click", async function(e) {
        console.log("updating product...");
        e.preventDefault();


        const formData = new FormData();
        const imageFile = product.querySelector("form .newProductImage input[name='newImage']").files[0];
        if (imageFile !== undefined) {
            formData.append('newImage', imageFile);
        }
        formData.append("name", product.querySelector("form .inputValues .name").value);
        formData.append("price", product.querySelector("form .inputValues .price").value);
        formData.append("description", product.querySelector("form .descriptionValue textarea").value);
        formData.append("productCategory", product.querySelector("form .productCategorySelection select").value);
        formData.append("_token", getCSRF_token());

        await fetch("/admin/producten/updateProduct", {
                method: "PUT",
                mode: 'cors',
                headers: {
                    //'Content-Type': 'multipart/form-data', /*may not be defined when uploading a file*/
                    'Accept': 'application/json',
                },
                redirect: 'follow',
                body: formData
            })
            .then(res => { return res.json() })
            .then(res => {
                if (res == "ok") {
                    hideForm(product);
                    product.querySelector(".row.upper .name").innerHTML = name;
                    product.querySelector(".row.upper .price").innerHTML = "€ " + addTrailZero(price, 2);
                    product.querySelector(".row.productCategoryRow p").innerHTML = product.querySelector("form .productCategory option[value='" + productCategoryId + "']").innerHTML;
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


        /*
                makeRequest("PUT", "/admin/producten/updateProduct", {
                        productId: productId,
                        name: name,
                        price: price,
                        description: description,
                        productCategory: productCategoryId
                    })
                    .then(res => {
                        if (res == "ok") {
                            hideForm(product);
                            product.querySelector(".row.upper .name").innerHTML = name;
                            product.querySelector(".row.upper .price").innerHTML = "€ " + addTrailZero(price, 2);
                            product.querySelector(".row.productCategoryRow p").innerHTML = product.querySelector("form .productCategory option[value='" + productCategoryId + "']").innerHTML;
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
                    */
    });

    product.querySelector("form .newProductImage .newProductImageUploadButton").addEventListener("click", function(e) {
        e.preventDefault();
        product.querySelector("form .newProductImage input[name='newImage']").click();
    });

    product.querySelector("form .newProductImage input[name='newImage']").addEventListener("change", function() {
        readURL(this, product.querySelector("form .newProductImage img"), false);
        product.querySelector("form .newProductImage img").classList.remove("hidden");
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
    productDOM_element.querySelector(".row.productCategoryRow").classList.add("hidden");
    productDOM_element.querySelector(".row.productImage").classList.add("hidden");
    productDOM_element.querySelector(".row.upper").classList.add("hidden");
    if (productDOM_element.querySelector(".row.descriptionRow")) { productDOM_element.querySelector(".row.descriptionRow").classList.add("hidden"); };
    productDOM_element.querySelector(".row.bottom").classList.add("hidden");
}

function hideForm(productDOM_element) {
    productDOM_element.querySelector("form").classList.add("hidden");
    productDOM_element.querySelector(".row.productCategoryRow").classList.remove("hidden");
    productDOM_element.querySelector(".row.productImage").classList.remove("hidden");
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