<template>
    <div class="d-flex flex-column">
        <nav class="mb-4 d-flex justify-content-center">
            <router-link to="/" class="p-2 m-2 bg-primary text-white">Homepage</router-link>
            <router-link to="/displays" class="p-2 m-2 bg-primary text-white">Displays</router-link>
        </nav>

        <router-view></router-view>
    </div>

</template>
<script>
export default {
    name: "App"
}
</script>

<style scoped>

</style>
