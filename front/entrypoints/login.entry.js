import {GlobalSettings} from '../config/settings.js';
import Vue from 'vue';
import LoginComponent from '../components/login-page';

LoginComponent.props.FeedbackEmail.default = GlobalSettings.LOGIN_FEEDBACK_EMAIL ? GlobalSettings.LOGIN_FEEDBACK_EMAIL : "";
LoginComponent.props.BackgroundImage.default = GlobalSettings.LOGIN_BACKGROUND_IMAGE ? GlobalSettings.LOGIN_BACKGROUND_IMAGE : "";
LoginComponent.props.FormTitle.default = GlobalSettings.LOGIN_FORM_TITLE ? GlobalSettings.LOGIN_FORM_TITLE : "Welcome";

Vue.component("login-component", LoginComponent);
new Vue({el: '#login-div'});
