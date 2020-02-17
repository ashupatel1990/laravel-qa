<template>
    <div>
        <div class="media">
            <div class="d-fex flex-column vote-controls">
                <a title="This question is useful" class="vote-up">
                    <i class="fas fa-caret-up fa-3x"></i>
                </a>
                <span class="votes-count">{{ voteCount }}</span>
                <a title="This question is not useful" class="vote-down off">
                    <i class="fas fa-caret-down fa-3x"></i>
                </a>
                <accept :answer="answer"></accept>
            </div>
            <div class="media-body">
                <form v-if="editing" @submit.prevent="updateans">
                    <div class="form-group">
                        <textarea v-model="body" cols="30" rows="10" required class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-success" :disabled="isInvalid">Update</button>
                    <button type="button" @click="update" class="btn btn-outline-danger">Cancel</button>
                </form>
                <div v-else>
                    <div v-html="body"></div>
                    <div class="row">
                        <div class="col-4" style="display: inline-flex;">
                            <a v-if="authorize('modify', answer)" @click.prevent="edit" class="btn btn-sm btn-outline-info" style="margin-right: 10px;">Edit</a>
                            <button v-if="authorize('modify', answer)" @click.prevent="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                        </div>
                    </div>

                    <user-info :model="answer" label="Answered"> </user-info>
                </div>
            </div>
        </div>
        <hr/>
    </div>
	
</template>
<script>
export default {
    props: ['answer'],

    data() {
        return {
            editing: false,
            body: this.answer.body,
            id: this.answer.id,
            questionId: this.answer.questions_id,
            beforeEditCache: null,
            voteCount: this.answer.votes_count
        }
    },
    computed: {
        isInvalid() {
            return this.body.length < 10
        },
        endPoint() {
            return `/questions/${this.questionId}/answers/${this.id}`
        },
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