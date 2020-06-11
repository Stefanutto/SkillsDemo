new Vue({
    el: "#VueActive",
    data:{
        Codigo:"",
        Nota:0,
        Categoria:"",
        db:[],
        StyleLoader:{display: "none"},
        StyleInclude:{}
    }, 
    mounted(){
        
    },
    methods: {
        SetTable(){
            this.StyleLoader = {};
            this.StyleInclude = {display: "none"};
            axios.post(window.MyUrl + '/Active/GetClassActive/' + this.Codigo.toUpperCase())
            .then(response => {
                this.db.push({
                    "codigo":this.Codigo.toUpperCase(),
                    "nota": parseInt(this.Nota),
                    "categoria":response.data
                });
                this.Clear();
                this.StyleLoader = {display: "none"};
                this.StyleInclude = {};
            })
            .catch(function (error) {
                this.StyleLoader = {display: "none"};
                this.StyleInclude = {};
            });

            
        },
        EditTable(index){
            this.Codigo = this.db[index].codigo;
            this.Nota = this.db[index].nota;
            this.Categoria = this.db[index].categoria;
            this.RemoveTable(index)
        },
        RemoveTable(index){
            this.db.splice(index,1);
        },
        Clear(){
            this.Codigo = "";
            this.Nota = 0;
            this.Categoria = "";
        }
    }
})