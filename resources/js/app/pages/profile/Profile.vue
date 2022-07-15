<template>
  <div>
    <a-page-header title="Profile" />
    <div class="d-flex align-items-center" style="padding: 16px 24px;">
      <a-avatar :size="64" :src="avatarUrl" />

      <div class="d-flex ms-3">
        <a-input id="file-upload-input" type="file" accept="image/png, image/jpeg" :multiple="false"
          @change="uploadAvatar" hidden />
        <a-button @click="triggerFileInputClick">Upload</a-button>

        <a-popconfirm :disabled="!authenticatedUser.avatar" title="Voulez vous vraiment supprimer l'avatar"
          okText="Confirmer" cancelText="Annuler" @confirm="removeAvatar" @cancel="() => { }">
          <a-button danger class="ms-3" :disabled="!authenticatedUser.avatar">
            Supprimer
          </a-button>
        </a-popconfirm>
      </div>
    </div>
    <hr class="mt-5" />
    <div class="my-5" style="padding: 16px 24px;">
      <a-form layout="vertical" ref="formRef" :model="formState">
        <a-form-item name="firstname" label="Prénom">
          <a-input v-model:value="formState.firstname" />
        </a-form-item>
        <a-form-item name="lastname" label="Nom">
          <a-input v-model:value="formState.lastname" />
        </a-form-item>
        <a-form-item name="username" label="Nom d'utilisateur">
          <template v-slot:extra>
            Contactez l'administrateur si vous voulez changer de nom d'utilisateur
          </template>
          <a-input disabled v-model:value="formState.username" />
        </a-form-item>
      </a-form>
    </div>

    <hr class="mt-5" />

    <div class="mt-5 d-flex justify-content-end" style="padding: 16px 24px;">
      <a-button @click="saveChanges" type="primary">Enregistrer les changements</a-button>
    </div>
  </div>
</template>

<script>
import { computed, defineComponent, ref, reactive, onMounted } from "vue";
import { useStore } from "vuex";
import { UploadOutlined } from "@ant-design/icons-vue";

export default defineComponent({
  components: {
    UploadOutlined
  },
  setup() {
    const store = useStore();
    const authenticatedUser = computed(() => store.getters["auth/getAuthenticatedUser"]);

    const formRef = ref();
    const formState = reactive({
      firstname: '',
      lastname: '',
      username: ''
    });

    const saveChanges = () => {
      formRef.value
        .validateFields()
        .then(values => {
          axios.put('/api/profile', values).then(() => {
            store.dispatch('auth/whoami');
          });
        })
        .catch(info => {
          console.log('Validation failed: ', info);
        });
    }

    const avatarUrl = computed(() => {
      if (authenticatedUser.value.avatar) {
        return 'http://localhost:8000/api/profile/avatar';
      } else {
        return `https://eu.ui-avatars.com/api/?name=${authenticatedUser.fullname}`;
      }
    });

    const uploadAvatar = (event) => {
      const file = event.target.files[0];

      const formData = new FormData();
      formData.set('file', file);

      axios.post("/api/profile/avatar", formData).then(() => {
        store.dispatch('auth/whoami');
      });
    }

    const removeAvatar = () => {
      axios.delete("/api/profile/avatar").then(() => {
        store.dispatch('auth/whoami');
      });
    }

    const triggerFileInputClick = () => {
      document.getElementById('file-upload-input').click();
    }

    onMounted(() => {
      formState.firstname = authenticatedUser.value.firstname;
      formState.lastname = authenticatedUser.value.lastname;
      formState.username = authenticatedUser.value.username;
    });

    return {
      authenticatedUser,
      uploadAvatar,
      triggerFileInputClick,
      removeAvatar,
      avatarUrl,
      formRef,
      formState,
      saveChanges
    };
  }
});
</script>
