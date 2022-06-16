<template>
    <div>
        <div class="bg-gray-100 rounded-lg px-3 py-3 column-width rounded mr-4">
            <div class="flex justify-between pb-3">
			    <p class="mb-2 text-gray-700 font-semibold font-sans tracking-wide">{{ column.title }}</p>
                <button
                    aria-label="Delete column"
                    class="action-button p-1 focus:outline-none focus:shadow-outline text-red-500 hover:text-red-600"
                    @click="onDeleteColumn"
                    >
                    <Trash2Icon />
                </button>
            </div>
            <draggable
                tag="ul"
                group="cards"
                class="draggable-list"
                ghost-class="moving-card"
                filter=".action-button"
                :data-section="column.id"
                :list="column.cards"
                :animation="200"
                :move="onMove"
            >
            <card-view
                v-for="(card,index) in column.cards"
                :card="card"
                :key="index"
                v-on:card-list-updated="$emit('refresh-columns')"
                class=""
                />
			</draggable>

            <div class="bg-gray-100 rounded-lg px-3 py-3 column-width rounded mr-4 content-center new-card-div">
                <a @click="showCreateCardModel()" class="hover:border-blue-500 hover:border-solid hover:bg-white hover:text-blue-500 group w-full flex flex-col items-center justify-center rounded-md border-2 border-dashed border-slate-300 text-sm leading-6 text-slate-900 font-medium py-3 btn">
                    <svg class="group-hover:text-blue-500 mb-1 text-slate-400" width="20" height="20" fill="currentColor" aria-hidden="true">
                        <path d="M10 5a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 1 1 0-2h3V6a1 1 0 0 1 1-1Z" />
                    </svg>
                    New Card
                </a>
            </div>

		</div>

    </div>
</template>

<script>
import CardView from './CardView.vue'
import Draggable from "vuedraggable";
import { Trash2Icon } from "vue-feather-icons";
import AddCardForm from './AddCardForm.vue';

export default {
    props:['column'],
    components:{
        CardView,
        Draggable,
        Trash2Icon,
        AddCardForm
    },
    methods:{
        onDeleteColumn(){
            this.$modal.show('dialog', {
                title: 'Wait...!',
                text: 'Are you sure to delete '+this.column.title,
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
                            axios.delete(process.env.VUE_APP_API_HOST + 'column/delete/' + this.column.id)
                            .then( response => {
                                if(response.data && response.data.status){
                                    this.$modal.hide('dialog')
                                    this.$emit("refresh-columns")
                                }
                            })
                            .catch( error => {
                                console.log(error);
                            })
                        }
                    }
                ]
            })
        },
        showCreateCardModel(){
            this.$modal.show(
                AddCardForm,
                { column: this.column },
                { height: 'auto' },
                { 'closed': event => {
                    this.$emit('refresh-columns')
                } }
            )
        },
        onMove(evt) {
            this.$emit("index-updated");
        },
    }
}   

</script>

<style scoped>
    .new-card-div{
        min-width: 250px;
        padding-right: 0px;
    }
    .btn{
        cursor: pointer;
    }
</style>
