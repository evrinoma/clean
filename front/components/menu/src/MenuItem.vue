<template>
  <v-list
    :color="Color"
    :outlined="OutLined"
    tile
    class="pa-0"
    :elevation="Elevation"
    :dark="Dark"
  >
    <div
      v-for="(Item, i) in ItemsData"
      :key="'menuitem_' + MenuLevel + '_' + i"
      @click="selectMenuItem(i, Item, $event)"
    >
      <v-menu
        v-if="Item.children && Item.children.length"
        :offset-x="OffsetX"
        :offset-y="OffsetY"
        :left="Left"
        :right="Right"
        :top="Top"
        :bottom="Bottom"
        :open-on-hover="OpenOnHover"
        :close-on-click="CloseOnClick"
        :close-on-content-click="CloseOnContentClick"
      >
        <template v-slot:activator="{ on }">
          <v-list-item v-on="on" :href="Item.uri">
            <v-list-item-icon v-if="Item.icon" class="v-list-item-icon">
              <v-icon>mdi-{{ Item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title v-text="Item.name"></v-list-item-title>
            <v-list-item-icon class="v-list-item-icon">
              <v-icon>mdi-menu-right</v-icon>
            </v-list-item-icon>
          </v-list-item>
        </template>
        <MenuItem
          :Elevation="Elevation"
          :Dark="Dark"
          :Color="Color"
          :OffsetX="OffsetX"
          :OffsetY="OffsetY"
          :Left="Left"
          :Right="Right"
          :Top="Top"
          :Bottom="Bottom"
          :OutLined="OutLined"
          :OpenOnHover="OpenOnHover"
          :MenuLevel="MenuLevel + 1"
          :ItemsData="Item.children"
          :CloseOnClick="CloseOnClick"
          :CloseOnContentClick="CloseOnContentClick"
          @SelectMenuItem="selectMenuItem"
        />
      </v-menu>
      <v-list-item v-else :href="Item.uri">
        <v-list-item-icon v-if="Item.icon" class="v-list-item-icon">
          <v-icon>mdi-{{ Item.icon }}</v-icon>
        </v-list-item-icon>
        <v-list-item-title>{{ Item.name }}</v-list-item-title>
      </v-list-item>
    </div>
  </v-list>
</template>

<script>
import '@mdi/font/css/materialdesignicons.css';
import SelectableMenuItem from "./SelectableMenuItem.js";

export default {
  name: "MenuItem",
  mixins: [SelectableMenuItem],
  props: {
    ItemsData: {
      type: [Array, Object],
      default: () => [],
    },
    MenuLevel: {
      type: [Number, String],
      default: 0,
    },
    Color: {
      type: String,
      default: "",
    },
    Dark: {
      type: Boolean,
      default: false,
    },
    Elevation: {
      type: [Number, String],
      default: 1,
    },
    OutLined: {
      type: Boolean,
      default: false,
    },
    Left: {
      type: Boolean,
      default: false,
    },
    Right: {
      type: Boolean,
      default: false,
    },
    Top: {
      type: Boolean,
      default: false,
    },
    Bottom: {
      type: Boolean,
      default: false,
    },
    OffsetX: {
      type: Boolean,
      default: false,
    },
    OffsetY: {
      type: Boolean,
      default: false,
    },
    OpenOnHover: {
      type: Boolean,
      default: true,
    },
    CloseOnClick: {
      type: Boolean,
      default: true
    },
    CloseOnContentClick: {
      type: Boolean,
      default: true
    },
  },
  methods: {
    newselectMenuItem: function (...args) {
      console.log("newselectMenuItem: ", args);
      return true;
    },
  }
};
</script>

<style scoped>
.v-list-item-icon {
  margin-top: 13px;
  margin-bottom: 13px;
}
</style>
