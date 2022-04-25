<template>
  <a-modal
    v-model:visible="visible"
    :title="isUpdate ? 'Modifier une catégorie' : 'Ajouter une catégorie'"
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
    category: {
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
    });

    const rules = {
      name: [
        { required: true, message: "Le nom est obligatoire !" },
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
            store.dispatch("categories/updateCategory", {
              ...values,
              id: props.category.id,
            }).then(() => {
              onCancel();
            });
          } else {
            store.dispatch("categories/newCategory", values).then(() => {
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
        formState.name = props.category.name;
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
