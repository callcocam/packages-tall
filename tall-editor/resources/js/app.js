
import axios from 'axios'

document.addEventListener('block-editor/init', () => {
    console.log('block-editor/init')
})
const instance = axios.create({
    baseURL: 'http://localhost/api/',
    headers: { "Content-Type": "multipart/form-data" }
});
const mediaUpload = ({ filesList, onFileChange }) => {
    Array.from(filesList).map(file => {
        let data = new FormData()
        data.append('file', file)
        instance.post("upload", data).then(response => {
            console.log(response.data)
            onFileChange(response.data)
        })
    })
}

Laraberg.init('content', { mediaUpload })
