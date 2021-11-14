export default {
  data: function() {
    return {
      ContextMenuVisible: false,
      ContextMenuX: 0,
      ContextMenuY: 0
    };
  },
  methods: {
    showContextMenu: function (e) {
      //let Rect = this.$el.getBoundingClientRect();

      this.ContextMenuVisible = false;
      this.ContextMenuX = e.clientX;// - Rect.left; // e.layerX;
      this.ContextMenuY = e.clientY;// - Rect.top; // e.layerY;
      this.$el.addEventListener('click', this.closeContextMenu );
      this.$nextTick(() => {
          this.ContextMenuVisible = true;
      });
    },
    closeContextMenu: function() {
      this.ContextMenuVisible = false;
      this.$el.removeEventListener('click', this.closeContextMenu );
    }
  }
}

