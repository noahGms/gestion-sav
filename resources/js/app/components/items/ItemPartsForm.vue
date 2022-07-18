<template>
  <div>
    <a-row v-for="(part, index) in item.parts" :key="part.id" :gutter="24">
      <a-col>
        <a-form-item
          :name="['parts', index, 'name']"
          :rules="{
            required: true,
            message: 'Le nom est obligatoire',
          }"
        >
          <a-input v-model:value="part.name" placeholder="Nom" />
        </a-form-item>
      </a-col>
      <a-col>
        <a-form-item :name="['parts', index, 'price']">
          <a-input v-model:value="part.price" placeholder="Prix" />
        </a-form-item>
      </a-col>
      <a-col>
        <a-form-item :name="['parts', index, 'ref']">
          <a-input v-model:value="part.ref" placeholder="Référence" />
        </a-form-item>
      </a-col>
      <a-col>
        <MinusCircleOutlined @click="removePart(part)" />
      </a-col>
    </a-row>

    <a-form-item>
      <a-button type="dashed" block @click="addPart">
        <PlusOutlined />
        Ajouter une pièce
      </a-button>
    </a-form-item>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { MinusCircleOutlined, PlusOutlined } from "@ant-design/icons-vue";

export default defineComponent({
  components: {
    MinusCircleOutlined,
    PlusOutlined,
  },
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  setup({ item }) {
    const removePart = (part) => {
      let index = item.parts.indexOf(part);

      if (index !== -1) {
        item.parts.splice(index, 1);
      }
    };

    const addPart = () => {
      item.parts.push({
        name: "",
        price: "",
        ref: "",
        id: Date.now(),
      });
    };

    return {
      item,
      removePart,
      addPart,
    };
  },
});
</script>