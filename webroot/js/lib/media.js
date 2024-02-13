//Upload Media
function uploadMedia(files = [], multiple = false) {
    return new Promise(async (resolve, reject) => {
        try {
            const accessToken = document.getElementById('access_token').value;

            let promises = files.map((file) => {
                if (isFile(file) && file !== undefined) {
                    let formData = new FormData(); //default JS
                    formData.append("media", file);
                    return axios.post(API_URL + 'media/upload', formData, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'multipart/form-data',
                            ...accessToken ? { 'Authorization': 'Bearer ' + accessToken } : null
                        }
                    });
                }
            });

            const filesResp = [];
            Promise.all(promises).then((results) => {
                results.map((result) => {
                    if (result) {
                        const { data } = result;
                        if (data.success) {
                            filesResp.push(data.data);
                        }
                    }
                });
                if (_.get(filesResp, 'length', 0) === 1 && multiple === false) {
                    resolve(filesResp[0]);
                } else {
                    resolve(filesResp);
                }
            });
        } catch (error) {
            console.log("File Upload erROR: ",error);
            reject(error);
        }
    })
}

//FormatMedia
function formatMedia(media = {}) {
    const finalMedia = [];
    const tmp = {
        id: media.id,
        url: BASE_URL + media.directory + media.value,
        name: media.value,
        type: media.type,
        hasPreview: media.media_type == 'IMAGE' ? true : false
    }
    finalMedia.push(tmp);
    return finalMedia;
}
