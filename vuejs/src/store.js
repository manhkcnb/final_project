import { createStore } from 'vuex';
const store = createStore({
  state: {
    email_reset: '',
    email:'',
  },
  mutations: {
    setEmailReset(state, newEmail) {
      state.email_reset = newEmail;
    },
    setEmail(state, newEmail) {
      state.email = newEmail;
    },
    
  },
  getters: {
    getEmail_reset: (state) => state.email_reset,
    getEmail: (state) => state.email,
   
  },
});

export default store;
