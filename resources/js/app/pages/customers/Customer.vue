<template>
  <div v-if="customer">
    <a-page-header :title="`Client n°${customer.id} - ${customer.fullname}`" @back="goBack">
      <template #extra>
        <div>
          <a class="ant-dropdown-link" @click="openCustomerFormModal">Modifier</a>
          <a-divider type="vertical"/>
          <a-popconfirm
            title="Voulez vous vraiment supprimer ce client ?"
            ok-text="Confirmer"
            cancel-text="Annuler"
            @confirm="confirmDelete"
            @cancel="() => {}"
          >
            <a class="text-danger" href="#">Supprimer</a>
          </a-popconfirm>
        </div>
      </template>
    </a-page-header>

    <div class="mx-4">
      <a-card title="Informations">
        <p v-if="customer.fullname">
          <font-size-outlined/>
          <span class="ms-2">
            Nom complet: <span class="fw-bold">{{ customer.fullname }}</span>
          </span>
        </p>
        <p v-if="customer.email">
          <mail-outlined/>
          <span class="ms-2">
          Adresse email:
          <a :href="`mailto:${customer.email}`">
            {{ customer.email }}
          </a>
          </span>
        </p>
        <p v-if="customer.phone">
          <phone-outlined/>
          <span class="ms-2">
          Téléphone fixe:
          <a :href="`tel:${customer.phone}`">
            {{ customer.phone }}
          </a>
          </span>
        </p>
        <p v-if="customer.mobile1">
          <mobile-outlined/>
          <span class="ms-2">
          Téléphone portable 1:
          <a :href="`tel:${customer.mobile1}`">
            {{ customer.mobile1 }}
          </a>
          </span>
        </p>
        <p v-if="customer.mobile2">
          <mobile-outlined/>
          <span class="ms-2">
          Téléphone portable 2:
          <a :href="`tel:${customer.mobile2}`">
            {{ customer.mobile2 }}
          </a>
          </span>
        </p>
        <p v-if="customer.address?.full_address">
          <environment-outlined/>
          <span class="ms-2">
          Adresse:
          <a :href="`https://www.google.com/maps/search/?api=1&query=${customer.address.full_address}`" target="_blank">
            {{ customer.address.full_address }}
          </a>
          </span>
        </p>
      </a-card>
    </div>

    <customer-form-modal
      v-if="customerFormModalVisible"
      :is-update="true"
      :customer="customer"
      :close="closeCustomerFormModal"
    />
  </div>
</template>

<script>
import {defineComponent, onMounted, ref} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import CustomerFormModal from "../../components/customers/CustomerFormModal";
import {
  EnvironmentOutlined,
  MailOutlined,
  MobileOutlined,
  PhoneOutlined,
  FontSizeOutlined
} from "@ant-design/icons-vue";

export default defineComponent({
  components: {
    CustomerFormModal,
    EnvironmentOutlined,
    MailOutlined,
    MobileOutlined,
    PhoneOutlined,
    FontSizeOutlined,
  },
  setup() {
    const store = useStore();
    const route = useRoute();
    const router = useRouter();
    const { id } = route.params;
    const customer = ref(null);
    const customerFormModalVisible = ref(false);

    const getCustomer = () => {
      store.dispatch("customers/getOneCustomer", {
        id
      }).then((response) => {
        customer.value = response.data.data;
      }).catch(() => {
        goBack();
      });
    };

    const goBack = () => {
      router.go(-1);
    };

    const confirmDelete = () => {
      store.dispatch("customers/deleteCustomer", customer.value).then(() => {
        goBack();
      });
    };

    const openCustomerFormModal = () => {
      customerFormModalVisible.value = true;
    };

    const closeCustomerFormModal = () => {
      customerFormModalVisible.value = false;
      getCustomer();
    };

    onMounted(() => {
      getCustomer();
    });

    return {
      customer,
      customerFormModalVisible,
      goBack,
      confirmDelete,
      openCustomerFormModal,
      closeCustomerFormModal,
    };
  }
});
</script>
