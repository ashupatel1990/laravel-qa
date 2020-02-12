<script>
export default {
    props: ['answer'],

    data() {
        return {
            editing: false,
            body: this.answer.body,
            id: this.answer.id,
            questionId: this.answer.questions_id,
            beforeEditCache: null
        }
    },
    computed: {
        isInvalid() {
            return this.body.length < 10
        },
        endPoint() {
            return `/questions/${this.questionId}/answers/${this.id}`
        }
    },

    methods: {
        destroy() {
            if (confirm('Are you sure you want to delete this answer?')) {
                axios.delete(this.endPoint)
                .then(res => {
                    $(this.$el).fadeOut(1000, () => {
                        alert(res.data.message)
                    });
                });
            }
        },

        edit() {
            this.beforeEditCache = this.body,
            this.editing = true
        },

        update() {
            this.body = this.beforeEditCache,
            this.editing = false
        },

        updateans () {
            console.log('update test');
            axios.patch(this.endPoint, {
                body: this.body
            })
            .then(res => {                
                this.editing = false;
                this.body = res.data.body
            })
            .catch(err => {
                console.log(err.response.data.message);                
            });
        },

        
    }
}
</script>