<template>
  <div id="sysinfo-left">
    <div id="sysstats" class="infobox ui-widget-content  ui-corner-all">
      <h3 v-if="infoData.page_name" class="ui-widget-header  ui-state-default ui-corner-all">{{ infoData.page_name }}</h3>
      <h4>Processor</h4>
      <div class="databox" v-if="infoData.load_avg" :title="'Load Average:' + infoData.load_avg.load_ave1">
        <div class="dataname">Load Average 1 min</div>
        <div class="bargraph graphok" :style="'width:' + infoData.load_avg.load_ave1 + 'px'"></div>
        <div class="datavalue"><a href="#" :title="'Load Average:' + infoData.load_avg.load_ave1">{{ infoData.load_avg.load_ave1 }}</a></div>
      </div>
      <div class="databox" v-if="infoData.load_avg" :title="'Load Average:' + infoData.load_avg.load_ave5">
        <div class="dataname">Load Average 5 min</div>
        <div class="bargraph graphok" :style="'width:' + infoData.load_avg.load_ave5 + 'px'"></div>
        <div class="datavalue"><a href="#" :title="'Load Average:' + infoData.load_avg.load_ave5">{{ infoData.load_avg.load_ave5 }}</a></div>
      </div>
      <div class="databox" v-if="infoData.load_avg" :title="'Load Average:' + infoData.load_avg.load_ave15">
        <div class="dataname">Load Average 15 min</div>
        <div class="bargraph graphok" :style="'width:' + infoData.load_avg.load_ave15 + 'px'"></div>
        <div class="datavalue"><a href="#" :title="'Load Average:' + infoData.load_avg.load_ave15">{{ infoData.load_avg.load_ave15 }}</a></div>
      </div>
      <div class="databox graphbox" v-if="infoData.load_avg" :title="'CPU:' + calcLoadCpu(
              infoData.load_avg.user_cpu_last,
              infoData.load_avg.nice_cpu_last,
              infoData.load_avg.system_cpu_last,
              infoData.load_avg.idle_cpu_last,
              infoData.load_avg.user_cpu_next,
              infoData.load_avg.nice_cpu_next,
              infoData.load_avg.system_cpu_next,
              infoData.load_avg.idle_cpu_next
              ) + '/ 100 (' +
                  getPercent(
                      calcLoadCpu(
                        infoData.load_avg.user_cpu_last,
                        infoData.load_avg.nice_cpu_last,
                        infoData.load_avg.system_cpu_last,
                        infoData.load_avg.idle_cpu_last,
                        infoData.load_avg.user_cpu_next,
                        infoData.load_avg.nice_cpu_next,
                        infoData.load_avg.system_cpu_next,
                        infoData.load_avg.idle_cpu_next
                     )
              ) + ')%'">
        <div class="bargraph graphok" :style="'width:'
             +
                  getPercent(
                      calcLoadCpu(
                        infoData.load_avg.user_cpu_last,
                        infoData.load_avg.nice_cpu_last,
                        infoData.load_avg.system_cpu_last,
                        infoData.load_avg.idle_cpu_last,
                        infoData.load_avg.user_cpu_next,
                        infoData.load_avg.nice_cpu_next,
                        infoData.load_avg.system_cpu_next,
                        infoData.load_avg.idle_cpu_next
                     )
              ) + 'px'"></div>
        <div class="dataname">CPU</div>
        <div class="datavalue">{{
            getPercent(
                calcLoadCpu(
                    infoData.load_avg.user_cpu_last,
                    infoData.load_avg.nice_cpu_last,
                    infoData.load_avg.system_cpu_last,
                    infoData.load_avg.idle_cpu_last,
                    infoData.load_avg.user_cpu_next,
                    infoData.load_avg.nice_cpu_next,
                    infoData.load_avg.system_cpu_next,
                    infoData.load_avg.idle_cpu_next
                )
            )
          }}%
        </div>
      </div>
      <h4>Memory</h4>
      <div class="databox graphbox" v-if="infoData.memory" :title="'App Memory:' + calcRamApp(
                      infoData.memory.mem_total,
                      infoData.memory.mem_free,
                      infoData.memory.cached,
                      infoData.memory.buffers
              ) + '/ 100 (' +
                  getPercent(
                      calcRamApp(
                      infoData.memory.mem_total,
                      infoData.memory.mem_free,
                      infoData.memory.cached,
                      infoData.memory.buffers
                     )
              ) + ')%'">
        <div class="bargraph graphok" :style="'width:'
             +
                  getPercent(
                      calcRamApp(
                      infoData.memory.mem_total,
                      infoData.memory.mem_free,
                      infoData.memory.cached,
                      infoData.memory.buffers
                     )
              ) + 'px'"></div>
        <div class="dataname">App Memory</div>
        <div class="datavalue">{{
            getPercent(
                calcRamApp(
                    infoData.memory.mem_total,
                    infoData.memory.mem_free,
                    infoData.memory.cached,
                    infoData.memory.buffers
                )
            )
          }}%
        </div>
      </div>

      <div class="databox graphbox" v-if="infoData.memory" :title="'Swap:' + getSwapUsed(
                    infoData.memory.swap_total,
                    infoData.memory.swap_free,
                    infoData.memory.size,
              ) + '/ 100 (' +
                  getPercent(
                      calcRamSwap(
                    infoData.memory.swap_total,
                    infoData.memory.swap_free,
                    infoData.memory.size,
                     )
              ) + ')%'">
        <div class="bargraph graphok" v-if="infoData.memory" :style="'width:'
             +
                  getPercent(
                      calcRamSwap(
                    infoData.memory.swap_total,
                    infoData.memory.swap_free,
                    infoData.memory.size,
                     )
              ) + '%'"></div>
        <div class="dataname">Swap</div>
        <div class="datavalue" v-if="infoData.memory">{{
            getPercent(
                calcRamSwap(
                    infoData.memory.swap_total,
                    infoData.memory.swap_free,
                    infoData.memory.size,
                )
            )
          }}%
        </div>
      </div>
      <h4>Disks</h4>
      <div class="databox graphbox" v-for="(disk) in infoData.disk" :title="disk.name + ': ' +  disk.used + '/ ' + disk.total + '(' +
                  getPercent(
                calcDisk(
                    disk.total,
                    disk.used
                )
              ) + '%)'">
        <div class="bargraph graphok" :style="'width:' + getPercent(
                calcDisk(
                    disk.total,
                    disk.used
                )
            ) + '%'"></div>
        <div class="dataname">{{ disk.mount }}</div>
        <div class="datavalue">{{
            getPercent(
                calcDisk(
                    disk.total,
                    disk.used
                )
            )
          }}%
        </div>
      </div>
      <h4>Networks</h4>
      <div v-for="(item) in infoData.network">
        <div class="databox">
          <div class="dataname">{{ item.name }} receive</div>
          <div class="datavalue"><a href="#" :title="item.Name + ' receive: ' +  toMegaByte(item.rx_bytes) + 'MB/s'">{{ toMegaByte(item.rx_bytes) }}MB/s</a></div>
        </div>
        <div class="databox">
          <div class="dataname">{{ item.name }} transmit</div>
          <div class="datavalue"><a href="#" :title="item.Name + ' transmit: ' +  toMegaByte(item.tx_bytes) + 'MB/s'">{{ toMegaByte(item.tx_bytes) }}MB/s</a></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Info",
  props: {
    infoData: {
      type: Object,
      required: true,
    },
  },
  methods: {
    getPercent(value) {
      return Math.round(100 * value);
    },
    calcLoadCpu(userCpuLast, niceCpuLast, systemCpuLast, idleCpuLast, userCpuNext, niceCpuNext, systemCpuNext, idleCpuNext) {
      let loadLast = userCpuLast + niceCpuLast + systemCpuLast;
      let totalLast = loadLast + idleCpuLast;

      let loadNext = userCpuNext + niceCpuNext + systemCpuNext;
      let totalNext = loadNext + idleCpuNext;

      return (totalNext !== totalLast) ? (loadNext - loadLast) / (totalNext - totalLast) : 0;
    },
    getRamApp(memTotal, memFree, cached, buffers) {
      return memTotal - memFree - cached - buffers;
    },
    calcRamApp(memTotal, memFree, cached, buffers) {
      return memTotal ? this.getRamApp(memTotal, memFree, cached, buffers) / memTotal : 0;
    },
    getSwapFree(swapFree, size) {
      return swapFree / size;
    },
    getSwapTotal(swapTotal, size) {
      return swapTotal / size;
    },
    getSwapUsed(swapTotal, swapFree, size) {
      return this.getSwapTotal(swapTotal, size) - this.getSwapFree(swapFree, size);
    },
    calcRamSwap(swapTotal, swapFree, size) {
      let sTotal = this.getSwapTotal(swapTotal, size);
      let sFree = this.getSwapFree(swapFree, size);

      return (sTotal) ? sFree / sTotal : 0;
    },
    calcDisk(total, used) {
      return (total) ? used / total : 0;
    },
    toMegaByte(value) {
      return Math.round(value/1000);
    }
  },
};
</script>
