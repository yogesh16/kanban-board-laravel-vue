<template>
<div id="app" class="min-h-screen w-screen bg-gray-200">
	<add-column-model
		v-on:refresh-columns="getColumns()">
	</add-column-model>
	<v-dialog />
	<div class="px-10 py-6">
		<h1 class="text-2xl font-bold">Kanban Board Demo</h1>
	</div>
  	<div class="flex flex-col pt-5 justify-center items-center md:items-start md:flex-row">

		<column-view v-for="(item, index) in columns" 
			:column="item" 
			:key="index" 
			v-on:index-updated="indexUpdated()"
			v-on:refresh-columns="getColumns()"
			/>
		  
      	<div class="bg-gray-100 rounded-lg px-3 py-3 column-width rounded mr-4 content-center new-column-div">
			<p class="mb-2 text-gray-700 font-semibold font-sans tracking-wide">Add Another Column</p>
			<a @click="$modal.show('add-column-modal')" class="hover:border-blue-500 hover:border-solid hover:bg-white hover:text-blue-500 group w-full flex flex-col items-center justify-center rounded-md border-2 border-dashed border-slate-300 text-sm leading-6 text-slate-900 font-medium py-3 btn">
        		<svg class="group-hover:text-blue-500 mb-1 text-slate-400" width="20" height="20" fill="currentColor" aria-hidden="true">
          			<path d="M10 5a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 1 1 0-2h3V6a1 1 0 0 1 1-1Z" />
        		</svg>
        		New Column
      		</a>
      	</div>
    
  	</div>

	<div class="absolute bottom-0 right-0 h-16 w-32  mb-10 mr-5">
		<a href="http://15.206.211.44/kanban-board-demo/backend/public/export-db" target="_blank" class="rounded-md bg-blue-500 text-white text-sm font-medium p-2 text-black-700 font-bold mb-10 mr-5 btn">Export DB</a>
	</div>
</div>
</template>

<script>
import Draggable from "vuedraggable";
import ColumnView from "./components/ColumnView.vue";
import AddColumnModel from './modals/AddColumnModal.vue';

export default {
  	name: "App",
  	components: {
    	Draggable,
		ColumnView,
		AddColumnModel
  	},
  	data() {
    	return {
			columns:[]
    	};
  	},
  	methods: {
    	onEdit(user) {
      		alert(`Editing ${user.name}`);
    	},
    	onDelete(user) {
      		alert(`Deleting ${user.name}`);
    	},
		getColumns() {
			axios.get( process.env.VUE_APP_API_HOST + 'column/get')
				.then( response => {
					this.columns = response.data;
				})
				.catch( error => {
					console.log(error);
				})
		},
		indexUpdated() {
			setTimeout(() => {
				this.updateCardOrder();
			}, 500);
			
		},
		updateCardOrder(){
			var data = [];
			for(var c=0; c<this.columns.length; c++){
				var cards = [];
				for(var i=0; i<this.columns[c].cards.length; i++){
					//console.log('--'+this.columns[c].cards[i].title);
					cards.push({index: i, id: this.columns[c].cards[i].id, title: this.columns[c].cards[i].title})
				}
				data.push({id:this.columns[c].id, cards: cards});
			}	
			axios.post(process.env.VUE_APP_API_HOST + 'column/card/update/index', {
                    'data': data
                })
                .then( response => {
                    console.log(response);
                })
                .catch( error => {
                    console.log(error);
                })
		}
  	},
	created(){
		this.getColumns();
	}
};
</script>


<style>
.draggable-list {
  	min-height: 100px;
}

.moving-card {
  	opacity: 0.5;
  	background: #f7fafc;
  	border: 1px solid #4299e1;
}
.new-column-div{
	min-width: 250px;
}
.btn{
	cursor: pointer;
}
</style>
