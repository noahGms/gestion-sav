<template>
  <div>
    <loader-component v-if="loading" />
    <div v-else>
      <a-page-header :title="`Item n°${item.id} - Modifier`" @back="goBack" />
      <div class="mx-4">
        <ItemForm :is-create="false" :item="item" />
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";
import LoaderComponent from "../../components/LoaderComponent";
import ItemForm from "../../components/items/ItemForm";

export default defineComponent({
  components: {
    LoaderComponent,
    ItemForm
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

    const goBack = () => {
      router.go(-1);
    }

    onMounted(() => {
      getItem();
    });

    return {
      loading,
      item,
      goBack
    };
  }
});
</script>
