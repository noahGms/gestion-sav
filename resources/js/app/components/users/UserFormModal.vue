<template>
  <a-modal
    v-model:visible="visible"
    :title="isUpdate ? 'Modifier un utilisateur' : 'Ajouter un utilisateur'"
    :ok-text="isUpdate ? 'Modifier' : 'Ajouter'"
    cancel-text="Annuler"
    @ok="onOk"
    @cancel="onCancel"
  >
    <a-form
      ref="formRef"
      :rules="rules"
      :model="formState"
      name="form_in_modal"
    >
      <a-form-item name="username" label="Nom d'utilisateur">
        <a-input v-model:value="formState.username" />
      </a-form-item>
      <a-form-item name="lastname" label="Nom">
        <a-input v-model:value="formState.lastname" />
      </a-form-item>
      <a-form-item name="firstname" label="Prénom">
        <a-input v-model:value="formState.firstname" />
      </a-form-item>
      <a-form-item v-if="!isUpdate" name="password" label="Mot de passe">
        <a-input-password v-model:value="formState.password" />
      </a-form-item>
      <a-form-item
        v-if="!isUpdate"
        name="password_confirmation"
        label="Mot de passe de confirmation"
      >
        <a-input-password v-model:value="formState.password_confirmation" />
      </a-form-item>
      <a-form-item v-if="!isUpdate" name="is_admin" label="Admin">
        <a-switch v-model:checked="formState.is_admin" />
      </a-form-item>
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
    user: {
      type: Object,
      default: () => ({}),
    },
  },
  setup(props) {
    const store = useStore();
    const formRef = ref();
    const visible = ref(true);
    const formState = reactive({
      username: "",
      firstname: "",
      lastname: "",
      password: "",
      password_confirmation: "",
      is_admin: false,
    });

    const validatePasswordConfirmation = (_rule, value) => {
      if (value !== formState.password) {
        return Promise.reject("Les mot de passes ne correspondent pas !");
      } else {
        return Promise.resolve();
      }
    };

    const rules = {
      username: [
        { required: true, message: "Le nom d'utilisateur est obligatoire !" },
      ],
      firstname: [{ required: true, message: "Le prénom est obligatoire !" }],
      lastname: [{ required: true, message: "Le nom est obligatoire !" }],
      password: [
        { required: true, message: "Le mot de passe est obligatoire !" },
      ],
      password_confirmation: [
        {
          required: true,
          message: "La confirmation du mot de passe est obligatoire !",
        },
        {
          validator: validatePasswordConfirmation,
          trigger: "blur",
        },
      ],
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
            store.dispatch("users/updateUser", {
              ...values,
              id: props.user.id,
            }).then(() => {
              onCancel();
            });
          } else {
            store.dispatch("users/newUser", values).then(() => {
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
        formState.username = props.user.username;
        formState.firstname = props.user.firstname;
        formState.lastname = props.user.lastname;
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
