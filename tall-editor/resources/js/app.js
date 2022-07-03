
import axios from 'axios'
import { sprintf, _n, setLocaleData} from '@wordpress/i18n';
setLocaleData({
    "Paragraph":"Paragrafo"
},"pt")
sprintf( _n( '%d hat', '%d hats', 4, 'text-domain' ), 4 );
document.addEventListener('block-editor/init', () => {
    console.log('block-editor/init')
})
console.log(sprintf( _n( '%d hat', '%d hats', 4, 'text-domain' ), 4 ))
// var i18n = wp.i18n
// Object.values(Laraberg.wordpress).map(key=>{
//     console.log(key)
// })
// console.log(Laraberg,Laraberg.wordpress.languages)
// wp.i18n.setLocaleData({
//     "No block selected.":"Numhum bloco selecionado"
// });
window.LarabergInit = (element, route, options = {}) => {
    const instance = axios.create({
        headers: { "Content-Type": "multipart/form-data" }
    });
    const mediaUpload = ({ filesList, onFileChange }) => {
        Array.from(filesList).map(file => {
            let data = new FormData()
            data.append('file', file)
            instance.post(route, data).then(response => {
                console.log(response.data)
                onFileChange(response.data)
            })
        })
    }
    Laraberg.init('content', Object.assign({ mediaUpload }, options))
}