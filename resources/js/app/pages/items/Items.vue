<template>
  <div>
    <a-page-header title="Items">
      <template #extra>
        <a-button type="primary" @click="createItem">Ajouter</a-button>
      </template>
    </a-page-header>
    <a-table class="mx-4" :dataSource="items" :columns="columns">
      <template #bodyCell="{ column, record }">
        <template v-if="column.key === 'type'">
          <span>{{record.type?.name}}</span>
        </template>
        <template v-else-if="column.key === 'customer'">
          <span>{{record.customer?.fullname}}</span>
        </template>
        <template v-else-if="column.key === 'state'">
          <a-popover title="Commentaire">
            <template #content>
              {{record.comment_state}}
            </template>
            <a-tag :color="record.state?.color">{{record.state?.name}}</a-tag>
          </a-popover>
        </template>
        <template v-else-if="column.key === 'action'">
          <a class="ant-dropdown-link">Modifier</a>
          <a-divider type="vertical"/>
          <a-popconfirm
            title="Voulez vous vraiment supprimer cet item ?"
            ok-text="Confirmer"
            cancel-text="Annuler"
            @confirm="confirmDelete(record)"
            @cancel="() => {}"
          >
            <a class="text-danger" href="#">Supprimer</a>
          </a-popconfirm>
        </template>
      </template>
    </a-table>
    </div>
</template>

<script>
import {computed, defineComponent, onMounted} from "vue";
import {useStore} from "vuex";
import {useRouter} from "vue-router";

export default defineComponent({
  setup() {
    const store = useStore();
    const router = useRouter();
    const items = computed(() => store.getters['items/getAllItems']);

    const columns = [
      { title: 'Type', key: 'type', dataIndex: 'type' },
      { title: 'Machine', key: 'machine', dataIndex: 'machine'},
      { title: 'Client', key: 'customer', dataIndex: 'customer'},
      { title: 'Etat', key: 'state', dataIndex: 'state' },
      { title: 'Action', key: 'action' },
    ];

    const getAllItems = () => {
      store.dispatch('items/getAllItems');
    };

    const confirmDelete = (record) => {
      store.dispatch('items/deleteItem', record).then(() => {
        getAllItems();
      });
    };

    const createItem = () => {
      router.push({name: 'createItem'});
    };

    onMounted(() => {
      getAllItems();
    });

    return {
      items,
      columns,
      confirmDelete,
      createItem,
    };
  }
});
</script>
