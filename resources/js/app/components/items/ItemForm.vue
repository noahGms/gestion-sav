<template>
  <div>
    <a-form
      ref="formRef"
      :model="formState"
      name="itemForm"
      layout="vertical"
    >
      <a-row :gutter="24">
        <a-col span="24">
          <a-form-item name="customer_id" label="Client">
            <a-select
              show-search
              v-model:value="formState.customer_id"
              :options="customers"
              :field-names="{ label: 'fullname', value: 'id' }"
              :filter-option="filterCustomersOption"
            />
          </a-form-item>
        </a-col>
      </a-row>

      <a-divider></a-divider>

      <a-row :gutter="24">
        <a-col span="24">
          <a-form-item name="state_id" label="Etat">
            <a-select
              v-model:value="formState.state_id"
              :options="states"
              :field-names="{ label: 'name', value: 'id' }"
            />
          </a-form-item>
        </a-col>
        <a-col span="24">
          <a-form-item name="comment_state" label="Commentaire sur l'état">
            <a-textarea
              v-model:value="formState.comment_state"
            />
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
            <a-select
              v-model:value="formState.intervention_id"
              :options="interventions"
              :field-names="{ label: 'name', value: 'id' }"
            ></a-select>
          </a-form-item>
        </a-col>

        <a-col :span="8">
          <a-form-item name="depot_id" label="Dépot">
            <a-select
              v-model:value="formState.depot_id"
              :options="depots"
              :field-names="{ label: 'name', value: 'id' }"
            ></a-select>
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
            <a-select
              v-model:value="formState.return_id"
              :options="returns"
              :field-names="{ label: 'name', value: 'id' }"
            ></a-select>
          </a-form-item>
        </a-col>
      </a-row>

      <a-divider></a-divider>

      <a-row :gutter="24">
        <a-col :span="24">
          <a-form-item name="users" label="Techniciens">
            <a-select
              v-model:value="formState.users"
              mode="multiple"
              style="width: 100%"
              :options="users.filter((user) => !user.is_god)"
              :field-names="{ label: 'username', value: 'id' }"
            ></a-select>
          </a-form-item>
        </a-col>
      </a-row>

      <a-divider></a-divider>

      <a-row :gutter="24">
        <a-col :span="6">
          <a-form-item name="type_id" label="Type">
            <a-select
              v-model:value="formState.type_id"
              :options="types"
              :field-names="{ label: 'name', value: 'id' }"
            ></a-select>
          </a-form-item>
        </a-col>

        <a-col :span="6">
          <a-form-item name="brand_id" label="Marque">
            <a-select
              v-model:value="formState.brand_id"
              :options="brands"
              :field-names="{ label: 'name', value: 'id' }"
            ></a-select>
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

      <a-button class="mt-4" type="primary" block>
        Ajouter
      </a-button>
    </a-form>
  </div>
</template>

<script>
import {computed, defineComponent, onMounted, reactive, ref} from "vue";
import {useStore} from "vuex";

export default defineComponent({
  props: {
    isCreate: {
      type: Boolean,
      default: true,
      required: true,
    },
  },
  setup({isCreate}) {
    const store = useStore();

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
    });

    const interventions = computed(() => store.getters['interventions/getAllInterventions']);
    const depots = computed(() => store.getters['depots/getAllDepots']);
    const returns = computed(() => store.getters['returns/getAllReturns']);
    const users = computed(() => store.getters['users/getAllUsers']);
    const types = computed(() => store.getters['types/getAllTypes']);
    const brands = computed(() => store.getters['brands/getAllBrands']);
    const customers = computed(() => store.getters['customers/getAllLiteCustomers']);
    const states = computed(() => store.getters['states/getAllStates']);

    onMounted(() => {
      store.dispatch('interventions/getAllInterventions');
      store.dispatch('depots/getAllDepots');
      store.dispatch('returns/getAllReturns');
      store.dispatch('users/getAllUsers');
      store.dispatch('types/getAllTypes');
      store.dispatch('brands/getAllBrands');
      store.dispatch('customers/getAllLiteCustomers');
      store.dispatch('states/getAllStates');
    });

    const filterCustomersOption = (input, option) => {
      if (option.fullname) {
        return option.fullname.toLowerCase().indexOf(input.toLowerCase()) >= 0;
      } else {
        return false;
      }
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
    };
  },
});
</script>
