<template>
  <div>
    <a-page-header title="Ajouter un item" @back="goBack"></a-page-header>

    <div class="mx-4">
      <ItemForm
        :is-create="true"
      />
    </div>
  </div>
</template>

<script>
import {computed, defineComponent, onMounted} from 'vue';
import { useRouter } from 'vue-router';
import ItemForm from '../../components/items/ItemForm';
import {useStore} from "vuex";

export default defineComponent({
  components: {
    ItemForm,
  },
  setup() {
    const store = useStore();
    const router = useRouter();

    const goBack = () => {
      router.go(-1);
    };

    onMounted(() => {
    });

    return {
      goBack,
    };
  },
})
</script>
