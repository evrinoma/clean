<template>
  <ul :class="MenuClass">
    <li
      v-for="(MenuItem, i) in MenuData"
      :key="'menuitem_' + MenuLevel + '_' + i"
      @click.stop="selectMenuItem(i, Item)"
    >
      <a v-if="MenuItem.uri" :href="MenuItem.uri">
        {{ MenuItem.name }}
      </a>
      <span v-else>{{ MenuItem.name }}</span>
      <SimpleMenuItem
        v-if="MenuItem.children && MenuItem.children.length"
        :MenuData="MenuItem.children"
        @SelectMenuItem="selectMenuItem"
      />
    </li>
  </ul>
</template>

<script>
import SelectableMenuItem from "./SelectableMenuItem";

export default {
  name: "SimpleMenuItem",
  mixins: [SelectableMenuItem],
  props: {
    MenuLevel: {
      type: [Number, String],
      default: 0,
    },
    MenuData: {
      type: Array,
      required: true,
    },
    MenuClass: {
      type: [String],
      default: "",
    },
  },
};
</script>
