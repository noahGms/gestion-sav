<template>
  <div>
    <loader-component v-if="loading" />
    <div v-else>
      <a-page-header title="Catégories">
        <template #extra>
          <a-button type="primary" @click="openCategoryFormModal(null)">Ajouter</a-button>
        </template>
      </a-page-header>
      <a-table :scroll="{ x: 'max-content' }" class="mx-4" :dataSource="categories" :columns="columns">
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'action'">
            <a class="ant-dropdown-link" @click="openCategoryFormModal(record)">Modifier</a>
            <a-divider type="vertical"/>
            <a-popconfirm
              title="Voulez vous vraiment supprimer cette catégorie ?"
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

      <category-form-modal v-if="categoryFormModalVisible" :is-update="categoryFormModalIsUpdate" :category="categoryFormModalCategory" :close="closeCategoryFormModal" />
    </div>
  </div>
</template>

<script>
import {computed, defineComponent, onMounted, ref} from "vue";
import {useStore} from "vuex";
import CategoryFormModal from "../../components/categories/CategoryFormModal";
import LoaderComponent from "../../components/LoaderComponent";

export default defineComponent({
  components: {
    CategoryFormModal,
    LoaderComponent
  },
  setup() {
    const store = useStore();
    const categories = computed(() => store.getters['categories/getAllCategories']);
    const categoryFormModalVisible = ref(false);
    const categoryFormModalIsUpdate = ref(false);
    const categoryFormModalCategory = ref({});

    const loading = ref(false);

    const columns = [
      {
        title: "Nom",
        dataIndex: "name",
        key: "name",
      },
      {
        'title': 'Action',
        'key': 'action',
      }
    ];

    const openCategoryFormModal = (category = null) => {
      if (category) {
        categoryFormModalIsUpdate.value = true;
        categoryFormModalCategory.value = category;
      } else {
        categoryFormModalIsUpdate.value = false;
        categoryFormModalCategory.value = {};
      }

      categoryFormModalVisible.value = true;
    };

    const closeCategoryFormModal = () => {
      categoryFormModalVisible.value = false;
      getAllCategories();
    };

    const confirmDelete = (record) => {
      store.dispatch('categories/deleteCategory', record).then(() => {
        getAllCategories();
      });
    };

    const getAllCategories = () => {
      loading.value = true;
      store.dispatch('categories/getAllCategories').then(() => {
        loading.value = false;
      });
    };

    onMounted(() => {
      getAllCategories();
    });

    return {
      categories,
      columns,
      categoryFormModalVisible,
      categoryFormModalIsUpdate,
      categoryFormModalCategory,
      confirmDelete,
      openCategoryFormModal,
      closeCategoryFormModal,
      loading
    };
  },
})
</script>
