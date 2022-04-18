<template>
    <div>{{title}}</div>
</template>

<script>
import {defineComponent} from "vue";

export default defineComponent({
    setup() {
        const title = "Hello World"

        return {
            title
        }
    }
})
</script>
