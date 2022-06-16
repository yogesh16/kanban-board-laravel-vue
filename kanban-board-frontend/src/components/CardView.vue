<template>
    <li class="p-4 mb-3 flex justify-between items-center bg-white border border-white shadow rounded-lg cursor-move card-width">
        <div class="flex items-center">
            <p class="ml-2 text-gray-700 font-semibold font-sans tracking-wide">
                {{card.title}}
            </p>
        </div>
        <div class="flex">
            <button
                aria-label="Edit user"
                class="action-button p-1 focus:outline-none focus:shadow-outline text-teal-500 hover:text-teal-600"
                @click="onCardEdit()">
                <EditIcon />
            </button>
            <button
                aria-label="Delete user"
                class="action-button p-1 focus:outline-none focus:shadow-outline text-red-500 hover:text-red-600"
                @click="onCardDelete()">
                <Trash2Icon />
            </button>
        </div>
    </li>
</template>

<script>
import { EditIcon, Trash2Icon } from "vue-feather-icons";
import EditCardForm from './EditCardForm.vue';

export default {
    props:['card'],
    components:{
        EditIcon,
        Trash2Icon,
        EditCardForm
    },
    methods:{
        onCardEdit(){
            this.$modal.show(
                EditCardForm,
                { card: this.card },
                { height: 'auto' },
                { 'closed': event => {
                    this.$emit('card-list-updated');
                } }
            );
        },
        onCardDelete(){

            this.$modal.show('dialog', {
                title: 'Wait...!',
                text: 'Are you sure to delete card '+this.card.title,
                buttons: [
                    {
                        title: 'Cancel',
                        handler: () => {
                            this.$modal.hide('dialog')
                        }
                    },
                    {
                        title: 'Yes',
                        handler: () => {
                            axios.delete(process.env.VUE_APP_API_HOST + 'column/card/delete/' + this.card.id)
                            .then( response => {
                                if(response.data && response.data.status){
                                    this.$modal.hide('dialog')
                                    this.$emit("card-list-updated")
                                }
                            })
                            .catch( error => {
                                console.log(error);
                            })
                        }
                    }
                ]
            })
        }
    }
}   

</script>

<style scoped>
.card-width{
    max-width: 250px;
}
</style>
