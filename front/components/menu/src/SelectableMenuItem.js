export default {
  methods: {
    selectMenuItem: function (num, item, data) {
      //console.log("selectMenuItem - {eventid, data}: ", eventid, data);
      this.$emit("SelectMenuItem", num, item, data);
    }
  }
}