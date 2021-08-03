import { createStore } from 'vuex'

const store = createStore({
    state () {
      return {
        isAuthenticated: localStorage.getItem('isAuthenticated') !== null
      }
    },
    mutations: {
      login (state) {
        state.isAuthenticated = true;
      },
      logout (state) {
        localStorage.removeItem('isAuthenticated');
        state.isAuthenticated = false;
      }
    }
  });
  export default store;