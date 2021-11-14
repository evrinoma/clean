<template>
  <div>
    <Info
        :infoData="dashBoardData.sysinfo"
    />
    <ServerInfo
        :serverInfo="dashBoardData.sysinfo"
    />
    <ServiceInfo
        :serviceInfo="dashBoardData.procinfo"
    />
  </div>
</template>

<script>

import '@public/bundles/evrinomadashboard/css/status/status.css';
//import '@vendor/evrinoma/dashboard-bundle/src/Resources/public/css/status/status.css';
//#import '../../../../public/bundles/evrinomadashboard/css/status/status.css';
//#import '../../../../vendor/evrinoma/dashboard-bundle/src/Resources/public/css/status/status.css';
import ServerInfo from "./ServerInfo"
import ServiceInfo from "./ServiceInfo"
import Info from "./Info"

export default {
  name: "DashBoard",
  props: {
    dashBoardData: {
      type: Object,
      required: true,
    },
  },
  components: {
    ServerInfo,
    ServiceInfo,
    Info
  },
};
</script>
