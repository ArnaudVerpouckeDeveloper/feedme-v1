async function makeRequest(method, url, data = {}, success, error) {
    data._token = getCSRF_token();
    const response = await fetch(url, {
        method: method,
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        redirect: 'follow',
        body: JSON.stringify(data)
    });
    return await response.json();
}

function getCSRF_token() {
    return document.querySelector("[name='_token']").value;
}



function promptError(text = "Er liep iets fout!") {
    Swal.fire({
        icon: 'error',
        title: 'Oei...',
        text: text
    })
}

function readURL(input, DOM_preview_element, showBorder = true) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            DOM_preview_element.src = e.target.result;
        }
        if (showBorder) {
            DOM_preview_element.classList.add("showBorder");
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}


function inputToFormattedPrice(input, withCurrency) {
    formattedPrice = input.replace("€", "");
    formattedPrice = formattedPrice.replace(",", ".");
    formattedPrice = formattedPrice.trim();
    formattedPrice = Number(formattedPrice).toFixed(2);
    if (withCurrency) {
        formattedPrice = "€ " + formattedPrice;
    }
    formattedPrice = formattedPrice.replace(".", ",");
    return formattedPrice;
}