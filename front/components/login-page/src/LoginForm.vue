<template>
  <form class="ui form" :action="SubmitUrl" method="post">
    <div class="field">
      <div class="ui left icon input">
        <i class="user icon"></i>
        <input type="text" id="username" name="_username" :placeholder="UserNamePlaceholder" v-model="UserName">
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
        <i class="lock icon"></i>
        <input type="password" id="password" name="_password" :placeholder="PasswordPlaceholder">
      </div>
    </div>
    <div class="field">
      <div class="ui checkbox">
        <input type="checkbox" id="remember_me" name="_remember_me" tabindex="0">
        <label>{{ RememberLabel }}</label>
      </div>
    </div>
    <button class="ui button" type="submit">{{ LoginButtonLabel }}</button>
  </form>
</template>

<script>
export default {
  name: "LoginForm",
  props: {
    UserNamePlaceholder: {
      type: String,
      default: "Enter login"
    },
    PasswordPlaceholder: {
      type: String,
      default: "Enter password"
    },
    SubmitUrl: {
      type: String,
      default: ""
    },
    LastUserName: {
      type: String,
      default: ""
    },
    RememberLabel: {
      type: String,
      default: "Remember me"
    },
    LoginButtonLabel: {
      type: String,
      default: "Login"
    }
  },
  data: function () {
    return {
      UserName: this.LastUserName
    };
  }
}
</script>