
function fetchAPI(url, method = 'GET', body = {}) {
    return new Promise((resolve, reject) => {
        const tmpBody = method != 'GET' ? { body: JSON.stringify(body) } : {};
        const accessToken = document.getElementById('access_token').value;
        fetch(API_URL + url, {
            method: method,
            ...tmpBody,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                ...accessToken ? { 'Authorization': 'Bearer ' + accessToken } : null
            }
        })
        .then(function (response) {
            return response.json();
        }).then(function (data) {
            return resolve(data);
        })
        .catch(function (err) {
            console.log("ERROR: ", err);
            reject(err);
        });
    });
}

//isFile
function isFile(input) {
    if ('File' in window && input instanceof File)
       return true;
    else return false;
 } 

// getId
function getId() {
    const url = window.location.pathname;
    const opts = url.split('/');
    return opts[opts.length - 1];
}

// goToUrl
function goTo(url = '/') {
    return window.location.href = BASE_URL + 'asgard/' + url;
}

// getHtmlContent
function getContentHtml(className = 'quill') {
    const richEditor = document.getElementsByClassName(className);
    if (_.get(richEditor, 'length', 0) > 0) {
        return _.get(richEditor, '[0].children[0].innerHTML', null);
    }
    return null;
}

// setHtmlContent
function setContentHtml(className = 'quill', html, reInit = true) {
    setTimeout(() => {
        reInit ? new Quill('.quill', quillOptions) : null;
        const richEditor = document.getElementsByClassName(className);
        if (_.get(richEditor, 'length', 0) > 0) {
            _.set(richEditor, '[0].children[0].innerHTML', html);
        }
    }, 100);
    return false;
}
function getParams() {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    return params;
}

function setQueryParams(key = '', value = null) {
    const urlSearchParams = new URLSearchParams(window.location.search);
    urlSearchParams.set(key, value);
    history.replaceState(null, null, "?" + urlSearchParams.toString());
}