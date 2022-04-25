<template>
  <a-modal
    v-model:visible="visible"
    :title="isUpdate ? 'Modifier un état' : 'Ajouter un état'"
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
      <a-form-item name="name" label="Nom">
        <a-input v-model:value="formState.name" />
      </a-form-item>
      <a-form-item name="color" label="Couleur">
        <a-input type="color" v-model:value="formState.color" />
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
    state: {
      type: Object,
      default: () => ({}),
    },
  },
  setup(props) {
    const store = useStore();
    const formRef = ref();
    const visible = ref(true);
    const formState = reactive({
      name: "",
      color: "",
    });

    const rules = {
      name: [
        { required: true, message: "Le nom est obligatoire !" },
      ],
      color: [{ required: true, message: "La couleur est obligatoire !" }],
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
            store.dispatch("states/updateState", {
              ...values,
              id: props.state.id,
            }).then(() => {
              onCancel();
            });
          } else {
            store.dispatch("states/newState", values).then(() => {
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
        formState.name = props.state.name;
        formState.color = props.state.color;
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
