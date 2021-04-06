<template>
    <div>
        <div class="d-flex mb-4">
            <h2>Displays</h2>

            <b-button class="ml-3" variant="primary" @click="displayFormState=true">
                <b-icon-plus></b-icon-plus>
            </b-button>
        </div>


        <display-list></display-list>

        <b-modal v-model="displayFormState" hide-footer ok-title="Save">
            <template #modal-title>
                <h4>New display</h4>
            </template>

            <display-form @close="displayFormState=false"></display-form>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "index",
    components: {
        "DisplayList": () => import("../../components/displays/display-list"),
        "DisplayForm": () => import("../../components/displays/display-form"),
    },
    data() {
        return {
            loading: false,
            displayFormState: false,
        }
    },
}
</script>

<style scoped>

</style>
