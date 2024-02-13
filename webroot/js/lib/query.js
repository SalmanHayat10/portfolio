/**
 * Get Single Record
 * @return object
 */
 function getOne(modelName = null, options = { where: {} }) {
    return new Promise (async (resolve, reject) => {
        try {
            const resp = await fetchAPI('query/read', 'POST', {
                model: modelName,
                options: {
                    conditions: options.where,
                    ...options
                },
                type: 'one'
            });
            if (resp.success) {
                resolve(resp);
            }
        } catch (error) {
            reject(error);
            console.log("ERROR: ",error);
        }
    })
}

/**
 * Get Many Record
 * @return array
 */
 function getMany(modelName = null, options = { where: {}, limit: 20 }) {
    return new Promise (async (resolve, reject) => {
        try {
            const resp = await fetchAPI('query/read', 'POST', {
                model: modelName,
                options: {
                    conditions: options.where,
                    ...options
                },
                type: 'many'
            });
            if (resp.success) {
                resolve(resp);
            }
        } catch (error) {
            reject(error);
            console.log("ERROR: ",error);
        }
    })
}

/**
 * Get Count of Records
 * @return integer
 */
function getCount(modelName = null, options = { where: {} }) {
    return new Promise (async (resolve, reject) => {
        try {
            const resp = await fetchAPI('query/read', 'POST', {
                model: modelName,
                options: {
                    conditions: options.where,
                    ...options
                },
                type: 'count'
            });
            if (resp.success) {
                resolve(resp);
            }
        } catch (error) {
            reject(error);
            console.log("ERROR: ",error);
        }
    })
}

/**
 * Get List of Records
 * @return array
 */
 function getList(modelName = null, options = { where: {}, limit: 20 }) {
    return new Promise (async (resolve, reject) => {
        try {
            const resp = await fetchAPI('query/read', 'POST', {
                model: modelName,
                options: {
                    conditions: options.where,
                    ...options
                },
                type: 'list'
            });
            if (resp.success) {
                resolve(resp);
            }
        } catch (error) {
            reject(error);
            console.log("ERROR: ",error);
        }
    })
}

/**
 * Get Records with Pagination Supports
 * @return array
 */
function getPagination(modelName = null, options = { where: {}, limit: 20, page: 1 }) {
    return new Promise (async (resolve, reject) => {
        try {
            const resp = await fetchAPI('query/readPagination', 'POST', {
                model: modelName,
                options: {
                    conditions: options.where,
                    ...options
                }
            });
            if (resp.success) {
                resolve(resp);
            }
        } catch (error) {
            reject(error);
            console.log("ERROR: ",error);
        }
    })
}

/**
 * Save a Record
 * @return array
 */
function saveData(modelName = null, fields = {}) {
    return new Promise(async (resolve, reject) => {
       try {
           const resp = await fetchAPI('query/create', 'POST', {
                model: modelName,
                fields
            });
        if (resp.success) {
            resolve(resp);
        }
       } catch (error) {
           reject(error);
           console.log("[ERROR]: ",error);
       } 
    });
}

/**
 * Update a Record
 * @return array
 */
function updateData(modelName = null, fields = {}) {
    return new Promise(async (resolve, reject) => {
        try {
            // const resp = await fetchAPI('query/create', 'POST', {
            //     model: modelName,
            //     fields
            // });
            // if (resp.success) {
            //     resolve(resp);
            // }
        } catch (error) {
            reject(error);
            console.log("[ERROR]: ",error);
        } 
    });
}

/**
 * SoftDelete
 * @return array 
 */
function softDelete(modelName = null, options = { where: { } }) {
    return new Promise(async (resolve, reject) => {
        try {
            const resp = await fetchAPI('query/delete', 'DELETE', {
                model: modelName,
                options: {
                    conditions: options.where,
                    ...options
                },
                type: 'soft'
            });
            if (resp.success) {
                resolve(resp);
            }
        } catch (error) {
            reject(error);
        }
    });
}

/**
 * RecoverDelete
 * @return array
 */
 function recoverDelete(modelName = null, options = { where: { } }) {
    return new Promise(async (resolve, reject) => {
        try {
            const resp = await fetchAPI('query/delete', 'DELETE', {
                model: modelName,
                options: {
                    conditions: options.where,
                    ...options
                },
                type: 'recover'
            });
            if (resp.success) {
                resolve(resp);
            }
        } catch (error) {
            reject(error);
        }
    });
}

/**
 * HardDelete
 * @return array
 */
 function hardDelete(modelName = null, options = { where: { } }) {
    return new Promise(async (resolve, reject) => {
        try {
            const resp = await fetchAPI('query/delete', 'DELETE', {
                model: modelName,
                options: {
                    // conditions: options.where,
                    ...options
                },
                type: 'hard'
            });
            if (resp.success) {
                resolve(resp);
            }
        } catch (error) {
            reject(error);
        }
    });
}
