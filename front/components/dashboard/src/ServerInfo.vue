<template>
  <div id="sysinfo-right">
    <div id="sysinfo" class="infobox ui-widget-content  ui-corner-all">
      <h3 class="ui-widget-header  ui-state-default ui-corner-all">Server Info</h3><br>
      <table summary="System Information Table">
        <tbody>
        <tr>
          <th>Host:</th>
          <td>{{ serverInfo.v_host_name }}</td>
        </tr>
        <tr>
          <th>Distro:</th>
          <td>{{ serverInfo.distr }}</td>
        </tr>
        <tr>
          <th>Name:</th>
          <td>{{ serverInfo.distr_name }}</td>
        </tr>
        <tr>
          <th>Kernel:</th>
          <td>{{ serverInfo.kernel }}</td>
        </tr>
        <tr>
          <th>CPU:</th>
          <td v-for="(cpu) in serverInfo.cpu">{{ cpu.model }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "ServerInfo",
  props: {
    serverInfo: {
      type: Object,
      required: true,
    },
  },
};
</script>
