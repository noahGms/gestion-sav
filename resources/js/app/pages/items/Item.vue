<template>
  <div>
    <loader-component v-if="loading" />
    <div v-else>
      <a-alert class="mb-2" v-if="item.archived_at" message="Cet item est archivé" type="warning" />

      <a-page-header :title="`Item n°${item.id} - Détails`" @back="goBack">
        <template #extra>
          <div>
            <a-popconfirm v-if="!item.archived_at" title="Voulez vous vraiment archiver cet item ?" ok-text="Confirmer" cancel-text="Annuler"
              @confirm="archive" @cancel="() => { }">
              <a href="#">Archiver</a>
            </a-popconfirm>
            <a-popconfirm v-else title="Voulez vous vraiment désarchiver cet item ?" ok-text="Confirmer" cancel-text="Annuler"
              @confirm="unarchive" @cancel="() => { }">
              <a href="#">Désarchiver</a>
            </a-popconfirm>
            <a-divider type="vertical" />
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

    const archive = () => {
      store.dispatch('items/archive', id).then(() => {
        getItem();
      });
    }

    const unarchive = () => {
      store.dispatch('items/unarchive', id).then(() => {
        getItem();
      });
    }

    onMounted(() => {
      getItem();
    });

    return {
      goBack,
      item,
      loading,
      confirmDelete,
      unarchive,
      archive
    };
  }
});
</script>
