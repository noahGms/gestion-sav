<template>
  <a-modal
    v-model:visible="visible"
    :title="isUpdate ? 'Modifier un type' : 'Ajouter un type'"
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

      <a-form-item name="category_id" label="Catégorie">
        <a-select v-model:value="formState.category_id">
          <a-select-option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </a-select-option>
        </a-select>
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
    type: {
      type: Object,
      default: () => ({}),
    },
    categories: {
      type: Array,
      required: true,
    },
  },
  setup(props) {
    const store = useStore();
    const formRef = ref();
    const visible = ref(true);
    const formState = reactive({
      name: "",
      category_id: "",
    });

    const rules = {
      name: [
        { required: true, message: "Le nom est obligatoire !" },
      ],
      category_id: [{ required: true, message: "La catégorie est obligatoire !" }],
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
            store.dispatch("types/updateType", {
              ...values,
              id: props.type.id,
            }).then(() => {
              onCancel();
            });
          } else {
            store.dispatch("types/newType", values).then(() => {
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
        formState.name = props.type.name;
        formState.category_id = props.type.category?.id;
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
