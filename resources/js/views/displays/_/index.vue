<template>
    <div style="margin-left: auto; margin-right: auto; display: flex; justify-content: center; width: 500px;">
        <display-form :id="$route.params.id"></display-form>
    </div>
</template>

<script>
export default {
    name: "index",
    components: {
        "DisplayForm": () => import("../../../components/displays/display-form")
    },
}
</script>

<style scoped>

</style>
