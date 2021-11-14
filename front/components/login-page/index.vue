<template>
  <div class='login-div' :style='BackgroundImage ? "background-image: url(" + BackgroundImage + ")" : ""'>
    <div class='ui center aligned middle aligned grid' style='top: 15vh; position: relative; opacity: 0.85;'>
      <div class='row'>
        <div class='ui placeholder segment'>
          <div class='ui stackable two column center aligned grid'>
            <div class='middle aligned row'>
              <div class='column'>
                <h2 v-if="FormTitle" class='ui teal image header'>
                  <div class='content'>
                    {{ FormTitle }}
                  </div>
                </h2>
                <transition name="fade">
                  <div v-if="MessageVisible" class="ui negative message">
                    <i class="close icon" @click="closeAttention"></i>
                    <div class="header">
                      Attention!
                    </div>
                    <p>{{ ErrorMessage }}</p>
                  </div>
                </transition>
                <LoginForm
                    :SubmitUrl='SubmitUrl'
                    :UserNamePlaceholder="UserNamePlaceholder"
                    :PasswordPlaceholder="PasswordPlaceholder"
                    :RememberLabel="RememberLabel"
                />
              </div>
              <div v-if='FeedbackEmail' class='column'>
                <div class='ui icon header'>
                  <i class='world icon'></i>
                  <div>
                    <div><a :href='"mailto:"+FeedbackEmail' style='color: #1b1b1b'>Does anyone have any questions?</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
require("semantic-ui-css/semantic.min.css");
import LoginForm from "./src/LoginForm";

export default {
  name: "LoginComponent",
  props: {
    SubmitUrl: {
      type: String,
      required: true
    },
    FormTitle: {
      type: String,
      default: ''
    },
    UserNamePlaceholder: {
      type: String,
      default: 'Enter login'
    },
    PasswordPlaceholder: {
      type: String,
      default: 'Enter password'
    },
    RememberLabel: {
      type: String,
      default: 'Remember...'
    },
    BackgroundImage: {
      type: String,
      default: ''
    },
    FeedbackEmail: {
      type: String,
      default: ''
    },
    ErrorMessage: {
      type: String,
      default: ''
    }
  },
  data: function () {
    return {
      MessageVisible: this.ErrorMessage ? true : false
    };
  },
  watch: {
    ErrorMessage: function () {
      this.MessageVisible = this.ErrorMessage.length ? true : false;
    }
  },
  components: {
    LoginForm
  },
  methods: {
    closeAttention: function () {
      this.MessageVisible = false;
    }
  }
}
</script>

<style scoped>
.login-div {
  height: 100%;
  width: 100%;
  position: fixed;
  background: url('./images/default.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}

.fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
{
  opacity: 0;
}
</style>