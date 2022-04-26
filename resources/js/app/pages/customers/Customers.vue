<template>
  <div>
    <a-page-header title="Clients">
      <template #extra>
        <a-button type="primary" @click="openCustomerFormModal(null)">Ajouter</a-button>
      </template>
    </a-page-header>
    <div class="mx-4">
      <a-alert v-if="!customers.length" message="Aucun client est trouvé" type="info"/>
      <a-list
        v-else
        item-layout="horizontal"
        :data-source="customers"
      >
        <template #renderItem="{ item }">
          <a-list-item>
            <template #actions>
              <a @click="showCustomerDetails(item)" class="ant-dropdown-link">Détails</a>
              <a @click="openCustomerFormModal(item)" class="ant-dropdown-link">Modifier</a>
              <a-popconfirm
                title="Voulez vous vraiment supprimer ce client ?"
                ok-text="Confirmer"
                cancel-text="Annuler"
                @confirm="confirmDelete(item)"
                @cancel="() => {}"
              >
                <a class="text-danger" href="#">Supprimer</a>
              </a-popconfirm>
            </template>
            <a-list-item-meta>
              <template #title>
                <p class="mx-0 my-0">{{item.fullname}}</p>
              </template>
              <template #description>
                <span class="my-0" v-if="item.email">
                  <mail-outlined />
                  <a :href="`mailto:${item.email}`" class="ms-2">{{item.email}}</a>
                </span>
                <span class="ms-2" v-if="item.phone">
                  <phone-outlined />
                  <a :href="`tel:${item.phone}`" class="ms-2">{{item.phone}}</a>
                </span>
                <span class="ms-2" v-if="item.address?.full_address">
                  <environment-outlined />
                  <a :href="`http://maps.google.com/?q=${item.address.full_address}`" target="_blank" class="ms-2">{{item.address.full_address}}</a>
                </span>
              </template>
              <template #avatar>
                <a-avatar :src="`https://eu.ui-avatars.com/api/?name=${item.fullname}`" />
              </template>
            </a-list-item-meta>
          </a-list-item>
        </template>
      </a-list>
    </div>

    <customer-form-modal
      v-if="customerFormModalVisible"
      :is-update="customerFormModalIsUpdate"
      :customer="customerFormModalCustomer"
      :close="closeCustomerFormModal"
    />
  </div>
</template>

<script>
import {computed, defineComponent, onMounted, ref} from "vue";
import {useStore} from "vuex";
import {
  DeleteOutlined,
  EnvironmentOutlined,
  EyeOutlined,
  FormOutlined,
  MailOutlined,
  MobileOutlined,
  PhoneOutlined
} from "@ant-design/icons-vue";
import CustomerFormModal from "../../components/customers/CustomerFormModal";
import {useRouter} from "vue-router";

export default defineComponent({
  components: {
    MailOutlined,
    FormOutlined,
    PhoneOutlined,
    MobileOutlined,
    EnvironmentOutlined,
    EyeOutlined,
    DeleteOutlined,
    CustomerFormModal,
  },
  setup() {
    const store = useStore();
    const router = useRouter();
    const customers = computed(() => store.getters["customers/getAllCustomers"]);
    const customerFormModalVisible = ref(false);
    const customerFormModalIsUpdate = ref(false);
    const customerFormModalCustomer = ref({});

    const getAllCustomers = () => {
      store.dispatch("customers/getAllCustomers");
    };

    const showCustomerDetails = (customer) => {
      router.push({
        name: "customer",
        params: {
          id: customer.id
        }
      });
    };

    const confirmDelete = (record) => {
      store.dispatch("customers/deleteCustomer", record).then(() => {
        getAllCustomers();
      });
    };

    const openCustomerFormModal = (customer = null) => {
      if (customer) {
        customerFormModalIsUpdate.value = true;
        customerFormModalCustomer.value = customer;
      } else {
        customerFormModalIsUpdate.value = false;
        customerFormModalCustomer.value = {};
      }

      customerFormModalVisible.value = true;
    };

    const closeCustomerFormModal = () => {
      customerFormModalVisible.value = false;
      getAllCustomers();
    };

    onMounted(() => {
      getAllCustomers();
    });

    return {
      customers,
      customerFormModalVisible,
      customerFormModalIsUpdate,
      customerFormModalCustomer,
      confirmDelete,
      showCustomerDetails,
      openCustomerFormModal,
      closeCustomerFormModal,
    };
  }
});
</script>
