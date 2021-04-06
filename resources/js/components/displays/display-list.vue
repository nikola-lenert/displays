<template>
    <div>
        <b-table :items="items" :fields="fields" small striped hover show-empty :busy="loading">
            <template #empty>
                <h4 class="text-center mt-2 mb-2">No displays available</h4>
            </template>

            <template #cell(image)="data">
                <b-button v-if="data.item.image" @click="openImageModal(data.item)" variant="primary"
                          class="pt-0 pb-0">Show image
                </b-button>

                <span v-else>/</span>
            </template>

            <template #cell(actions)="data">
                <router-link :to="`/displays/${data.item.id}`">
                    <b-button class="p-0 mr-2" variant="link">
                        <b-icon-arrow-right-circle-fill class=""></b-icon-arrow-right-circle-fill>
                    </b-button>
                </router-link>
            </template>
        </b-table>

        <b-pagination v-if="displayData"
                      :value="displayData.meta.current_page"
                      @input="loadDisplays({page: $event})"
                      :per-page="displayData.meta.per_page"
                      :total-rows="displayData.meta.total">
        </b-pagination>

        <b-modal v-model="imageModalState" hide-footer @close="closeImageModal">
            <template #modal-title>
                <h4>Display: <strong>{{modalImageTitle}}</strong></h4>
            </template>
            <b-img :src="modalImageSource" fluid></b-img>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "display-list",
    data() {
        return {
            fields: [
                {key: 'id'},
                {key: 'serial_number', label: 'Serial Number'},
                {key: 'display_type.label', label: 'Display Type'},
                {key: 'reseller.name', label: 'Reseller'},
                {key: 'image', label: 'Image'},
                {key: 'actions', label: '', class: 'text-right'},
            ],
            imageModalState: false,
            modalImageSource: null,
            modalImageTitle: null,
            loading: false,
        }
    },
    computed: {
        displayData() {
            return this.$store.state.displayData
        },
        items() {
            return (this.displayData && this.displayData.data) || []
        },
    },
    methods: {
        openImageModal(item) {
            this.modalImageSource = item.image
            this.modalImageTitle = item.serial_number
            this.imageModalState = true
        },
        closeImageModal() {
            this.modalImageSource = null
            this.modalImageTitle = null
        },
        loadDisplays(params = {}) {
            this.loading = true
            this.$store.dispatch('loadDisplays', params).finally(() => this.loading = false)
        }
    },
    created() {
        this.loadDisplays()
    }
}
</script>

<style scoped>

</style>
