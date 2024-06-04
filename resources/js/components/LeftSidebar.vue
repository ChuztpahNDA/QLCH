<template>
    <a-menu class="left-sidebar">
        <a-menu-item
        key="product"
        @click="
            () => {
            $router.push({
                name: 'product',
            });
            }
        "
        >
            {{ 'Products' }}
        </a-menu-item>
        <a-menu-item
        key="store"
        @click="
            () => {
            $router.push({
                name: 'store',
            });
            }
        "
        >
            {{ 'Store' }}
        </a-menu-item>
        <a-menu-item key="logout" @click="logout">
            {{ 'Logout' }}
        </a-menu-item>
    </a-menu>
</template>

<script>
import { useStore } from 'vuex';
import { useRouter } from "vue-router"
export default {
    name: 'LeftSidebar',
    setup() {
        const store = useStore();
        const router = useRouter();
        const logout = () => {
            store.dispatch('logout');
            router.push({
                name: 'login',
            });
        }
        return {
            logout,
        }
    }
};
</script>

<style scoped>
.left-sidebar {
    margin-top: 60px;
    width: 250px;
    background-color: #282d2b;
    color: #ffffff;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    padding: 20px;
}

.left-sidebar ul {
    list-style: none;
    padding: 0;
}

.left-sidebar ul li {
    margin: 20px 0;
}

.left-sidebar ul li a {
    color: #ecf0f1;
    text-decoration: none;
}

.left-sidebar ul li a:hover {
    text-decoration: underline;
}
</style>
