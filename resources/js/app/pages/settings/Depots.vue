<template>
  <div>
    <a-page-header title="Dépôts">
      <template #extra>
        <a-button type="primary" @click="openDepotFormModal(null)">Ajouter</a-button>
      </template>
    </a-page-header>
    <a-table :scroll="{ x: 'max-content' }" class="mx-4" :dataSource="depots" :columns="columns">
      <template #bodyCell="{ column, record }">
        <template v-if="column.key === 'action'">
          <a class="ant-dropdown-link" @click="openDepotFormModal(record)">Modifier</a>
          <a-divider type="vertical"/>
          <a-popconfirm
            title="Voulez vous vraiment supprimer ce dépôt ?"
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

    <depot-form-modal
      v-if="depotFormModalVisible"
      :is-update="depotFormModalIsUpdate"
      :depot="depotFormModalDepot"
      :close="closeDepotFormModal"
    />
  </div>
</template>

<script>
import {computed, defineComponent, onMounted, ref} from "vue";
import {useStore} from "vuex";
import DepotFormModal from "../../components/depots/DepotFormModal";

export default defineComponent({
  components: {
    DepotFormModal,
  },
  setup() {
    const store = useStore();
    const depots = computed(() => store.getters['depots/getAllDepots']);
    const depotFormModalVisible = ref(false);
    const depotFormModalIsUpdate = ref(false);
    const depotFormModalDepot = ref({});

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

    const getAllDepots = () => {
      store.dispatch('depots/getAllDepots');
    };

    const confirmDelete = (record) => {
      store.dispatch('depots/deleteDepot', record).then(() => {
        getAllDepots();
      });
    };

    const openDepotFormModal = (depot = null) => {
      if (depot) {
        depotFormModalIsUpdate.value = true;
        depotFormModalDepot.value = depot;
      } else {
        depotFormModalIsUpdate.value = false;
        depotFormModalDepot.value = {};
      }

      depotFormModalVisible.value = true;
    };

    const closeDepotFormModal = () => {
      depotFormModalVisible.value = false;
      getAllDepots();
    };

    onMounted(() => {
      getAllDepots();
    });

    return {
      depots,
      columns,
      depotFormModalVisible,
      depotFormModalIsUpdate,
      depotFormModalDepot,
      confirmDelete,
      openDepotFormModal,
      closeDepotFormModal,
    };
  }
});
</script>
