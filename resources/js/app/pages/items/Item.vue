<template>
  <div>
    <loader-component v-if="loading" />
    <div v-else>
      <a-page-header :title="`Item n°${item.id} - Détails`" @back="goBack">
        <template #extra>
          <div>
            <router-link :to="{ name: 'editItem', params: { id: item.id } }" class="ant-dropdown-link">Modifier
            </router-link>
            <a-divider type="vertical" />
            <a-popconfirm title="Voulez vous vraiment supprimer cet item ?" ok-text="Confirmer" cancel-text="Annuler"
              @confirm="confirmDelete" @cancel="() => { }">
              <a class="text-danger" href="#">Supprimer</a>
            </a-popconfirm>
          </div>
        </template>
      </a-page-header>
    </div>
  </div>
</template>

<script>
import { defineComponent, onMounted, ref } from "vue";
import LoaderComponent from "../../components/LoaderComponent";
import { useStore } from "vuex";
import { useRouter, useRoute } from "vue-router";

export default defineComponent({
  components: {
    LoaderComponent
  },
  setup() {
    const store = useStore();
    const route = useRoute();
    const router = useRouter();

    const { id } = route.params;

    const item = ref(null);
    const loading = ref(true);

    const getItem = () => {
      loading.value = true;
      store.dispatch('items/getOneItem', id).then(response => {
        item.value = response.data.data;
        loading.value = false;
      }).catch(() => {
        goBack();
      });
    }

    const confirmDelete = () => {
      store.dispatch('items/deleteItem', id).then(() => {
        router.push({ name: 'items' });
      });
    }

    const goBack = () => {
      router.go(-1);
    }

    onMounted(() => {
      getItem();
    });

    return {
      goBack,
      item,
      loading,
      confirmDelete
    };
  }
});
</script>
