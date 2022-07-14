<template>
  <a-modal
    v-model:visible="visible"
    :title="isUpdate ? 'Modifier un client' : 'Ajouter un client'"
    :ok-text="isUpdate ? 'Modifier' : 'Ajouter'"
    cancel-text="Annuler"
    @ok="onOk"
    @cancel="onCancel"
    centered
  >
    <a-form
      ref="formRef"
      :rules="rules"
      :model="formState"
      name="form_in_modal"
      layout="vertical"
    >
      <a-row :gutter="24">
        <a-col :span="12">
          <a-form-item name="lastname" label="Nom">
            <a-input v-model:value="formState.lastname" />
          </a-form-item>
        </a-col>
        <a-col :span="12">
          <a-form-item name="firstname" label="Prénom">
            <a-input v-model:value="formState.firstname" />
          </a-form-item>
        </a-col>
      </a-row>
      <a-form-item name="email" label="Email">
        <a-input v-model:value="formState.email" />
      </a-form-item>
      <a-row :gutter="24">
        <a-col :span="8">
          <a-form-item name="phone" label="Téléphone">
            <a-input v-model:value="formState.phone" />
          </a-form-item>
        </a-col>
        <a-col :span="8">
          <a-form-item name="mobile1" label="Téléphone portable 1">
            <a-input v-model:value="formState.mobile1" />
          </a-form-item>
        </a-col>
        <a-col :span="8">
          <a-form-item name="mobile2" label="Téléphone portable 2">
            <a-input v-model:value="formState.mobile2" />
          </a-form-item>
        </a-col>
      </a-row>
      <a-row :gutter="24">
        <a-col :span="12">
          <a-form-item name="street_number" label="Numéro de la rue">
            <a-input v-model:value="formState.street_number" />
          </a-form-item>
        </a-col>
        <a-col :span="12">
          <a-form-item name="street_name" label="Nom de la rue">
            <a-input v-model:value="formState.street_name" />
          </a-form-item>
        </a-col>
        <a-col :span="12">
          <a-form-item name="zip_code" label="Code postal">
            <a-input v-model:value="formState.zip_code" />
          </a-form-item>
        </a-col>
        <a-col :span="12">
          <a-form-item name="city" label="Ville">
            <a-input v-model:value="formState.city" />
          </a-form-item>
        </a-col>
      </a-row>
    </a-form>
  </a-modal>
</template>
<script>
import {defineComponent, onMounted, reactive, ref} from "vue";
import { useStore } from "vuex";
export default defineComponent({
  props: {
    close: {
      type: Function,
      required: true,
    },
    isUpdate: {
      type: Boolean,
      default: false,
    },
    customer: {
      type: Object,
      default: () => ({}),
    },
  },
  setup(props) {
    const store = useStore();
    const formRef = ref();
    const visible = ref(true);
    const formState = reactive({
      firstname: "",
      lastname: "",
      email: "",
      phone: "",
      mobile1: "",
      mobile2: "",
      street_number: "",
      street_name: "",
      city: "",
      zip_code: "",
    });

    const rules = {
      firstname: [],
      lastname: [],
      email: [],
      phone: [],
      mobile1: [],
      mobile2: [],
    };

    const onCancel = () => {
      formRef.value.resetFields();
      props.close();
    };

    const onOk = () => {
      formRef.value
        .validateFields()
        .then((values) => {
          if (props.isUpdate) {
            store.dispatch("customers/updateCustomer", {
              ...values,
              id: props.customer.id,
            }).then(() => {
              onCancel();
            });
          } else {
            store.dispatch("customers/newCustomer", values).then(() => {
              onCancel();
            });
          }
        })
        .catch((info) => {
          console.log("Validate Failed:", info);
        });
    };

    onMounted(() => {
      if (props.isUpdate) {
        formState.firstname = props.customer.firstname;
        formState.lastname = props.customer.lastname;
        formState.email = props.customer.email;
        formState.phone = props.customer.phone;
        formState.mobile1 = props.customer.mobile1;
        formState.mobile2 = props.customer.mobile2;
        formState.street_number = props.customer.address?.street_number;
        formState.street_name = props.customer.address?.street_name;
        formState.city = props.customer.address?.city;
        formState.zip_code = props.customer.address?.zip_code;
      }
    });

    return {
      formState,
      formRef,
      visible,
      rules,
      isUpdate: props.isUpdate,
      onOk,
      onCancel,
    };
  },
});
</script>
