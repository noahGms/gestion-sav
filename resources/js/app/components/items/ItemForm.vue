<template>
  <div>
    <a-form ref="formRef" :model="formState" name="itemForm" layout="vertical">
      <a-row :gutter="24">
        <a-col span="24">
          <a-form-item name="customer_id">
            <template #label>
              <div class="d-flex align-items-center">
                <div>
                  <span>Client</span>
                  <a-button v-if="isCreate && authenticatedUser.is_admin" @click.prevent="openCustomerFormModal" class="ms-2" size="small">Ajouter</a-button>
                </div>
                <div v-if="!isCreate" class="ms-2">
                  <router-link class="d-flex" :to="{ name: 'customer', params: { id: item?.customer?.id } }">
                    <eye-outlined />
                  </router-link>
                </div>
              </div>
            </template>
            <a-select show-search v-model:value="formState.customer_id" :options="customers"
              :field-names="{ label: 'fullname', value: 'id' }" :filter-option="filterCustomersOption" />
          </a-form-item>
        </a-col>
      </a-row>

      <a-divider></a-divider>

      <a-row :gutter="24">
        <a-col span="24">
          <a-form-item name="state_id">
            <template #label>
              <div>
                <span>Etat</span>
                <a-button v-if="isCreate && authenticatedUser.is_admin" @click.prevent="openStateFormModal" class="ms-2" size="small">Ajouter</a-button>
              </div>
            </template>
            <a-select v-model:value="formState.state_id" :options="states"
              :field-names="{ label: 'name', value: 'id' }" />
          </a-form-item>
        </a-col>
        <a-col span="24">
          <a-form-item name="comment_state" label="Commentaire sur l'état">
            <a-textarea v-model:value="formState.comment_state" />
          </a-form-item>
        </a-col>
      </a-row>

      <a-divider></a-divider>

      <a-row :gutter="24">
        <a-col :span="8">
          <a-form-item name="intervention_date" label="Date d'intervention">
            <a-date-picker style="width: 100%;" v-model:value="formState.intervention_date" placeholder="" />
          </a-form-item>
        </a-col>

        <a-col :span="8">
          <a-form-item name="intervention_id" label="Intervention">
            <a-select v-model:value="formState.intervention_id" :options="interventions"
              :field-names="{ label: 'name', value: 'id' }"></a-select>
          </a-form-item>
        </a-col>

        <a-col :span="8">
          <a-form-item name="depot_id" label="Dépot">
            <a-select v-model:value="formState.depot_id" :options="depots"
              :field-names="{ label: 'name', value: 'id' }"></a-select>
          </a-form-item>
        </a-col>
      </a-row>

      <a-row :gutter="24">
        <a-col :span="12">
          <a-form-item name="return_date" label="Date de retour">
            <a-date-picker style="width: 100%;" v-model:value="formState.return_date" placeholder="" />
          </a-form-item>
        </a-col>

        <a-col :span="12">
          <a-form-item name="return_id" label="Retour">
            <a-select v-model:value="formState.return_id" :options="returns"
              :field-names="{ label: 'name', value: 'id' }"></a-select>
          </a-form-item>
        </a-col>
      </a-row>

      <a-divider></a-divider>

      <a-row :gutter="24">
        <a-col :span="24">
          <a-form-item name="users" label="Techniciens">
            <a-select v-model:value="formState.users" mode="multiple" style="width: 100%"
              :options="users.filter((user) => !user.is_god)" :field-names="{ label: 'username', value: 'id' }">
            </a-select>
          </a-form-item>
        </a-col>
      </a-row>

      <a-divider></a-divider>

      <a-row :gutter="24">
        <a-col :span="6">
          <a-form-item name="type_id" label="Type">
            <a-select v-model:value="formState.type_id" :options="types" :field-names="{ label: 'name', value: 'id' }">
            </a-select>
          </a-form-item>
        </a-col>

        <a-col :span="6">
          <a-form-item name="brand_id" label="Marque">
            <a-select v-model:value="formState.brand_id" :options="brands"
              :field-names="{ label: 'name', value: 'id' }"></a-select>
          </a-form-item>
        </a-col>

        <a-col :span="6">
          <a-form-item name="model" label="Modèle">
            <a-input v-model:value="formState.model"></a-input>
          </a-form-item>
        </a-col>

        <a-col :span="6">
          <a-form-item name="serial_number" label="Numéro de série">
            <a-input v-model:value="formState.serial_number"></a-input>
          </a-form-item>
        </a-col>
      </a-row>

      <a-divider></a-divider>

      <a-row :gutter="24">
        <a-col :span="24">
          <a-form-item name="defaults" label="Défauts">
            <a-textarea v-model:value="formState.defaults"></a-textarea>
          </a-form-item>
        </a-col>
      </a-row>

      <a-row :gutter="24">
        <a-col :span="12">
          <a-form-item name="observations" label="Observations">
            <a-textarea v-model:value="formState.observations"></a-textarea>
          </a-form-item>
        </a-col>

        <a-col :span="12">
          <a-form-item name="reparations" label="Réparations">
            <a-textarea v-model:value="formState.reparations"></a-textarea>
          </a-form-item>
        </a-col>
      </a-row>

      <a-row :gutter="24">
        <a-col :span="12">
          <a-form-item name="comments" label="Commentaires">
            <a-textarea v-model:value="formState.comments"></a-textarea>
          </a-form-item>
        </a-col>

        <a-col :span="12">
          <a-form-item name="communications" label="Communications">
            <a-textarea v-model:value="formState.communications"></a-textarea>
          </a-form-item>
        </a-col>
      </a-row>

      <a-divider></a-divider>

      <item-parts-form v-if="isCreate" :item="formState" />

      <a-button @click="saveChanges" class="mt-4" type="primary" block>
        {{ isCreate ? "Ajouter" : "Modifier" }}
      </a-button>
    </a-form>

    <customer-form-modal
        v-if="customerFormModalVisible"
        :is-update="false"
        :close="closeCustomerFormModal"
    />

    <state-form-modal
      v-if="stateFormModalVisible"
      :close="closeStateFormModal"
      :is-update="false"
    />
  </div>
