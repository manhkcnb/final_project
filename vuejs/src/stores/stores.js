import { createStore } from 'vuex';
const store = createStore({
  state: {
    email_reset: '',
    email:'',
    password:'',
  },
  getters: {
    getEmail_reset: (state) => state.email_reset,
    getEmail: (state) => state.email,
    getPassword: (state) => state.password,
  },
});

export default store;
