<template>
    <div>
        <div class="p-5">
             <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                    Add New Card To {{ column.title }}
                </h3>
                <button type="button" @click="$emit('close')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form>
                    <div class="mb-6">
                        <input class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-5  shadow-sm" 
                            type="text" 
                            aria-label="Enter title" 
                            placeholder="Enter title"
                            v-model="title"
                            v-bind:class="checkTitle"
                        />
                    </div>

                    <div class="mb-6">
                        <textarea class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-5  shadow-sm" 
                            aria-label="Enter description" 
                            placeholder="Enter description"
                            v-model="description"
                            v-bind:class="checkDescription"
                        ></textarea>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <a class="hover:bg-blue-400 group flex items-center rounded-md bg-blue-500 text-white text-sm font-medium pl-2 pr-3 py-2 shadow-sm btn"
                            @click="addCard()"
                            >
                            <svg width="20" height="20" fill="currentColor" class="mr-2" aria-hidden="true">
                                <path d="M10 5a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 1 1 0-2h3V6a1 1 0 0 1 1-1Z" />
                            </svg>
                            Add
                        </a>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        props:['column'],
        name: "AddCardForm",
        data: function () {
            return {
                title: "",
                description: ""
            }
        },
        computed: {
            checkTitle: function(){
                return this.title == '' ? 'error' : ''
            },
            checkDescription: function(){
                return this.description == '' ? 'error' : ''
            }
        },
        methods: {
            addCard(){
                if(this.title == '' || this.description == ''){
                    return;
                }
                
                axios.post(process.env.VUE_APP_API_HOST + 'column/' + this.column.id + '/card/create', {
                    title: this.title,
                    description: this.description
                })
                .then(response => {
                    if(response.status){
                        this.title = ""
                        this.description = ""
                        this.$emit('close')
                    }
                })
                .catch(err => {
                    console.log(err);
                })
            }
        }
    }
</script>

<style scoped>
    .error{
        border: 1px solid red;
    }
    .btn{
        cursor: pointer;
    }
</style>
