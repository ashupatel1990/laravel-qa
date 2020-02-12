<template>
<div>
    <a title="Click to mark as favorite question (Click again to undo)" 
		:class="classes"
        @click.prevent="toggle">
		<i class="fas fa-star fa-2x"></i>
		<span class="favorites-count">{{ favouriteCount }}</span>
	</a>
    </div>
</template>

<script>
export default {
    props: ['model'],

    data () {
        return {
            favouriteCount: this.model.favourites_count,
            isFavourited: this.model.is_favourited,
            signedIn: true,
            id: this.model.id
        }
        
    },
    computed: {
        classes() {
            return [
                'favorite', 'mt-2',
                ! this.signedIn ? 'off' : (this.isFavourited ? 'favorited' : '')
            ];
        },
        endPoint() {
            return `/questions/${this.id}/favourite`;
        }
    },
    methods: {
        toggle() {
            this.isFavourited ? this.destroy() : this.create()
        },

        destroy() {
            axios.delete(this.endPoint)
            .then(res => {
                this.favouriteCount--;
                this.isFavourited = false;
                this.$toast.success(res.data.message, "Success", { timeout: 3000 });
            });
        },

        create() {
            axios.post(this.endPoint)
            .then(res => {
                this.favouriteCount++;
                this.isFavourited = true;
                this.$toast.success(res.data.message, "Success", { timeout: 3000 });
            });
        }
    }
}
</script>
