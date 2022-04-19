<template>
  <div>
    <a-layout v-if="isLoggedIn" style="min-height: 100vh; min-width: 100vh">
      <a-layout-sider
        breakpoint="lg"
        style="background: #fff"
        v-model:collapsed="collapsed"
        :trigger="null"
        collapsible
      >
        <div class="logo p-0">
          {{ collapsed ? "G-SAV" : "Gestion-SAV" }}
        </div>
        <a-menu v-model:selectedKeys="selectedKeys" theme="light" mode="inline">
          <a-menu-item class="mt-0" key="1">
            <template #icon>
              <home-outlined />
            </template>
            <span>Acceuil</span>
          </a-menu-item>
          <a-menu-item class="mt-0" key="2">
            <template #icon>
              <tool-outlined />
            </template>
            <span>Items</span>
          </a-menu-item>
          <a-menu-item class="mt-0" key="3">
            <template #icon>
              <team-outlined />
            </template>
            <span>Clients</span>
          </a-menu-item>
          <a-sub-menu class="mt-0" key="sub1">
            <template #icon>
              <setting-outlined />
            </template>
            <template #title>
              <span>Paramètres</span>
            </template>
            <a-menu-item key="4">Utilisateurs</a-menu-item>
            <a-menu-item key="5">Etats</a-menu-item>
            <a-menu-item key="6">Marques</a-menu-item>
            <a-menu-item key="7">Catégories</a-menu-item>
            <a-menu-item key="8">Types</a-menu-item>
            <a-menu-item key="9">Retours</a-menu-item>
            <a-menu-item key="10">Interventions</a-menu-item>
            <a-menu-item key="11">Dépots</a-menu-item>
          </a-sub-menu>
        </a-menu>
      </a-layout-sider>
      <a-layout>
        <a-layout-header
          class="d-flex justify-content-between align-items-center"
          style="background: #fff; padding-left: 24px"
        >
          <menu-unfold-outlined
            :style="{ fontSize: '16px' }"
            v-if="collapsed"
            class="trigger"
            @click="() => (collapsed = !collapsed)"
          />
          <menu-fold-outlined
            v-else
            class="trigger"
            :style="{ fontSize: '16px' }"
            @click="() => (collapsed = !collapsed)"
          />
          <a-dropdown :trigger="['click']" placement="bottomRight">
            <a class="ant-dropdown-link" @click.prevent>
              <a-avatar src="https://eu.ui-avatars.com/api/?name=jean" />
              <DownOutlined />
            </a>
            <template #overlay>
              <a-menu>
                <a-menu-item key="0"> Mon compte </a-menu-item>
                <a-menu-divider />
                <a-menu-item key="1" @click="() => logout()">
                  Se déconnecter
                </a-menu-item>
              </a-menu>
            </template>
          </a-dropdown>
        </a-layout-header>
        <a-layout-content style="margin: 16px 16px">
          <div
            :style="{ padding: '24px', background: '#fff', minHeight: '360px' }"
          >
            <router-view />
          </div>
        </a-layout-content>
        <a-layout-footer style="text-align: center">
          <p>
            <strong>&copy Gestion S.A.V</strong> par
            <a href="https://github.com/noahGms" target="_blank">Noah</a> pour
            <a
              href="http://www.procie-amberieu-en-bugey.com/mon-magasin.html"
              target="_blank"
              >Pro&Cie - MDH services</a
            >. Tous droits réservés
          </p>
        </a-layout-footer>
      </a-layout>
    </a-layout>
    <a-layout v-else style="min-height: 100vh; min-width: 100vh">
      <a-layout-content>
        <router-view />
      </a-layout-content>
    </a-layout>
  </div>
</template>
<script>
import {
  MenuUnfoldOutlined,
  SettingOutlined,
  HomeOutlined,
  TeamOutlined,
  ToolOutlined,
  DownOutlined,
  MenuFoldOutlined,
} from "@ant-design/icons-vue";
import { defineComponent, ref, computed } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

export default defineComponent({
  components: {
    HomeOutlined,
    SettingOutlined,
    TeamOutlined,
    ToolOutlined,
    DownOutlined,
    MenuUnfoldOutlined,
    MenuFoldOutlined,
  },
  setup() {
    const store = useStore();
    const router = useRouter();
    const isLoggedIn = computed(() => store.getters["auth/isLoggedIn"]);

    const collapsed = ref(false);
    const selectedKeys = ref(["1"]);

    const logout = () => {
      store.dispatch("auth/logout").finally(() => {
        router.push("/se-connecter");
      });
    };

    return {
      collapsed,
      selectedKeys,
      logout,
      isLoggedIn,
    };
  },
});
</script>