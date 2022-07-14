<template>
  <div>
    <loader-component v-if="loading" />
    <div v-else>
       <a-page-header title="Retours">
        <template #extra>
          <a-button type="primary" @click="openReturnFormModal(null)">Ajouter</a-button>
        </template>
      </a-page-header>
      <a-table :scroll="{ x: 'max-content' }" class="mx-4" :dataSource="returns" :columns="columns">
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'action'">
            <a class="ant-dropdown-link" @click="openReturnFormModal(record)">Modifier</a>
            <a-divider type="vertical"/>
            <a-popconfirm
              title="Voulez vous vraiment supprimer ce retour ?"
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

      <return-form-modal
        v-if="returnFormModalVisible"
        :is-update="returnFormModalIsUpdate"
        :return-entity="returnFormModalReturn"
        :close="closeReturnFormModal"
      />
    </div>
  </div>
</template>

<script>
import {computed, defineComponent, onMounted, ref} from "vue";
import {useStore} from "vuex";
import ReturnFormModal from "../../components/returns/ReturnFormModal";
import LoaderComponent from "../../components/LoaderComponent";

export default defineComponent({
  components: {
    ReturnFormModal,
    LoaderComponent
  },
  setup() {
    const store = useStore();
    const returns = computed(() => store.getters["returns/getAllReturns"]);
    const returnFormModalVisible = ref(false);
    const returnFormModalIsUpdate = ref(false);
    const returnFormModalReturn = ref({});

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

    const getAllReturns = () => {
      loading.value = true;
      store.dispatch("returns/getAllReturns").then(() => {
        loading.value = false;
      });
    };

    const confirmDelete = (record) => {
      store.dispatch("returns/deleteReturn", record).then(() => {
        getAllReturns();
      });
    };

    const openReturnFormModal = (returnEntity = null) => {
      if (returnEntity) {
        returnFormModalIsUpdate.value = true;
        returnFormModalReturn.value = returnEntity;
      } else {
        returnFormModalIsUpdate.value = false;
        returnFormModalReturn.value = {};
      }

      returnFormModalVisible.value = true;
    };

    const closeReturnFormModal = () => {
      returnFormModalVisible.value = false;
      getAllReturns();
    };

    onMounted(() => {
      getAllReturns();
    });

    return {
      returns,
      columns,
      returnFormModalVisible,
      returnFormModalIsUpdate,
      returnFormModalReturn,
      confirmDelete,
      openReturnFormModal,
      closeReturnFormModal,
      loading
    };
  }
});
</script>
