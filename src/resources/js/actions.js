import axios from 'axios';

export const getGalleryById = (id) => {
    return axios.get(API_URL + 'gallery/' + id)
        .then(res => res);
}

export const getGalleryItemPathById = (id, width, height, objectFit) => {
    return axios.get(API_URL + `gallery-item/${id}/${width}/${height}/${objectFit}`)
        .then(res => res);
}

export const storeGalleryItem = (data, gallery_id) => {
    return axios.post(API_URL + 'gallery-item/' + gallery_id, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })

}

export const updateGalleryItem = (data, id) => {
    return axios.post(API_URL + 'gallery-item/' + id + '/update', data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
}

export const deleteGalleryItem = (gallery_item_id) => {
    return axios.delete(API_URL + 'gallery-item/' + gallery_item_id, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res);
}
