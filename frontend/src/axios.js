import  axios from 'axios'
import router from './router'
const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: true,
    withXSRFToken: true,
})

// axiosClient.interceptors.request.use(function (config) {
//     const token = localStorage.getItem('token')
//     config.headers.Authorization = `Bearer ${token}`
//     return config
// })

axiosClient.interceptors.response.use(
    function (response) {
        return response
    },
    function (error) {
        if (error.response.status === 401) {
          //  window.location.href = '/login'
          router.push({name: 'Login'});
        }
        return Promise.reject(error)
    }
)

export default axiosClient