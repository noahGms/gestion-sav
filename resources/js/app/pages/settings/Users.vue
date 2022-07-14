<template>
  <div>
    <loader-component v-if="loading" />
    <div v-else>
      <a-page-header title="Utilisateurs">
        <template #extra>
          <a-button @click="openUserFormModal(null)" type="primary">Ajouter</a-button>
        </template>
      </a-page-header>
      <a-table :scroll="{ x: 'max-content' }" class="mx-4" :dataSource="users" :columns="columns">
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'is_admin'">
            <span v-if="!record.is_god">
              <a-tag :color="record.is_admin ? 'green' : 'blue'">
                {{ record.is_admin ? "Administrateur" : "Utilisateur" }}
              </a-tag>
            </span>
            <span v-else-if="record.is_god">
              <a-tag color="purple"> Dieu </a-tag>
            </span>
          </template>
          <template v-else-if="column.key === 'action'">
            <span v-if="!record.is_god">
              <a-switch
                v-model:checked="record.is_admin"
                @change="toggleAdmin(record)"
              />
              <a-divider type="vertical" />
              <a class="ant-dropdown-link" @click="openUserFormModal(record)">Modifier</a>
              <a-divider type="vertical" />
              <a-popconfirm
                v-if="record.id != authenticatedUser.id"
                title="Voulez vous vraiment supprimer cet utilisateur ?"
                ok-text="Confirmer"
                cancel-text="Annuler"
                @confirm="confirmDelete(record)"
                @cancel="() => {}"
              >
                <a class="text-danger" href="#">Supprimer</a>
              </a-popconfirm>
              <a v-else class="text-danger">Vous ne pouvez pas vous supprimer</a>
            </span>
            <span v-else> Aucune actions est permise </span>
          </template>
        </template>
      </a-table>

      <user-form-modal v-if="userFormModalVisible" :is-update="userFormModalIsUpdate" :user="userFormModalUser" :close="closeUserFormModal" />
    </div>
  </div>
</template>

<script>
import { computed, defineComponent, onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import UserFormModal from "../../components/users/UserFormModal";
import LoaderComponent from "../../components/LoaderComponent";

export default defineComponent({
  components: {
    UserFormModal,
    LoaderComponent
  },
  setup() {
    const store = useStore();
    const users = computed(() => store.getters["users/getAllUsers"]);
    const authenticatedUser = computed(
      () => store.getters["auth/getAuthenticatedUser"]
    );
    const userFormModalVisible = ref(false);
    const userFormModalIsUpdate = ref(false);
    const userFormModalUser = ref({});

    const loading = ref(false);

    const columns = [
      {
        title: "Nom d'utilisateur",
        dataIndex: "username",
        key: "username",
      },
      {
        title: "Nom complet",
        dataIndex: "fullname",
        key: "fullname",
      },
      {
        title: "Admin",
        dataIndex: "is_admin",
        key: "is_admin",
      },
      {
        title: "Action",
        key: "action",
      },
    ];

    const confirmDelete = (user) => {
      store.dispatch("users/deleteUser", user).then(() => {
        getAllUsers();
      });
    };

    const openUserFormModal = (user = null) => {
      if (user) {
        userFormModalUser.value = user;
        userFormModalIsUpdate.value = true;
      } else {
        userFormModalUser.value = {};
        userFormModalIsUpdate.value = false;
      }
      userFormModalVisible.value = true;
    };

    const closeUserFormModal = () => {
      userFormModalVisible.value = false;
      getAllUsers();
    };

    const getAllUsers = () => {
      loading.value = true;
      store.dispatch("users/getAllUsers").then(() => {
        loading.value = false;
      });
    };

    const toggleAdmin = (user) => {
      store.dispatch("users/toggleAdmin", user).then(() => {
        getAllUsers();
      });
    };

    onMounted(() => {
      getAllUsers();
    });

    return {
      authenticatedUser,
      users,
      columns,
      userFormModalVisible,
      userFormModalIsUpdate,
      userFormModalUser,
      confirmDelete,
      openUserFormModal,
      closeUserFormModal,
      toggleAdmin,
      loading
    };
  },
});
</script>
