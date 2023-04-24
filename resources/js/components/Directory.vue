<template>
    <div>
        <h1>Contact Form</h1>
        <div class="form-group">        
            <label for="name">Name</label>
            <input type="text" id="name" placeholder="Enter Name" class="form-control" v-model="item.name"/>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" placeholder="Enter phone" class="form-control" v-model="item.phone"/>
        </div>
        <hr/>
        <button class="btn btn-success" @click="save">
            {{isEditing?"Update":"Save"}}
        </button>
        <hr/>
        
        <div class="col-md-10 offset-md-1" v-if="list.length > 0">
            <h1 class="text-center">Contact List</h1>
            <ul class="list-group">
                <li class="list-group-item" v-for="item in list" :key="item.id">{{item.name}} - {{item.phone}}
                    <span class="float-right">
                        <button class="btn btn-warning btn-sm mr-2" @click="editTel(item)">Edit</button>
                        <button class="btn btn-danger btn-sm mr-2" @click="deleteTel(item.id)">Delete</button>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    
    

</template>
<script>
    export default{
        mounted(){
            this.fetchAll();
            console.log('Component Mounted');
        },
        name :"Directory",
        data(){
            return {
               list:[],
               item:{
                name:"",
                phone:""
               },
               temp_id:null,
               isEditing:false
            }
        },
        methods:{
            fetchAll(){
                axios.get('api/tel')
                .then(res=>{
                    this.list = res.data;
                });
            },
            save(){
                let method = axios.post;
                let url = '/api/tel';
                 if (this.temp_id) {
                    method = axios.put
                    url = `/api/tel/${this.temp_id}`
                }
                try{
                    method(url,this.item)
                    .then(res=>{
                        this.fetchAll();
                        this.item={
                            name:"",
                            phone:""
                        },
                        temp_id=null;
                        isEditing=false;
                        
                    })
                    ;
                }catch(e){
                    console.log('save method error');
                    console.log(e);
                }
            },
            deleteTel(id){
                try{
                    axios.delete(`api/tel/${id}`)
                    .then(res=>{
                        this.fetchAll();
                    });
                }catch(e){
                    console.log('delete error');
                    console.log(e);
                }
            },
            editTel(tel){
                this.item={
                    name:tel.name,
                    phone:tel.phone
                },
                this.temp_id = tel.id;
                this.isEditing = true;
            }
        }
    }
</script>