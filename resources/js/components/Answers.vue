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
        }
    },

    methods: {
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
            axios.patch(`/questions/${this.questionId}/answers/${this.id}`, {
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