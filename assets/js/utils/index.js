export function post(url, data, token) {
    let headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    };
    if (token) headers["X-AUTH-TOKEN"] = token

    return new Promise((resolve, reject) => {
        global.$.ajax({
            type: "POST",
            url: `${document.location.origin}${url}`,
            headers,
            data: JSON.stringify(data)
        }).done(function (data) {
            resolve(data)
        }).fail(function (response) {
            reject(response)
        })
    })
}

export function postGraphql(url, data, token) {
    let headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    };
    //if (token) headers["X-AUTH-TOKEN"] = token

    return new Promise((resolve, reject) => {
        global.$.ajax({
            type: "POST",
            url: `${document.location.origin}${url}?api_token=${token}`,
            headers,
            data: JSON.stringify({query: data})
        }).done(function (data) {
            resolve(data)
        }).fail(function (response) {
            reject(response)
        })
    })
}

async function get(url, data, token) {
    let headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    };
    if (token) headers["X-AUTH-TOKEN"] = token

    return new Promise((resolve, reject) => {
        global.$.ajax({
            type: "GET",
            url: `${document.location.origin}${url}`,
            headers,
            data: data
        }).done(function (data) {
            resolve(data)
        }).fail(function (response) {
            reject(response)
        })
    })
}