</template>

<script>
import { computed, defineComponent, onMounted, reactive, ref } from "vue";
import { useStore } from "vuex";
import dayjs from "dayjs";
import { useRouter } from "vue-router";
import { EyeOutlined } from "@ant-design/icons-vue";
import CustomerFormModal from "../customers/CustomerFormModal";
import ItemPartsForm from "./ItemPartsForm";
import StateFormModal from "../states/StateFormModal";

export default defineComponent({
  components: {
    EyeOutlined,
    CustomerFormModal,
    ItemPartsForm,
    StateFormModal
  },
  props: {
    isCreate: {
      type: Boolean,
      default: true,
      required: true,
    },
    item: {
      type: Object,
      required: false
    }
  },
  setup({ isCreate, item }) {
    const store = useStore();
    const router = useRouter();

    const formRef = ref(null);
    const formState = reactive({
      customer_id: null,
      intervention_date: null,
      intervention_id: null,
      depot_id: null,
      return_date: null,
      return_id: null,
      users: [],
      type_id: null,
      brand_id: null,
      model: null,
      serial_number: null,
      defaults: null,
      observations: null,
      reparations: null,
      comments: null,
      communications: null,
      state_id: null,
      comment_state: null,
      parts: [],
    });

    const interventions = computed(() => store.getters['interventions/getAllInterventions']);
    const depots = computed(() => store.getters['depots/getAllDepots']);
    const returns = computed(() => store.getters['returns/getAllReturns']);
    const users = computed(() => store.getters['users/getAllUsers']);
    const types = computed(() => store.getters['types/getAllTypes']);
    const brands = computed(() => store.getters['brands/getAllBrands']);
    const customers = computed(() => store.getters['customers/getAllLiteCustomers']);
    const states = computed(() => store.getters['states/getAllStates']);

    const customerFormModalVisible = ref(false);
    const stateFormModalVisible = ref(false);

    const authenticatedUser = computed(() => store.getters["auth/getAuthenticatedUser"]);

    onMounted(() => {
      store.dispatch('interventions/getAllInterventions');
      store.dispatch('depots/getAllDepots');
      store.dispatch('returns/getAllReturns');
      store.dispatch('users/getAllUsers');
      store.dispatch('types/getAllTypes');
      store.dispatch('brands/getAllBrands');
      store.dispatch('customers/getAllLiteCustomers');
      store.dispatch('states/getAllStates');

      if (!isCreate) {
        formState.customer_id = item.customer?.id;
        formState.intervention_date = item.intervention_date ? dayjs(item.intervention_date) : null;
        formState.intervention_id = item.intervention?.id;
        formState.depot_id = item.depot?.id;
        formState.return_date = item.return_date ? dayjs(item.return_date) : null;
        formState.return_id = item.return?.id;
        formState.users = item.users.map(user => user.id); // TODO
        formState.type_id = item.type?.id;
        formState.brand_id = item.brand?.id;
        formState.model = item.model;
        formState.serial_number = item.serial_number;
        formState.defaults = item.defaults;
        formState.observations = item.observations;
        formState.reparations = item.reparations;
        formState.comments = item.comments;
        formState.communications = item.communications
        formState.reparations = item.reparations;
        formState.comments = item.comments;
        formState.communications = item.communications;
        formState.state_id = item.state?.id;
        formState.comment_state = item.comment_state;
      }
    });

    const filterCustomersOption = (input, option) => {
      if (option.fullname) {
        return option.fullname.toLowerCase().indexOf(input.toLowerCase()) >= 0;
      } else {
        return false;
      }
    };

    const goBack = () => {
      router.go(-1);
    }

    const saveChanges = () => {
      formRef.value
        .validateFields()
        .then(values => {
          if (isCreate) {
            store.dispatch('items/newItem', values).then(() => {
              goBack();
            });
          } else {
            store.dispatch('items/updateItem', { ...values, id: item.id }).then(() => {
              goBack();
            });
          }
        })
    }

    const openCustomerFormModal = () => {
      customerFormModalVisible.value = true;
    };

    const closeCustomerFormModal = () => {
      customerFormModalVisible.value = false;
      store.dispatch('customers/getAllLiteCustomers').then(() => {
        const customerCreated = store.getters['customers/getCustomerCreated'];

        if (customerCreated) {
          formState.customer_id = customerCreated.id;
        }
      });
    };

    const openStateFormModal = () => {
      stateFormModalVisible.value = true;
    };

    const closeStateFormModal = () => {
      stateFormModalVisible.value = false;

      store.dispatch('states/getAllStates').then(() => {
        const stateCreated = store.getters['states/getStateCreated'];

        if (stateCreated) {
          formState.state_id = stateCreated.id;
        }
      });
    };

    return {
      formState,
      interventions,
      depots,
      returns,
      users,
      types,
      brands,
      customers,
      states,
      filterCustomersOption,
      isCreate,
      saveChanges,
      formRef,
      customerFormModalVisible,
      openCustomerFormModal,
      closeCustomerFormModal,
      stateFormModalVisible,
      openStateFormModal,
      closeStateFormModal,
      authenticatedUser,
    };
  },
});
</script>
