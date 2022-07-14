<template>
  <div>
    <loader-component v-if="loading" />
    <div v-else>
       <a-page-header title="Etats">
        <template #extra>
          <a-button type="primary" @click="openStateFormModal(null)">Ajouter</a-button>
        </template>
      </a-page-header>
      <a-table :scroll="{ x: 'max-content' }" class="mx-4" :dataSource="states" :columns="columns">
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'color'">
            <a-tag :color="record.color" size="small">{{ record.color }}</a-tag>
          </template>
          <template v-else-if="column.key === 'action'">
            <a class="ant-dropdown-link" @click="openStateFormModal(record)">Modifier</a>
            <a-divider type="vertical"/>
            <a-popconfirm
              title="Voulez vous vraiment supprimer cet état ?"
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

      <state-form-modal v-if="stateFormModalVisible" :is-update="stateFormModalIsUpdate" :state="stateFormModalState" :close="closeStateFormModal" />
    </div>
  </div>
</template>

<script>
import {defineComponent, onMounted, computed, ref} from "vue";
import {useStore} from "vuex";
import StateFormModal from "../../components/states/StateFormModal";
import LoaderComponent from "../../components/LoaderComponent";

export default defineComponent({
  components: {
    StateFormModal,
    LoaderComponent
  },
  setup() {
    const store = useStore();
    const states = computed(() => store.getters['states/getAllStates']);
    const stateFormModalVisible = ref(false);
    const stateFormModalIsUpdate = ref(false);
    const stateFormModalState = ref({});

    const loading = ref(false);

    const columns = [
      {
        title: "Nom",
        dataIndex: "name",
        key: "name",
      },
      {
        title: "Couleur",
        dataIndex: "color",
        key: "color",
      },
      {
        'title': 'Action',
        'key': 'action',
      }
    ];

    const getAllStates = () => {
      loading.value = true;
      store.dispatch('states/getAllStates').then(() => {
        loading.value = false;
      });
    };

    const confirmDelete = (record) => {
      store.dispatch('states/deleteState', record).then(() => {
        getAllStates();
      });
    };

    const openStateFormModal = (state = null) => {
      if (state) {
        stateFormModalState.value = state;
        stateFormModalIsUpdate.value = true;
      } else {
        stateFormModalState.value = {};
        stateFormModalIsUpdate.value = false;
      }

      stateFormModalVisible.value = true;
    };

    const closeStateFormModal = () => {
      stateFormModalVisible.value = false;
      getAllStates();
    };

    onMounted(() => {
      getAllStates();
    });

    return {
      states,
      columns,
      stateFormModalVisible,
      stateFormModalIsUpdate,
      stateFormModalState,
      confirmDelete,
      openStateFormModal,
      closeStateFormModal,
      loading
    };
  }
})
</script>
