<template>
    <a title="Favorite" :class="classes" @click.prevent="toggle">
        <i class="fa fa-star fa-2x"></i>
        <span class="favorite-count">{{ count }}</span>
    </a>
</template>

<script>
export default {
    props: ['question'],

    data () {
        return {
            isFavorited: this.question.is_favorited,
            count: this.question.favorites_count,

            id: this.question.id
        }
    },

    methods: {
        toggle () {
            if (! this.signedIn) {
                this.$toast.warning("Log in to favorite.", "Bro... :|", {
                    timeout: 3000,
                    position: 'bottomLeft'
                });
                return;
            }
            this.isFavorited ? this.destroy() : this.create();
        },

        destroy () {
            axios.delete(this.endpoint)
            .then(res=> {
                this.count--;
                this.isFavorited = false;
            });

        },

        create () {
            axios.post(this.endpoint)
            .then(res => {
                this.count++;
                this.isFavorited = true;
            });
        }
    },

    computed: {
        classes () {
            return [
                'favorite', 'mt-2',
                ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : '')
            ]
        },

        endpoint () {
            return `/questions/${this.id}/favorites`
        },
    }

}

</script>

<style scoped>

</style>
