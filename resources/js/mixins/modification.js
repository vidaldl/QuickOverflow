import destroy from './destroy';
export default {
    mixins: [destroy],

    data () {
        return {
            editing: false,
        }
    },

    methods: {
        edit () {
            this.setEditCache();
            this.editing = true;
        },

        cancel () {
            this.restoreFromCache();
            this.editing = false;
        },

        setEditCache () {

        },

        restoreFromCache () {

        },

        update () {
            axios.patch(this.endpoint, this.payload())
                .then(res => {
                    console.log(res);
                    this.editing = false;
                    this.bodyHtml = res.data.body_html;
                    this.$toast.success(res.data.message, "Noice!!", { timeout: 3000 });
                }) //If the method goes through
                .catch(err => {
                    this.$toast.error(err.response.data.message, "Darn :/", { timeout: 3000 });

                }); // If the method doesn't go through
        },

        payload () {

        },


    }
}
