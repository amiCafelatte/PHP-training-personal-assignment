function check() {
    var pattern = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[salto]+.[link]+$/;
    if (document.formCheck.email.value == "") {
        alert("メールアドレスは必須入力です");
        return false;
    } else if (document.formCheck.password.value == "") {
        alert("パスワードは必須入力です");
    } else if (!formCheck.email.value.match(pattern)) {
        alert("saltoアカウントではありません");
        return false;
    } else {
        return true;
    }
    
}
// check();
console.log(check());