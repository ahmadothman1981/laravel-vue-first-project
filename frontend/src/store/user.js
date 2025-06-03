import { defineStore } from "pinia"
import axiosClient from '@/axios'


export const useUserStore = defineStore('user', {
    state: () => ({
        user: null
    }),
    actions: {
       fetchUser() {
         return axiosClient.get('/api/user')
                .then(res => {
                    this.user = res.data
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
})

export default  useUserStore;