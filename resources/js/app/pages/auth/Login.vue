<template>
  <div
    style="min-height: 100vh; min-width: 100vw"
    class="
      bg-white
      d-flex
      flex-column
      align-items-center
      justify-content-center
    "
  >
    <h1 class="logo fs-2 fw-bold">Gestion-SAV</h1>
    <a-form
      :model="formState"
      name="basic"
      autocomplete="off"
      @finish="onFinish"
      @finishFailed="onFinishFailed"
    >
      <a-form-item
        label="Nom d'utilisateur"
        name="username"
        :rules="[{ required: true, message: 'Entrer un nom d\'utilisateur !' }]"
      >
        <a-input v-model:value="formState.username" />
      </a-form-item>

      <a-form-item
        label="Mot de passe"
        name="password"
        :rules="[{ required: true, message: 'Entrer un mot de passe' }]"
      >
        <a-input-password v-model:value="formState.password" />
      </a-form-item>

      <a-form-item name="remember">
        <a-checkbox v-model:checked="formState.remember"
          >Se souvenir de moi</a-checkbox
        >
      </a-form-item>

      <a-form-item>
        <a-button type="primary" block html-type="submit"
          >Se connnecter</a-button
        >
      </a-form-item>
    </a-form>
  </div>
</template>
<script>
import { defineComponent, reactive } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default defineComponent({
  setup() {
    const store = useStore();
    const router = useRouter();

    const formState = reactive({
      username: "",
      password: "",
      remember: false,
    });
    const onFinish = (values) => {
      store.dispatch("auth/login", formState).finally(() => {
        router.push("/");
      });
    };

    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };

    return {
      formState,
      onFinish,
      onFinishFailed,
    };
  },
});
</script>
