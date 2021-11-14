<template>
  <v-app-bar
      :app="App"
      :color="Color"
      :dark="Dark"
      dense
      flat
  >
    <HorizontalMenu
        :Color="Color"
        :Dark="Dark"
        :MenuData="MenuData"
        Bottom
        :rightAlignKey="rightAlignKey"
        @SelectMenuItem="selectMenuItem"
    />
  </v-app-bar>
</template>

<script>

import axios from "axios";
import HorizontalMenu from "./src/HorizontalMenu";

export default {
  name: "Menu",
  components: {
    HorizontalMenu,
  },
  props: {
    // данные, которые передаются в меню извне,
    // например, для контекстного меню это могут быть данные от объекта на котором нажата правая кнопка
    ExternalData: {},
    // будут использоваться при запросе данных сеню с сервера
    getMenuDataURL: {
      type: String,
      default: "",
    },
    rightAlignKey: {
      type: String,
      default: "logout",
    },
    menuIdentity: {
      type: [Number, String],
      default: "default",
    },
    /**
     * указывает производит ли компонент загрузку данных через AJAX в настоящее время
     */
    isLoading: {
      type: Boolean,
      default: false,
    },
    // для контекстного меню
    MenuX: {
      type: [Number, String],
      default: 0,
    },
    MenuY: {
      type: [Number, String],
      default: 0,
    },
    // указывает нужно ли позиционировать меню относительно приложения (применяется в верхнем, нижнем, левом и правом)
    App: {
      type: Boolean,
      default: false,
    },
    // общие настройки
    Color: {
      type: String,
      default: "",
    },
    Dark: {
      type: Boolean,
      default: false,
    },
    // часть для меню
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
    // часть для Navigator
    Absolute: {
      type: Boolean,
      default: false,
    },
    Fixed: {
      type: Boolean,
      default: false,
    },
    MiniVariant: {
      type: Boolean,
      default: true,
    },
    Permanent: {
      type: Boolean,
      default: true,
    },
    Temporary: {
      type: Boolean,
      default: false,
    },
    ExpandOnHover: {
      type: Boolean,
      default: true,
    },
  },
  data: function () {
    return {
      MenuData: [],
      Mini: this.MiniVariant,
      collapseOnScroll: true,
    };
  },
  watch: {},
  mounted: function () {
    this.loadData(this.menuIdentity);
  },
  methods: {
    /**
     * асинхронный запрос к серверу для получения меню
     * @param {*} id - идентификатор меню, которое нужно получить с сервера,
     * добавляется к this.GetMenuDataURL
     */
    loadData: function (id) {
      if (!this.getMenuDataURL) {
        return false;
      }
      this.$emit("update:isLoading", true);
      return axios
          .get(this.getMenuDataURL + id)
          .then((response) => {
            this.MenuData = this.getValidMenu(response.data);
          })
          .catch(() => {
            console.log(
                "Error - Menu->loadData, Url: ",
                this.getMenuDataURL + id
            );
          })
          .finally(() => {
            this.$emit("update:isLoading", false);
          });
    },
    getValidMenu: function (DataObject) {
      if (DataObject.name && DataObject.name === "root") {
        return DataObject.children ? DataObject.children : [];
      }
      return Array.isArray(DataObject) ? DataObject : [DataObject];
    },
    selectMenuItem: function (num, item, data) {
      if (item.attributes && item.attributes.events) {
        if (Array.isArray(item.attributes.events)) {
          item.attributes.events.forEach((event) => {
            this.$emit(event, {item, data, externaldata: this.ExternalData});
          });
        } else {
          this.$emit(item.attributes.events, {item, data, externaldata: this.ExternalData});
        }
      }
      // всегда генерируется событие select-menu-item
      this.$emit('select_menu_item', {num, item, data, externaldata: this.ExternalData});
    },
  },
};
</script>
