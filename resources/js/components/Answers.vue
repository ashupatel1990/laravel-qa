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
            this.$toast.question('Are you sure you want to delete?', "Confirm", {
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,         
                position: 'center',
                buttons: [
                ['<button><b>YES</b></button>', (instance, toast) => {
                   axios.delete(this.endPoint)
                    .then(res => {
                        $(this.$el).fadeOut(1000, () => {
                            alert(res.data.message)
                        });
                    });
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }, true],
                    ['<button>NO</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }],
                ]   
            });
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
                this.$toast.success(res.data.message, "Success", { timeout: 3000 });
            })
            .catch(err => {
                this.$toast.error(err.response.data.message, "Error", { timeout: 3000 });              
            });
        },

        
    }
}
</script>