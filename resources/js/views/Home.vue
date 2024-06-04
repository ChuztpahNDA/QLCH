<template>
    <h1>Wellcomesdasd to Home</h1>
</template>
<script>
import { defineComponent, onMounted, reactive, ref } from "vue";
import {

} from '@ant-design/icons-vue';
import axios from "../plugins/axios";
import { useRouter } from "vue-router"
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default defineComponent({
    name: 'Dashboard',
    components: {

    },
    setup() {
        const router = useRouter();
        const showRegister = ref(false);
        const rules = ref([]);
        const formData = ref({
            email: undefined,
            password: undefined,
            password_confirmation: undefined,
        });

        onMounted(() => {
            axios.get('dashboard').then((res) => {
                console.log(res, "oke");
            });
        });

        return {
            onsubmit,
            formData,
            showRegister
        };
    },
});
</script>
<style></style>
