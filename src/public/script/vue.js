new Vue({
  el: '#app',
  data(){
    return {
      email: '',
      password :''
    };
  },
  computed:{
    isInValidEmail(){
      const regex = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[salto]+.[link]+$/)
      return !regex.test(this.email);
    },
    isInValidPassword(){
      const regexPw = new RegExp(/^[a-zA-Z0-9]{8,}$/)
      return !regexPw.test(this.password);
    }
  }
});