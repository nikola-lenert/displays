import Vue from 'vue'
import Vuex from 'vuex'
import http from '../http/index'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        displayData: null,
        displaySetupData: null,
    },
    getters: {},
    mutations: {
        SET_DISPLAY_DATA(state, displays) {
            state.displayData = displays
        },
        SET_DISPLAY_SETUP_DATA(state, data) {
            state.displaySetupData = data
        }
    },
    actions: {
        loadDisplaySetup({commit, state}) {
            if (state.displaySetupData) {
                return state.displaySetupData
            }

            return http.get('display/setup').then(response => {
                commit('SET_DISPLAY_SETUP_DATA', response.data.data)
                return state.displaySetupData
            })
        },
        loadDisplays({commit, state}, params) {
            return http.get('display', {params}).then(response => {
                commit('SET_DISPLAY_DATA', response.data)
                return state.displayData
            })
        },
        loadDisplay(context, id) {
            return http.get(`display/${id}`).then(response => {
                return response.data.data
            })
        },
        saveDisplay({commit, dispatch}, payload) {
            const data = new FormData()

            Object.entries(payload).forEach(([key, value]) => {
                if (value) {
                    data.append(key, value)
                }
            })

            return http.request({
                method: "post", url: 'display', data, headers: {"Content-Type": "multipart/form-data"}
            }).then(() => {
                return dispatch('loadDisplays')
            })
        },
        deleteDisplay({dispatch}, id) {
            return http.delete(`display/${id}`).then(() => {
                return dispatch('loadDisplays')
            })
        }
    }
})
