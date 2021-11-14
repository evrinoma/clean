<template>
  <v-app>
    <v-main>
      <Menu
          :menuIdentity="Settings.MENU_DEFAULT_IDENTITY"
          App
          Dark
          :Color="Settings.MENU_DEFAULT_COLOR"
          OffsetY
          Top
          :getMenuDataURL="Settings.MENU_GET_DATA_URL"
          :rightAlignKey="Settings.MENU_RIGHT_ALIGN_KEY"
      />
      <DashboardComponent v-if="showDashBoardComponent"
          :getDashBoardDataURL="Settings.DASHBOARD_GET_DATA_URL"
      />
    </v-main>
  </v-app>
</template>

<script>

import {GlobalSettings} from './config/settings.js';
import Menu from "./components/menu";
import DashboardComponent from "./components/dashboard";

export default {
  name: "App",
  props: {
    showDashBoardComponent: {
      type: Boolean,
      default: false,
    },
  },
  data: function () {
    return {
      Loaders: [],
      Settings: GlobalSettings,
    };
  },
  computed: {
  },
  mounted: function () {
  },
  methods: {
  },
  components: {
    Menu,
    DashboardComponent
  },
};
</script>

<style>
</style>
