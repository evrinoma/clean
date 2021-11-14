<template>
  <div class="single-main-page">
    <v-container>
      <div id="dashboard">
        <DashBoard
            :dashBoardData="dashBoardData"
        />
      </div>
    </v-container>
  </div>
</template>

<script>

import axios from "axios";
import DashBoard from "./src/DashBoard"

export default {
  name: "DashboardComponent",
  props: {
    getDashBoardDataURL: {
      type: String,
      default: "",
    },
    updateInterval: {
      type: Number,
      default: 15,
    },
  },
  data: function () {
    return {
      dashBoardData: {
        sysinfo: {},
        procinfo: {}
      },
      timer: '',
    }
  },
  watch: {},
  mounted: function () {
    this.loadData();
    this.timer = setInterval(() => this.loadData(), this.updateInterval * 1000);
  },
  components: {
    DashBoard
  },
  methods: {
    loadData: function () {
      if (!this.getDashBoardDataURL) {
        return false;
      }
      this.$emit("update:isLoading", true);
      return axios
          .get(this.getDashBoardDataURL)
          .then((response) => {
            this.dashBoardData = this.getDashBoardData(response.data);
          })
          .catch(() => {
            console.log(
                "Error - loadData, Url: ",
                this.getDashBoardDataURL
            );
          })
          .finally(() => {
            this.$emit("update:isLoading", false);
          });
    },
    getDashBoardData: function (DataObject) {
      return DataObject.system ? DataObject.system : {};
    },
  }
}
</script>

<style scoped>

</style>