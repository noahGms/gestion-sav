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
          <a-menu-item class="mt-0" key="home">
            <template #icon>
              <home-outlined/>
            </template>
            <router-link :to="{ name: 'home' }">
              <span>Acceuil</span>
            </router-link>
          </a-menu-item>
          <a-menu-item class="mt-0" key="2">
            <template #icon>
              <tool-outlined/>
            </template>
            <span>Items</span>
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
      <a-layout>
        <a-layout-header
          class="
            d-flex
            justify-content-between
            align-items-center
            ps-3
            bg-white
          "
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
              <a-avatar
                class="me-1"
                :src="`https://eu.ui-avatars.com/api/?name=${authenticatedUser.fullname}`"
              />
              <DownOutlined/>
            </a>
            <template #overlay>
              <a-menu>
                <a-menu-item key="0"> Mon compte</a-menu-item>
                <a-menu-divider/>
                <a-menu-item key="1" @click="() => logout()">
                  Se déconnecter
                </a-menu-item>
              </a-menu>
            </template>
          </a-dropdown>
        </a-layout-header>
        <a-layout-content class="m-3">
          <div class="p-4 bg-white" :style="{ minHeight: '360px' }">
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
    <a-layout v-else style="min-height: 100vh; min-width: 100vh">
      <a-layout-content>
        <router-view/>
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
    };
  },
});
</script>
