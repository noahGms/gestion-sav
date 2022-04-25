<template>
  <div>
    <a-page-header title="Interventions">
      <template #extra>
        <a-button type="primary" @click="openInterventionFormModal(null)">Ajouter</a-button>
      </template>
    </a-page-header>
    <a-table class="mx-4" :dataSource="interventions" :columns="columns">
      <template #bodyCell="{ column, record }">
        <template v-if="column.key === 'action'">
          <a class="ant-dropdown-link" @click="openInterventionFormModal(record)">Modifier</a>
          <a-divider type="vertical"/>
          <a-popconfirm
            title="Voulez vous vraiment supprimer cette intervention ?"
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

    <intervention-form-modal
      v-if="interventionFormModalVisible"
      :is-update="interventionFormModalIsUpdate"
      :intervention="interventionFormModalIntervention"
      :close="closeInterventionFormModal"
    />
  </div>
</template>

<script>
import {computed, defineComponent, onMounted, ref} from "vue";
import {useStore} from "vuex";
import InterventionFormModal from "../../components/interventions/InterventionFormModal";

export default defineComponent({
  components: {
    InterventionFormModal,
  },
  setup() {
    const store = useStore();
    const interventions = computed(() => store.getters['interventions/getAllInterventions']);
    const interventionFormModalVisible = ref(false);
    const interventionFormModalIsUpdate = ref(false);
    const interventionFormModalIntervention = ref({});

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

    const getAllInterventions = () => {
      store.dispatch('interventions/getAllInterventions');
    };

    const confirmDelete = (record) => {
      store.dispatch('interventions/deleteIntervention', record).then(() => {
        getAllInterventions();
      });
    };

    const openInterventionFormModal = (intervention = null) => {
      if (intervention) {
        interventionFormModalIsUpdate.value = true;
        interventionFormModalIntervention.value = intervention;
      } else {
        interventionFormModalIsUpdate.value = false;
        interventionFormModalIntervention.value = {};
      }

      interventionFormModalVisible.value = true;
    };

    const closeInterventionFormModal = () => {
      interventionFormModalVisible.value = false;
      getAllInterventions();
    };

    onMounted(() => {
      getAllInterventions();
    });

    return {
      interventions,
      columns,
      interventionFormModalVisible,
      interventionFormModalIsUpdate,
      interventionFormModalIntervention,
      confirmDelete,
      openInterventionFormModal,
      closeInterventionFormModal,
    };
  }
});
</script>
