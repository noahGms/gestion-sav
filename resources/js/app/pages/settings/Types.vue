<template>
  <div>
    <loader-component v-if="loading" />
    <div v-else>
      <a-page-header title="Types">
        <template #extra>
          <a-button type="primary" @click="openTypeFormModal(null)">Ajouter</a-button>
        </template>
      </a-page-header>
      <a-table :scroll="{ x: 'max-content' }" class="mx-4" :dataSource="types" :columns="columns">
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'category'">
            <span>{{record.category?.name}}</span>
          </template>
          <template v-else-if="column.key === 'action'">
            <a class="ant-dropdown-link" @click="openTypeFormModal(record)">Modifier</a>
            <a-divider type="vertical"/>
            <a-popconfirm
              title="Voulez vous vraiment supprimer ce type ?"
              ok-text="Confirmer"
              cancel-text="Annuler"
              @confirm="confirmDelete(record)"
              @cancel="() => {}"
            >
              <a class="text-danger" href="#">Supprimer</a>
            </a-popconfirm>
          </template>
        </template>
      </a-table>

      <type-form-modal
        v-if="typeFormModalVisible"
        :is-update="typeFormModalIsUpdate"
        :type="typeFormModalType"
        :close="closeTypeFormModal"
        :categories="categories"
      />
    </div>
  </div>
</template>

<script>
import {computed, defineComponent, onMounted, ref} from "vue";
import {useStore} from "vuex";
import TypeFormModal from "../../components/types/TypeFormModal";
import LoaderComponent from "../../components/LoaderComponent";

export default defineComponent({
  components: {
    TypeFormModal,
    LoaderComponent
  },
  setup() {
    const store = useStore();
    const types = computed(() => store.getters['types/getAllTypes']);
    const categories = computed(() => store.getters['categories/getAllCategories']);
    const typeFormModalVisible = ref(false);
    const typeFormModalIsUpdate = ref(false);
    const typeFormModalType = ref({});

    const loading = ref(false);

    const columns = [
      {
        title: "Nom",
        dataIndex: "name",
        key: "name",
      },
      {
        title: "Catégorie",
        dataIndex: "category",
        key: "category",
      },
      {
        'title': 'Action',
        'key': 'action',
      }
    ];

    const getAllTypes = () => {
      loading.value = true;
      store.dispatch('types/getAllTypes').then(() => {
        loading.value = false;
      });
    };

    const confirmDelete = (record) => {
      store.dispatch('types/deleteType', record).then(() => {
        getAllTypes();
      });
    };

    const openTypeFormModal = (type = null) => {
      if (type) {
        typeFormModalType.value = type;
        typeFormModalIsUpdate.value = true;
      } else {
        typeFormModalType.value = {};
        typeFormModalIsUpdate.value = false;
      }

      typeFormModalVisible.value = true;
    };

    const closeTypeFormModal = () => {
      typeFormModalVisible.value = false;
      getAllTypes();
    };

    onMounted(() => {
      getAllTypes();

      if (categories.value.length === 0) {
        store.dispatch('categories/getAllCategories');
      }
    });

    return {
      types,
      categories,
      columns,
      typeFormModalVisible,
      typeFormModalIsUpdate,
      typeFormModalType,
      confirmDelete,
      openTypeFormModal,
      closeTypeFormModal,
      loading
    };
  },
})
</script>
