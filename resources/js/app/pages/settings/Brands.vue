<template>
  <div>
    <a-page-header title="Marques">
      <template #extra>
        <a-button type="primary" @click="openBrandFormModal(null)">Ajouter</a-button>
      </template>
    </a-page-header>
    <a-table :scroll="{ x: 'max-content' }" class="mx-4" :dataSource="brands" :columns="columns">
      <template #bodyCell="{ column, record }">
        <template v-if="column.key === 'action'">
          <a class="ant-dropdown-link" @click="openBrandFormModal(record)">Modifier</a>
          <a-divider type="vertical"/>
          <a-popconfirm
            title="Voulez vous vraiment supprimer cette marque ?"
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

    <brand-form-modal v-if="brandFormModalVisible" :is-update="brandFormModalIsUpdate" :brand="brandFormModalBrand" :close="closeBrandFormModal" />
  </div>
</template>

<script>
import {defineComponent, computed, onMounted, ref} from "vue";
import {useStore} from "vuex";
import BrandFormModal from "../../components/brands/BrandFormModal";

export default defineComponent({
  components: {
    BrandFormModal
  },
  setup() {
    const store = useStore();
    const brands = computed(() => store.getters['brands/getAllBrands']);
    const brandFormModalVisible = ref(false);
    const brandFormModalIsUpdate = ref(false);
    const brandFormModalBrand = ref({});

    const getAllBrands = () => {
      store.dispatch('brands/getAllBrands');
    };

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

    const confirmDelete = (record) => {
      store.dispatch('brands/deleteBrand', record).then(() => {
        getAllBrands();
      });
    };

    const openBrandFormModal = (brand = null) => {
      if (brand) {
        brandFormModalBrand.value = brand;
        brandFormModalIsUpdate.value = true;
      } else {
        brandFormModalBrand.value = {};
        brandFormModalIsUpdate.value = false;
      }

      brandFormModalVisible.value = true;
    };

    const closeBrandFormModal = () => {
      brandFormModalVisible.value = false;
      getAllBrands();
    };

    onMounted(() => {
      getAllBrands();
    })

    return {
      brands,
      columns,
      brandFormModalVisible,
      brandFormModalIsUpdate,
      brandFormModalBrand,
      confirmDelete,
      openBrandFormModal,
      closeBrandFormModal,
    }
  }
});
</script>
