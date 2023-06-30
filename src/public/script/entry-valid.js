new Vue({
  el: '#app',
  data(){
    return {
      seiKana:'',
      meiKana:'',
      email: '',
      password :''
    };
  },
  computed:{
    // isInValidFirstKana(){
    //   const regexKana = newRexExp(/^[ァ-ヶー ]+$/)
    //   return !regexKana.test(this.seiKana);
    // },
    // isInValidLastMei(){
    //   const regexMei = newRexExp(/^[ァ-ヶー ]+$/)
    //   return !regexMei.test(this.meiKana);
    // },
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