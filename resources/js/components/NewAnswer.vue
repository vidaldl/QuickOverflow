<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Answer</h3>
                    </div>
                    <hr>
                    <form @submit.prevent="create">
                        <div class="form-group">
<!--                            <textarea name="body" id="" rows="7" required v-model="body" class="form-control"></textarea>-->
                            <vue-editor v-model="body" />
                        </div>
                        <div class="form-group">
                            <button type="submit" :disabled="isInvalid" class="btn btn-lg btn-outline-primary">
                                <spinner :small="true" :min-width="59.22" v-if="$root.loading"></spinner>
                                <span v-else>Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
    components: { VueEditor },

    props: ['questionId'],

    methods: {
        create () {
            axios.post(`/questions/${this.questionId}/answers`, {
                body: this.body
            })
            .catch(error => {
                this.$toast.error(error.response.data.message, "Error");
            })
            .then(({data}) => {
                this.$toast.success(data.message, "Noice!");
                this.body = '';
                this.$emit('created', data.answer);
            });

        }
    },

    data () {
        return {
            body: ''
        }
    },

    computed: {
        isInvalid () {
            return !this.signedIn || this.body.length < 10;
        }
    }
}
</script>

<style scoped>

</style>
