<template>
  <div id="sysinfo-centr">
    <div id="procinfo" class="infobox ui-widget-content  ui-corner-all">
      <h3 class="ui-widget-header  ui-state-default ui-corner-all">Server Status</h3>
      <div class="databox statusbox" v-for="(service) in serviceInfo.service">
        <div class="dataname">{{ service.name }}</div>
        <div v-if="isAvaliable(service.status)" :id="'datavalue_' + service.tag" class="datavalue graphok">
          <a href="#" :title="service.name + 'is running'">{{ service.status }}</a>
        </div>
        <div v-else :id="'datavalue_' + service.tag" class="datavalue grapherror">
          <a href="#" :title="service.name + 'is stop'">{{ service.status }}</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ServiceInfo",
  props: {
    serviceInfo: {
      type: Object,
      required: true,
    },
  },
  methods: {
    isAvaliable(status) {
      return status === 'OK';
    },
  },
};
</script>
