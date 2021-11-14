<template>
  <v-row justify="space-between">
    <v-col
        class="py-0"
        cols="auto"
        v-for="(Item, i) in LeftMenu"
        @click.stop="selectMenuItem(i, Item)"
        :key="'left_h_menuitem_' + i"
    >
      <v-menu
          v-if="Item.children && Item.children.length"
          :color="Color"
          :dark="Dark"
          :offset-x="OffsetX"
          :offset-y="OffsetY"
          :left="Left"
          :right="Right"
          :top="Top"
          :bottom="Bottom"
          :open-on-hover="OpenOnHover"
          tile
      >
        <template v-slot:activator="{ on }">
          <v-btn :href="Item.uri" text v-on="on">
            <v-icon v-if="Item.icon">mdi-{{ Item.icon }}</v-icon>
            {{ Item.name }}
            <v-icon v-if="Top">mdi-menu-up</v-icon>
            <v-icon v-else>mdi-menu-down</v-icon>
          </v-btn>
        </template>
        <MenuItem
            MenuLevel="1"
            :ItemsData="Item.children"
            :Color="Color"
            :Dark="Dark"
            Elevation="0"
            @SelectMenuItem="selectMenuItem"
        />
      </v-menu>
      <v-btn
          v-else
          :href="Item.uri"
          :dark="Dark"
          text
          :class="
          Item.attributes && Item.attributes.class ? Item.attributes.class : ''
        "
      >
        <v-icon v-if="Item.icon">mdi-{{ Item.icon }}</v-icon>
        {{ Item.name }}
      </v-btn>
    </v-col>
    <v-spacer />
    <v-col
        class="py-0"
        cols="auto"
        v-for="(Item, i) in RightMenu"
        @click.stop="selectMenuItem(i, Item)"
        :key="'regiht_h_menuitem_' + i"
    >
      <v-menu
          v-if="Item.children && Item.children.length"
          :color="Color"
          :dark="Dark"
          :offset-x="OffsetX"
          :offset-y="OffsetY"
          :left="Left"
          :right="Right"
          :top="Top"
          :bottom="Bottom"
          :open-on-hover="OpenOnHover"
          tile
      >
        <template v-slot:activator="{ on }">
          <v-btn :href="Item.uri" text v-on="on">
            <v-icon v-if="Item.icon">mdi-{{ Item.icon }}</v-icon>
            {{ Item.name }}
            <v-icon v-if="Top">mdi-menu-up</v-icon>
            <v-icon v-else>mdi-menu-down</v-icon>
          </v-btn>
        </template>
        <MenuItem
            MenuLevel="1"
            :ItemsData="Item.children"
            :Color="Color"
            :Dark="Dark"
            Elevation="0"
            @SelectMenuItem="selectMenuItem"
        />
      </v-menu>
      <v-btn
          v-else
          :href="Item.uri"
          :dark="Dark"
          text
          :class="
          Item.attributes && Item.attributes.class ? Item.attributes.class : ''
        "
      >
        <v-icon v-if="Item.icon">mdi-{{ Item.icon }}</v-icon>
        {{ Item.name }}
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>

import MenuItem from "./MenuItem";
import SelectableMenuItem from "./SelectableMenuItem";

/**
 * верхнее меню приложения,
 * этот компонент сам подгружает свои данные из истоника через AJAX-запрос
 */
export default {
  name: "HorizontalMenu",
  mixins: [SelectableMenuItem],
  props: {
    MenuData: {
      type: Array,
      required: true,
    },
    Color: {
      type: String,
      default: "orange",
    },
    Dark: {
      type: Boolean,
      default: true,
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
      default: true,
    },
    OpenOnHover: {
      type: Boolean,
      default: true,
    },
    rightAlignKey: {
      type: String,
      default: "",
    },
  },
  components: {
    MenuItem,
  },
  computed: {
    RightMenu() {
      return this.MenuData.filter((Item) => {
        return (
            "attributes" in Item &&
            "class" in Item.attributes &&
            Item.attributes.class == this.rightAlignKey
        );
      });
    },
    LeftMenu() {
      return this.MenuData.filter((Item) => {
        return (
            !("attributes" in Item) ||
            !("class" in Item.attributes) ||
            Item.attributes.class != this.rightAlignKey
        );
      });
    },
  },
};
</script>
