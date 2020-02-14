<template>
<div>
    <a v-if="canAccept" title="Mark this answer as best answer" 
        :class="classes"
        @click.prevent="create">
        <i class="fas fa-check fa-2x"></i>
    </a>
    <!-- <form id="accept-answer-{{ id }}" 
        method="post"
        action="{{ route('answers.accept', id) }}" 
        style="display:none;">
        @csrf
    </form> -->

    <a v-if="accepted" title="Question owner accept this answer as best answer" :class="classes">
        <i class="fas fa-check fa-2x"></i>
    </a>

</div>
</template>

<script>
export default {
   props: ['answer'],

   data() {
       return {
           id: this.answer.id,
           status: this.answer.status,
           isBest: this.answer.is_best
       }
   },
   
   computed: {
       canAccept() {
        //    return true;
            return this.authorize('accept', this.answer);
       },

       accepted() {
           return !this.canAccept && this.isBest;
       },

       classes() {
           return  [
               'mt-2',
               this.isBest ? 'vote-accepted' : ''
            ]
       },
   },

   methods: {
       create() {
           axios.post(`/answer/${this.id}/accept`)
           .then(res => {
               this.$toast.success(res.data.message, "Success", {
                   timeout: 3000,
                   position: 'bottomLeft'
               });
               this.isBest = true
           })
       }
   }
}
</script>
