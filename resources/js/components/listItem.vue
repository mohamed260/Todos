<template>
    <div class="item">
        <input type="checkbox" @change="updateCheck()" v-model="item.completed">
        <span :class="[ item.completed ? 'completed' : '', 'itemText' ]">{{ item.name }}</span>
        <button @click="removeItem()" class="trashcan">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z" fill="currentColor" /><path d="M9 9H11V17H9V9Z" fill="currentColor" /><path d="M13 9H15V17H13V9Z" fill="currentColor" /></svg>
        </button>
    </div>
</template>

<script>
export default {
    props:['item'],
    methods: {
        updateCheck(){
            axios.put('api/item/' + this.item.id, {
                item: this.item
            })
            .then( response => {
                if( respone.status == 200 ){
                    this.$emit('itemchanged');
                }
            })
            .catch( error => {
                console.log( error );
            })
        },

        removeItem(){
            axios.delete('api/item/' + this.item.id)
            .then( response => {
                if( response.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>
.completed{
    text-decoration: line-through;
    color: #999;
}

.itemText{
    width: 100%;
    margin-left: 20px;
}

.item{
    display: flex;
    justify-content: center;
    align-items: center;
}

.trashcan{
    background-color: #e6e6e6;
    border: none;
    color: #f00;
    outline: none;
}
</style>