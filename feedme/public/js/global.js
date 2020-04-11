async function makeRequest(method, url, data = {}, success, error) {
    data._token = getCSRF_token();
    const response = await fetch(url, {
        method: method,
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + getBearerToken(),
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

function getBearerToken() {
    return "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NjAyMDkxMiwiZXhwIjoxNTg2MDI0NTEyLCJuYmYiOjE1ODYwMjA5MTIsImp0aSI6InVxTTRDQXFCNUJLUWtnTzciLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.cZOesS5FcyYl1zCzwQWxdk3QM9JKNLaehnxe0TPx8_g";
}

function promptError(text = "Er liep iets fout!") {
    Swal.fire({
        icon: 'error',
        title: 'Oei...',
        text: text
    })
}