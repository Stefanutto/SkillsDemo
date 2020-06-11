new Vue({
    el: "#VueAssets",
    data:{
        CarteiraPorCento:"0%",
        Acoes:0,
        AcoesSlider:{},
        Fiis:0,
        FiisSlider:{},
        Etfs:0,
        EtfsSlider:{},
        Rf:0,
        RfSlider:{},
        StyleAlert:{display: "none"},
        StyleLoader:{display: "none"},
        SalvarDisabled: 1,
    },
    mounted(){
        this.AcoesSlider = this.SetSlidBar("acoes");
        this.FiisSlider = this.SetSlidBar("fiis");
        this.EtfsSlider = this.SetSlidBar("etfs");
        this.RfSlider = this.SetSlidBar("rf"); 
        this.GetAssets();
    },
    watch: {
        CarteiraPorCento: function(val, oldVal) {
            let ValueInt = val.substring(0, val.length - 1);
            if(ValueInt > 100){
                this.StyleAlert = {};
                this.SalvarDisabled = 1;
            }else if(ValueInt == 100){
                this.StyleAlert = {display: "none"};
                this.SalvarDisabled = 0;
            }else{
                this.StyleAlert = {display: "none"};
                this.SalvarDisabled = 1;
            }
        },
        Acoes: function(val){
            if(val > 100) this.Acoes = 100;
            if(val < 0) this.Acoes = 0;
            if(parseFloat(this.Acoes) +  parseFloat(this.Fiis) +  parseFloat(this.Etfs) +  parseFloat(this.Rf) > 100 )  
                this.Acoes = 100 - (parseFloat(this.Fiis) +  parseFloat(this.Etfs) +  parseFloat(this.Rf));

            this.AcoesSlider.noUiSlider.set(val);
            this.SumCarteiraPorCento();
        },
        Fiis: function(val){
            if(val > 100) this.Fiis = 100;
            if(val < 0) this.Fiis = 0;
            if(parseFloat(this.Acoes) +  parseFloat(this.Fiis) +  parseFloat(this.Etfs) +  parseFloat(this.Rf) > 100 )  
                this.Fiis = 100 - (parseFloat(this.Acoes) +  parseFloat(this.Etfs) +  parseFloat(this.Rf));

            this.FiisSlider.noUiSlider.set(val);
            this.SumCarteiraPorCento();
        },
        Etfs: function(val){
            if(val > 100) this.Etfs = 100;
            if(val < 0) this.Etfs = 0;
            if(parseFloat(this.Acoes) +  parseFloat(this.Fiis) +  parseFloat(this.Etfs) +  parseFloat(this.Rf) > 100 )  
                this.Etfs = 100 - (parseFloat(this.Fiis) +  parseFloat(this.Acoes) +  parseFloat(this.Rf));

            this.EtfsSlider.noUiSlider.set(val);
            this.SumCarteiraPorCento();
        },
        Rf: function(val){
            if(val > 100) this.Rf = 100;
            if(val < 0) this.Rf = 0;
            if(parseFloat(this.Acoes) +  parseFloat(this.Fiis) +  parseFloat(this.Etfs) +  parseFloat(this.Rf) > 100 )  
                this.Rf = 100 - (parseFloat(this.Fiis) +  parseFloat(this.Etfs) +  parseFloat(this.Acoes));

            this.RfSlider.noUiSlider.set(val);
            this.SumCarteiraPorCento();
        }
    },
    methods: {
        GetAssets(){
            axios.post(window.MyUrl + '/assets/GetAssets')
            .then(response => {
                if(!response.data.length > 0){
                    return;
                }
                let json = JSON.parse(response.data[0].assets);
                this.Acoes = json.acoes;
                this.Fiis = json.fiis;
                this.Etfs = json.etfs;
                this.Rf = json.rf;
            })
            .catch(function (error) {});
        },
        Save(){
            this.StyleLoader = {};
            params = new URLSearchParams();
            params.append('acoes', this.Acoes);
            params.append('fiis', this.Fiis);
            params.append('etfs', this.Etfs);
            params.append('rf', this.Rf);

            axios.post(window.MyUrl + '/assets/save', params)
            .then(response => {
                if(response.data.error){
                    this.Alert(response.data.menssager);
                }else{
                    this.Alert(response.data.menssager, "success");
                }
                this.StyleLoader = {display: "none"};
            })
            .catch(function (error) {
                this.StyleLoader = {display: "none"};
            });
        },
        SumCarteiraPorCento(){
            this.CarteiraPorCento = (parseFloat(this.Acoes) +  parseFloat(this.Fiis) +  parseFloat(this.Etfs) +  parseFloat(this.Rf)) + "%";
        },
        SetSlidBar(id){
            let slider = document.getElementById(id);
            noUiSlider.create(slider, {
                start: [0],
                tooltips: true,
                connect: [true, false],
                range: {
                    'min': [0],
                    'max': [100]
                },
                format: {
                    to: function (value) {
                        return parseInt(value);
                    },
                    from: function (value) {
                        return Number(value.replace(',-', ''));
                    }
                }
            });
            slider.noUiSlider.on('change.one', r => {
                switch (id) {
                    case 'acoes':
                        this.Acoes =  parseFloat(r[0]);
                        break;
                    case 'fiis':
                        this.Fiis =  parseFloat(r[0]);
                        break;
                    case 'etfs':
                        this.Etfs =  parseFloat(r[0]);
                        break;
                    case 'rf':
                        this.Rf =  parseFloat(r[0]);
                        break;
                    default:
                }
                this.SumCarteiraPorCento();
            });
            return slider;
        },
        Alert(menssager, icon = 'error', title = 'Atenção!' ){
            swal({
                title: title,
                text: menssager,
                icon: icon,
                button: {
                text: "Ok",
                value: true,
                visible: true,
                className: "btn btn-primary"
                }
            })
        }
    }
})