<template>
    <div class="w-100">
        <div v-if="id">
            <h4>
                Display: <strong>{{ formData.serial_number }}</strong>
            </h4>

            <hr>
        </div>


        <form @submit.prevent="save">
            <b-row>
                <b-col>
                    <label>Serial number</label>
                    <b-form-input v-model="formData.serial_number" required :readonly="readOnly"></b-form-input>
                </b-col>
            </b-row>

            <b-row>
                <b-col>
                    <label>Display Type</label>
                    <b-form-select v-model="formData.display_type" :disabled="readOnly" required>
                        <b-form-select-option v-for="(option, index) in displayTypes" :key="index" :value="option.id">
                            {{ option.label }}
                        </b-form-select-option>
                    </b-form-select>
                </b-col>
            </b-row>

            <b-row>
                <b-col>
                    <label>Reseller</label>
                    <b-form-select v-model="formData.reseller" :disabled="readOnly" required>
                        <b-form-select-option v-for="(option, index) in resellers" :key="index" :value="option.id">
                            {{ option.name }}
                        </b-form-select-option>
                    </b-form-select>
                </b-col>
            </b-row>

            <b-row>
                <b-col>
                    <template v-if="!id">
                        <label>Image</label>
                        <b-form-file v-model="formData.file" accept="image/*" :disabled="readOnly"></b-form-file>
                    </template>

                    <template v-else-if="image">
                        <div style="max-height: 300px; max-width: 500px; margin-left: auto; margin-right: auto;"
                             class="d-flex justify-content-center">
                            <b-img :src="image" style="object-fit: contain;" fluid></b-img>
                        </div>
                    </template>
                </b-col>
            </b-row>

            <b-row class="mt-4">
                <b-col class="d-flex justify-content-end">
                    <b-button v-if="!id" type="submit" variant="primary" :disabled="loading">
                        <div class="d-flex align-items-center">
                            Save
                            <b-spinner v-if="loading" small class="ml-2"></b-spinner>
                        </div>
                    </b-button>

                    <b-button v-else @click="delete_" variant="danger" :disabled="loading">
                        <div class="d-flex align-items-center">
                            <b-icon-trash></b-icon-trash>
                            <b-spinner v-if="loading" small class="ml-2"></b-spinner>
                        </div>
                    </b-button>
                </b-col>
            </b-row>
        </form>
    </div>
</template>

<script>
export default {
    name: "display-form",
    props: {
        id: {
            default: null
        }
    },
    data() {
        return {
            formData: {
                serial_number: null,
                display_type: null,
                reseller: null,
                image: null,
            },
            image: null,
            loading: false,
            resellers: [],
            displayTypes: [{id: 1, label: 'Pero'}],
            readOnly: false,
        }
    },
    methods: {
        save() {
            this.loading = true
            this.$store.dispatch('saveDisplay', this.formData).then(() => {
                this.$emit('close')
            }).finally(() => this.loading = false)
        },
        delete_() {
            this.loading = true
            this.$store.dispatch('deleteDisplay', this.id).then(() => {
                this.$router.replace('/displays')
            }).finally(() => this.loading = false)
        }
    },
    watch: {
        id: {
            immediate: true,
            handler(id) {
                const promises = [this.$store.dispatch('loadDisplaySetup')]
                if (id) {
                    this.readOnly = true
                    promises.push(this.$store.dispatch('loadDisplay', id))
                }
                Promise.all(promises).then(([setupResponse, displayResponse]) => {
                    console.log(displayResponse)
                    this.resellers = setupResponse.resellers
                    this.displayTypes = setupResponse.display_types
                    this.formData = {
                        serial_number: displayResponse.serial_number,
                        display_type: displayResponse.display_type.id,
                        reseller: displayResponse.reseller.id,
                    }
                    this.image = displayResponse.image
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
