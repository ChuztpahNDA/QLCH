<template>
    <a-row :gutter="[16, 16]" style="margin-left: 5%;" class="form-login">
        <a-col :xl="8" :lg="8" :md="8" :sm="12" :xs="12">
            <a-form layout="vertical">
                <!-- Email input -->
                <a-form-item label="Email address" :validateStatus="rules?.email ? 'error' : ''"
                    :help="rules?.email ? rules?.email[0] : ''">
                    <a-input v-model:value="formData.email" placeholder="Enter email login" @pressEnter="onsubmit" />
                </a-form-item>

                <!-- Password input -->
                <a-form-item label="Password" :validateStatus="rules?.password ? 'error' : ''"
                    :help="rules?.password ? rules?.password[0] : ''">
                    <a-input-password v-model:value="formData.password" placeholder="Enter your password"
                        @pressEnter="onsubmit" />
                </a-form-item>

                <!-- Confirm password -->
                <a-form-item label="Confirm Password" :validateStatus="rules?.password_confirmation ? 'error' : ''"
                    :help="rules?.password_confirmation ? rules?.password_confirmation[0] : ''">
                    <a-input-password v-model:value="formData.password_confirmation"
                        placeholder="Enter your confirm password" @pressEnter="onsubmit" />
                </a-form-item>
                <!-- Submit button -->
                <a-row>
                    <a-button type="primary" @click="onsubmit()">Submit</a-button>
                    <a-button style="margin-left: 10px;" @click="() => {
                        $router.push(
                            {
                                name: 'Login',
                            });
                    }">Quay lại</a-button>
                </a-row>
            </a-form>
            <div style="margin-top: 20px;">

            </div>
        </a-col>

        <a-col :xl="16" :lg="16" :md="16" :sm="12" :xs="12">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid"
                alt="Phone image" />
        </a-col>
    </a-row>
</template>


<script>
import { defineComponent, reactive, ref } from "vue";
import {

} from '@ant-design/icons-vue';
import { InputPassword } from "ant-design-vue";
import axios from "../../plugins/axios";
import { useRouter } from "vue-router";

export default defineComponent({
    name: 'Register',
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
        })

        const onsubmit = (type) => {
            axios.post('/register', formData.value)
                .then((res) => {
                    router.push({
                        name: 'login'
                    })
                })
                .catch((e) => {
                    rules.value = e.response.data.errors;
                });
        };

        return {
            onsubmit,
            formData,
            showRegister,
            rules
        };
    },
});
</script>
<style>
.form-column {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.form-container {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.form-item {
    margin-bottom: 20px;
}

.form-login {
    display: flex;
    align-items: center;
}
</style>
