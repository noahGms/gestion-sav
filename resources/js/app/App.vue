<template>
  <a-layout v-if="isLoggedIn" has-sider style="min-height: 100vh; min-width: 100vw;">
    <a-layout-sider
      :style="{ overflow: 'auto', height: '100vh', position: 'fixed', left: 0, top: 0, bottom: 0, background: '#fff' }"
      breakpoint="lg"
      v-model:collapsed="collapsed"
      :trigger="null"
      collapsible
      collapsedWidth="0"
    >
      <div class="logo p-0">
        {{ collapsed ? "G-SAV" : "Gestion-SAV" }}
      </div>
      <a-menu v-model:selectedKeys="selectedKeys" theme="light" mode="inline">
        <a-menu-item class="mt-0" key="home">
          <template #icon>
            <home-outlined/>
          </template>
          <router-link :to="{ name: 'home' }">
            <span>Acceuil</span>
          </router-link>
        </a-menu-item>
        <a-menu-item class="mt-0" key="items">
          <template #icon>
            <tool-outlined/>
          </template>
          <router-link :to="{ name: 'items' }">
            <span>Items</span>
          </router-link>
        </a-menu-item>
        <a-menu-item class="mt-0" key="customers">
          <template #icon>
            <team-outlined/>
          </template>
          <router-link :to="{ name: 'customers' }">
            <span>Clients</span>
          </router-link>
        </a-menu-item>
        <a-sub-menu v-if="authenticatedUser.is_admin" class="mt-0" key="sub1">
          <template #icon>
            <setting-outlined/>
          </template>
          <template #title>
            <span>Paramètres</span>
          </template>
          <a-menu-item key="usersSettings">
            <router-link :to="{ name: 'usersSettings' }">
              Utilisateurs
            </router-link>
          </a-menu-item>
          <a-menu-item key="statesSettings">
            <router-link :to="{name: 'statesSettings'}">
              Etats
            </router-link>
          </a-menu-item>
          <a-menu-item key="brandsSettings">
            <router-link :to="{name: 'brandsSettings'}">
              Marques
            </router-link>
          </a-menu-item>
          <a-menu-item key="categoriesSettings">
            <router-link :to="{name: 'categoriesSettings'}">
              Catégories
            </router-link>
          </a-menu-item>
          <a-menu-item key="typesSettings">
            <router-link :to="{name: 'typesSettings'}">
              Types
            </router-link>
          </a-menu-item>
          <a-menu-item key="returnsSettings">
            <router-link :to="{name: 'returnsSettings'}">
              Retours
            </router-link>
          </a-menu-item>
          <a-menu-item key="interventionsSettings">
            <router-link :to="{name: 'interventionsSettings'}">
              Interventions
            </router-link>
          </a-menu-item>
          <a-menu-item key="depotsSettings">
            <router-link :to="{name: 'depotsSettings'}">
              Dépôts
            </router-link>
          </a-menu-item>
        </a-sub-menu>
      </a-menu>
    </a-layout-sider>
    <a-layout :class="layoutHeaderClass">
      <a-layout-header :style="{ position: 'fixed', zIndex: 1, background: '#fff', padding: '0' }">
        <div :class="`d-flex justify-content-between align-items-center ${headerContentClass}`">
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
              <a-avatar
                class="me-1"
                :src="avatarUrl"
              />
              <DownOutlined/>
            </a>
            <template #overlay>
              <a-menu>
                <a-menu-item key="0">
                  <router-link :to="{name: 'profile'}">
                    Mon compte
                  </router-link>
                </a-menu-item>
                <a-menu-divider/>
                <a-menu-item key="1" @click="() => logout()">
                  Se déconnecter
                </a-menu-item>
              </a-menu>
            </template>
          </a-dropdown>
        </div>
      </a-layout-header>
      <a-layout-content class="layout-content">
        <div :style="{ padding: '24px', background: '#fff' }">
          <router-view/>
        </div>
      </a-layout-content>
      <a-layout-footer class="text-center">
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
  <a-layout v-else style="min-height: 100vh; min-width: 100vw">
    <a-layout-content>
      <router-view/>
    </a-layout-content>
  </a-layout>
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
import {defineComponent, ref, computed, onMounted} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";

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
    const route = useRoute();
    const isLoggedIn = computed(() => store.getters["auth/isLoggedIn"]);
    const authenticatedUser = computed(() => store.getters["auth/getAuthenticatedUser"]);

    const collapsed = ref(false);
    const selectedKeys = ref([]);

    const avatarUrl = computed(() => {
      if (authenticatedUser.value.avatar) {
        return 'http://localhost:8000/api/profile/avatar';
      } else {
        return `https://eu.ui-avatars.com/api/?name=${authenticatedUser.fullname}`;
      }
    });


    const layoutHeaderClass = computed(() => {
      if (collapsed.value) {
        return 'layout-header-mobile';
      } else {
        return 'layout-header'
      }
    });

    const headerContentClass = computed(() => {
      if (collapsed.value) {
        return 'header-content-mobile';
      } else {
        return 'header-content'
      }
    });

    const logout = () => {
      store.dispatch("auth/logout").finally(() => {
        router.push("/se-connecter");
      });
    };

    onMounted(async () => {
      await router.isReady();
      selectedKeys.value = [route.name];
    });

    return {
      collapsed,
      selectedKeys,
      logout,
      isLoggedIn,
      authenticatedUser,
      layoutHeaderClass,
      headerContentClass,
      avatarUrl
    };
  },
});
</script>

<style>
.layout-header {
  margin-left: 200px;
}

.layout-header-mobile {
  margin-left: 0;
}

.header-content {
  width: calc(100vw - 200px);
  padding: 0 50px;
}

.header-content-mobile {
  width: 100vw;
  padding: 0 50px;
}

.layout-content {
  margin: 64px 0;
  padding: 16px;
  overflow: initial;
}

/* .layout-content {
  margin: 64px 16px 0;
  padding: 24px;
  overflow: initial;
} */
</style>
